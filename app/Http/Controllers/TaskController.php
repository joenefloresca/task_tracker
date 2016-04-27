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
         //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
          'task_description '       => 'required',
          'start_timestamp'         => 'required',
          'end_timestamp'           => 'required',
          'fixed_timestamp'         => 'required',
          'added_by'                => 'required',
          'assigned_to'             => 'required',
          'status'                  => 'required',
          'signature'               => 'required',
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
          $task->added_by                    = Input::get("potential_points");
          $task->assigned_to                 = Input::get("assigned_to");
          $task->status                      = Input::get("status");
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
}
