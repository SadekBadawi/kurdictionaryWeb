<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Word;
use Illuminate\Support\Str;
use Mockery\Undefined;

class WordController extends Controller
{
    //==============================================================================//
    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|numeric',
            'english_word'  => 'required|string',
            'kurdish_word'  => 'required|string',
            'kurdish_spell' => 'sometimes|nullable',
            'description'  => 'sometimes|nullable|string'
        ]);


        $filePath = null;

        if ($request->kurdish_spell) {
            if ($validatedData['kurdish_spell'] != 'undefined') {
                $kurdish = $validatedData['kurdish_spell'];
                $uuid = (string) Str::uuid();
                $voicePath =   $uuid . ".mp3";
                $file = Storage::disk('public')->put($voicePath, file_get_contents($kurdish));
                $filePath = "uploads/" . $voicePath;
            }
        }

        $data = Word::create([
            'category_id'   =>  $validatedData['category_id'],
            'english_word'  =>  $validatedData['english_word'],
            'kurdish_word'  =>  $validatedData['kurdish_word'],
            'description'  =>  $validatedData['description'],
            'kurdish_spell' =>  $filePath
        ]);

        return json('success', ['add word successfully'], ['word' => $data]);
    }
    //==============================================================================//
    public function edit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_id' => 'filled|numeric',
            'english_word'  => 'filled|string',
            'kurdish_word'  => 'filled|string',
            'description'  => 'filled|string'
        ]);
        $word = Word::find($id);
        if (isset($request['kurdish_spell']) && $request->kurdish_spell != 'undefined') {

            \File::delete($word->kurdish_spell);
            $kurdish = $request->kurdish_spell;
            $uuid = (string) Str::uuid();
            $voicePath =   $uuid . ".mp3";
            Storage::disk('public')->put($voicePath, file_get_contents($kurdish));

            $data = Word::find($id)->update([
                'category_id' => $request->category_id,
                'english_word' => $request->english_word,
                'kurdish_word' => $request->kurdish_word,
                'description' => $request->description,
                'kurdish_spell' => "uploads/" . $voicePath
            ]);
        } else {
            $data = Word::find($id)->update([
                'category_id' => $request->category_id,
                'english_word' => $request->english_word,
                'kurdish_word' => $request->kurdish_word,
                'description' => $request->description,
            ]);
        }


        return json('success', ['update word successfully'], []);
    }
    //==============================================================================//
    public function delete($id)
    {
        $word = Word::find($id);
        if ($word->kurdish_spell) {
            \File::delete($word->kurdish_spell);
        }
        $word->delete();
        return json('success', ['delete word successfully'], []);
    }
    //==============================================================================//
    public function getWords(Request $request)
    {
        if (isset($request->category_id)) {
            $id = $request->category_id;
            if ($id == 16) {
                $data = Word::where('category_id', $id)->orderBy('english_word')->get();
            } else {
                $data = Word::where('category_id', $id)->get();
            }
        } elseif (isset($request->kurdish_word)) {
            $val = $request->kurdish_word;
            $data = Word::where('kurdish_word', 'like', '%' . $val . '%')->orderBy('english_word')->get();
        } elseif (isset($request->english_word)) {
            $val = $request->english_word;
            $data = Word::where('english_word', 'like', '%' . $val . '%')->orderBy('english_word')->get();
        } else {
            $data = Word::join('categories', 'words.category_id', '=', 'categories.id')->select('words.id', 'words.category_id', 'words.kurdish_word', 'words.kurdish_spell', 'words.english_word', 'categories.name', 'words.description')->orderBy('words.english_word')->get();
        }

        return json('success', [], $data);
    }
    //==============================================================================//
    public function show($id)
    {
        $word = Word::join('categories', 'words.category_id', '=', 'categories.id')->select('words.id', 'words.category_id', 'words.kurdish_spell', 'words.kurdish_word', 'words.english_word', 'categories.name', 'words.description')->whereRaw('words.id =' . $id)->get();

        return view('content.word-detail', compact('word'));
    }
    //==============================================================================//
}
