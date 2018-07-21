<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pagintation = 10;

        // get sorting options
        $sortBy = $request->input('sort_by') ? : 'finished_at_desc';
        
        // get searching phrase in description
        $descriptionSearch = null !== $request->input('description') ? $request->input('description') : '%';

        switch ($sortBy) {
            case "finished_at_asc":
                return Task::orderBy('created_at', 'ASC')
                    ->where('description', 'LIKE', '%' . $descriptionSearch . '%')
                    ->paginate($pagintation);
                break;
            case "longest_duration":
                return Task::orderBy('days', 'DESC')->orderBy('hours', 'DESC')
                    ->orderBy('minutes', 'DESC')->orderBy('seconds', 'DESC')
                    ->where('description', 'LIKE', '%' . $descriptionSearch . '%')
                    ->paginate($pagintation);
                break;
            case "shortest_duration":
                return Task::orderBy('days', 'ASC')->orderBy('hours', 'ASC')
                    ->orderBy('minutes', 'ASC')->orderBy('seconds', 'ASC')
                    ->where('description', 'LIKE', '%' . $descriptionSearch . '%')
                    ->paginate($pagintation);
                break;
            default:
                return Task::orderBy('created_at', 'DESC')
                    ->where('description', 'LIKE', '%' . $descriptionSearch . '%')
                    ->paginate($pagintation);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create task
        try {
            $task = Task::create($request->all());
            return response('Task created successfully.');
        } catch (\Exception $e) {
            return response('Failed to create task!', 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {
            // get task
            $task = Task::findOrFail($id);

            $task->update($request->all());

            return response('Task updated successfully.');
        } catch (\Exception $e) {
            return response('Failed to update task!', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            // get task
            $task = Task::findOrFail($id);
            $task->delete();

            return $task;
        } catch (\Exception $e) {
            return response('Failed to delete task!', 400);
        }
    }
}
