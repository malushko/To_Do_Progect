<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Task;
use App\Category;
use App;
class ToDoController extends Controller
{
    public function index(Category $category){
        $arrayCatTask = $category->allCategTask();
        return view('to-do',['arrayCategory'=>$arrayCatTask[0], 'arrayCatTask'=>$arrayCatTask[1]]);
    }

    public function storeCategory(Category $category, Request $request){
        if ($request->ajax()){
            $category->putCategory($request->nameCategory);
            $arrayCategory = $category->ajaxCategory();
            return ['category', $arrayCategory];
        }

    }

    public function dropTask(Task $task, Request $request){
        if($request->ajax()){
            $task->ajaxDrop($request->idTask);
        }
    }

    public function updateTask(Task $task, Request $request){
        if($request->ajax()){
            $taskID = $request->idTask;
            $nameTask = $request->nameTask;
            $task->ajaxUpdate($taskID, $nameTask);
        }
    }

    public function storeTask(Task $task, Request $request){
        if($request->ajax()){
            $task->putTask($request);
            $arrayTask = $task->ajaxTask();
            return ['task', $arrayTask];
        }
        
    }


}
