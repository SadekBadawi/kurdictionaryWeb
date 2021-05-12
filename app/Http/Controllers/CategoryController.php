<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index(){
        $breadcrumbs = [
            ['link'=>"admin/category",'name'=>"Category"], ['name'=>"All Categories"]
        ];
        $data = Category::select('id', 'name')->get();
        
        return view('/content/category', ['breadcrumbs' => $breadcrumbs , 'categories' => $data]);
      }

    public function add(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string'
        ]);
        
        $data = Category::create($validatedData);

        return json('success' , ['add category successfully'] , ['category' => $data]);
    }

    public function edit(Request $request , $id){
        $validatedData = $request->validate([
            'name' => 'string'
        ]);

        $data = Category::find($id);
        $name = $data->name;
        if($name != 'Home'){
            $data->name = $validatedData['name'];
            $data->save();
            return json('success' , ['update category successfully'] , ['category' => $data]);
        }else{
            return json('fail' , ['can not update "Home" categorty '] , ['category' => $data]);
        }

  
    }

    public function delete($id){
        $category = Category::find($id);
        
        $name = $category->name;
        if($name != 'Home'){
            $words = $category->words()->get();
            foreach($words as $word){
                $word->delete();
            }
            $category->delete();
            return json('success' , ['delete category successfully'] , []);

       }else{
            return json('fail' , ['can not delete "Home" categorty '] , ['category' => $data]);
       }
   
    }

    public function getCategories(Request $request){
        if(isset($request->name)){
            $val = $request->name;
            $data = Category::where('name', 'like','%'.$val.'%')->withCount('words')->orderBy('name')->get();
        }else{
            $data = Category::withCount('words')->orderBy('name')->get();
        }

        return json('success' , [] , $data);
    }
}
