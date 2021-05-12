<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        DB::table('users')->delete();

        $category =  Category::where('name', 'Home')->first();
        $words = $category->words()->get();
        foreach($words as $word){
            $word->delete();
        }
        $category->delete();
    
        DB::table('users')->insert(
              array(
                  [
                      'name'        => 'admin',
                      'email'       => 'nour-admin@gmail.com',
                      'password'    => \Hash::make('admin-nour-admin'),
                      'created_at'  => now() ,
                      'updated_at'  => now() ,
                  ]
              )
        );

        DB::table('categories')->insert(
            array(
                [
                    'name'        => 'Home',
                    'created_at'  => now() ,
                    'updated_at'  => now() ,
                ]
            )
      );
    }
}
