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

    public function store(Category $category, Request $request){
       $category->putCategory($request->nameCategory);
       return $this->index($category);
    }

    public function storeTask(Task $task, Request $request, Category $category){
       $task->putTask($request);
        return $this->index($category);
    }
}
