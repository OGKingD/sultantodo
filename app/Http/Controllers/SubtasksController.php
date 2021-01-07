<?php

namespace App\Http\Controllers;

use App\Subtask;
use App\Task;
use Illuminate\Http\Request;

class SubtasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Subtask[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        return Subtask::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function store(Request $request,Task $task)
    {
        $request->validate([
            "subtasks" => ["required"]
        ]);

        if (isset($request['subtasks']) && count($request['subtasks'])){
            foreach ($request['subtasks'] as $subtask) {
                $task->addSubtasks($subtask);
            }
        }

        return $task->with('subtasks:id,name,completed_at,task_id')->where('id',$task->id)->get(['id','name','completed_at']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subtask  $subtasks
     * @return \Illuminate\Http\Response
     */
    public function show(Subtask $subtasks)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subtask  $subtask
     * @return Subtask
     */
    public function update(Request $request, Subtask $subtask)
    {
        if ($request['complete']) {
            $subtask->toggleCompletion($request['complete']);
            return $subtask;
        }
        $request->validate([
            "subtask" => ["required"]
        ]);
        $subtask->update([
            "name" => $request['subtask'],
        ]);
        return $subtask;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subtask  $subtask
     * @return bool
     */
    public function destroy(Subtask $subtask)
    {
        return $subtask->delete();
    }
}
