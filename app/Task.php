<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class Task extends Model
{
    public function categories(){
        return $this->belongsTo('App\Category');
    }

    public function putTask($query){
        Task::insert(['name_task'=>$query->nameTask, 'category_id' => $query->id]);
    }

    public function ajaxTask(){
        $task = Task::orderBy('id', 'DESC')->first();
        $task['name_category'] = $task->getNameCategory();
        return $task;
    }

    public function ajaxDrop($taskId){
         Task::where('id', (integer)($taskId))->delete();
    }

    public function getNameCategory(){
        return Category::where('id', $this->category_id)->first()->name_category;
    }

    public function ajaxUpdate(){
        $data = Input::all();
        DB::table('tasks')->where('id', (integer)$data['idTask'])
             ->update(array('name_task' => $data['nameTask']));
    }
}

