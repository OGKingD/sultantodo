<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Response
     */
    public function index()
    {
        return Task::with('subtasks:id,name,completed_at,task_id')->get(['id', 'name', 'completed_at']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "task" => ["required", "min:3"]
        ]);
        $task = Task::create([
            'name' => $request['task'],
        ]);
        if (isset($request['subtasks']) && count($request['subtasks'])) {
            foreach ($request['subtasks'] as $subtask) {
                $task->addSubtasks($subtask);
            }
        }

        return $task->with('subtasks:id,name,completed_at,task_id')->where('id', $task->id)->get(['id', 'name', 'completed_at']);

    }

    /**
     * Display the specified resource.
     *
     * @param Task $task
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Response
     */
    public function show(Task $task)
    {
        return $task->with('subtasks:id,name,completed_at,task_id')->where('id', $task->id)->get(['id', 'name', 'completed_at']);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Task $task
     * @return Task|Response
     */
    public function update(Request $request, Task $task)
    {
        if ($request['complete']) {
            $task->toggleCompletion($request['complete']);
            return $task;
        }

        $request->validate([
            "task" => ["required", "min:3"]
        ]);
        $task->update([
            "name" => $request['task'],
        ]);
        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return Response
     */
    public function destroy(Task $task)
    {
        return $task->delete();
    }
}
