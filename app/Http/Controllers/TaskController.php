<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by due_date
        if ($request->has('due_date')) {
            $query->whereDate('due_date', $request->due_date);
        }

        // Search by title
        if ($request->has('search')) {
            $query->where('title', 'like', "%{$request->search}%");
        }

        $tasks = $query->paginate($request->input('per_page', 10));

        return TaskResource::collection($tasks);
    }

    public function store(Request $request)
    {
        $this->validate($request, Task::rules());

        $task = Task::create($request->all());

        return new TaskResource($task);
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return new TaskResource($task);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $rules = Task::rules();
        $rules['title'] = 'required|string|unique:tasks,title,' . $id;

        $this->validate($request, $rules);

        $task->update($request->all());

        return new TaskResource($task);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
