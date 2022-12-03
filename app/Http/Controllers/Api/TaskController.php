<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Task;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * GET /api/tasks
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * POST /api/tasks
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
        ]);


        return Task::create(        [
            'user_id' =>  $request['user_id'],
            'name' =>  $request['name'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * GET /api/tasks/{id}
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        
        if(!$task) {
            return response([
                'message' => 'Not found'
            ], 404);
        }

        return $task;
    }

    /**
     * Update the specified resource in storage.
     *
     * PATCH /api/tasks/{id}
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->update($request->all());
        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * DELETE /api/tasks/{id}
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Task::destroy($id);
    }
}
