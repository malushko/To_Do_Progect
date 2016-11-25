<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    public function categories(){
        return $this->belongsTo('App\Category');
    }

    public function putTask($query){
        DB::table('tasks')->insert(['name_task'=>$query->nameTask, 'category_id' => $query->id]);
    }
}

