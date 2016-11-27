<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    public function putCategory($query){
      DB::table('categories')->insert(['name_category'=>$query]);
    }

    public function tasks(){
        return $this->hasMany('App\Task');
    }

    public function allCategTask(){
        $category = DB::table('categories')->pluck('name_category', 'id');
        $taska = Task::get();
        foreach ($taska as $value){
            $value['name_category'] = Category::find($value->category_id)->name_category;
            array_forget($value, 'category_id');
        }
        return [$category, $taska];
     }
    
    public function ajaxCategory(){
        $category = Category::orderBy('id', 'DESC')
            ->first()->name_category;
        return $category;
    }
}


