<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Task;
use Validator;
use Input;
use Redirect;
use Session;
use View;
use Auth;
use Datatables;
use DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('tasks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = array('' => 'Choose One') + DB::table('users')->lists('name','id');
        return view('tasks.create')->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      if(Auth::check())
      {
        $rules = array(
            //'task_description ' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::to('tasks/create')->withErrors($validator);
        }
        else
        {
            $task = new Task();
            $task->task_description            = Input::get("task_description");
            $task->start_timestamp             = Input::get("start_timestamp");
            $task->end_timestamp               = Input::get("end_timestamp");
            $task->fixed_timestamp             = Input::get("fixed_timestamp");
            $task->added_by                    = Auth::user()->id;
            $task->assigned_to                 = Input::get("assigned_to");
            $task->signature                   = Input::get("signature");  
            if($task->save())
            {
                Session::flash('alert-success', 'Form Submitted Successfully.');
            }
            else
            {
                Session::flash('alert-danger', 'Form Submitted Successfully.');
            }

            return Redirect::to('tasks/create');
        }
      }
      else
      {
        Auth::logout();
        Session::flash('warning-danger', 'Login session has expired. Please login.');
        return Redirect::to('auth/login');
      }

      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $tasks = Task::join('users', 'tasks.added_by', '=', 'users.id')
            ->select([
              'tasks.id',
              'tasks.task_description',
              'tasks.start_timestamp',
              'tasks.end_timestamp',
              'tasks.fixed_timestamp',
              'tasks.status',
              'users.name',
              'tasks.created_at'
              ])->where('tasks.id', '=', $id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $status       = Input::get("status");
        $task         = Task::find($id);
        $task->status = $status;
        if($task->save())
        {
          return "Task Successfully Updated.";
        }
        else
        {
          return "Task Update Failed. Please try again.";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getTasksList()
    {
      if(Auth::check() && Auth::user()->access_level == 1)
      {
        $tasks = Task::join('users', 'tasks.added_by', '=', 'users.id')
            ->join('users AS x', 'x.id', '=', 'tasks.assigned_to')
            ->select([
              'tasks.id',
              'tasks.task_description',
              'tasks.start_timestamp',
              'tasks.end_timestamp',
              'tasks.status',
              'users.name',
              'x.name AS assign',
              'tasks.created_at'
              ]);
      }
      else if(Auth::check())
      {
        $tasks = Task::join('users', 'tasks.added_by', '=', 'users.id')
            ->join('users AS x', 'x.id', '=', 'tasks.assigned_to')
            ->select([
              'tasks.id',
              'tasks.task_description',
              'tasks.start_timestamp',
              'tasks.end_timestamp',
              'tasks.status',
              'users.name',
              'x.name AS assign',
              'tasks.created_at'
              ])->where('tasks.assigned_to', '=', Auth::user()->id);
      }
      else
      {
        $tasks = "";
      }
      
       return Datatables::of($tasks)
       ->addColumn('action', function ($tasks) {
                return "<button type='button' data-id='".$tasks->id."' class='btn btn-xs btn-success' data-toggle='modal' data-target='#myModal'>Details</button>";
            })->make(true);     
    }
}
