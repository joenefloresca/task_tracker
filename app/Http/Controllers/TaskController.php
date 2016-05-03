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
use Mail;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
          $this->middleware('auth');
    }
  
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
            if(Auth::user()->access_level == 1)
            {
              $assign = Input::get("assigned_to");
            }
            else
            {
              $assign = Auth::user()->id;
            }

            $task = new Task();
            $task->task_description            = Input::get("task_description");
            $task->start_timestamp             = Input::get("start_timestamp");
            $task->end_timestamp               = Input::get("end_timestamp");
            $task->fixed_timestamp             = Input::get("fixed_timestamp");
            $task->is_daily                    = Input::get("is_daily");
            $task->added_by                    = Auth::user()->id;
            $task->assigned_to                 = $assign;
            $task->signature                   = Auth::user()->name; //Input::get("signature");  
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
              ])->where('tasks.is_daily', '=', 0);
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
              ])->where('tasks.is_daily', '=', 0)
            ->where('tasks.assigned_to', '=', Auth::user()->id);
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



    public function getDailyTasksList()
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
              ])->where('tasks.is_daily', '=', 1);
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
              ])->where('tasks.is_daily', '=', 1)
            ->where('tasks.assigned_to', '=', Auth::user()->id);
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


    public function generateReport()
    {
      $tasks = '';
      if(Auth::check())
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
              ])->where('tasks.is_daily', '=', 0)
            ->where('tasks.assigned_to', '=', Auth::user()->id)
            ->whereRaw('tasks.created_at > DATE_ADD(NOW(), INTERVAL -12 HOUR)')->get();

         $tasks_daily = Task::join('users', 'tasks.added_by', '=', 'users.id')
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
              ])->where('tasks.is_daily', '=', 1)
              ->where('tasks.assigned_to', '=', Auth::user()->id)
            ->whereRaw('tasks.created_at > DATE_ADD(NOW(), INTERVAL -12 HOUR)')->get();   
      }
      // else if(Auth::check())
      // {
      //   $tasks = Task::join('users', 'tasks.added_by', '=', 'users.id')
      //       ->join('users AS x', 'x.id', '=', 'tasks.assigned_to')
      //       ->select([
      //         'tasks.id',
      //         'tasks.task_description',
      //         'tasks.start_timestamp',
      //         'tasks.end_timestamp',
      //         'tasks.status',
      //         'users.name',
      //         'x.name AS assign',
      //         'tasks.created_at'
      //         ])->whereRaw('tasks.created_at > DATE_ADD(NOW(), INTERVAL -12 HOUR)')->get();
      // }

      return json_encode(array($tasks, $tasks_daily));
    }

    public function generateEmail()
    {
      $body       = Input::get("body");
      $supp_email = Input::get("supp_email");

      $emails = [];

      array_push($emails,$supp_email);

      Mail::send('emails.message', 
                    [
                    'body' => $body,
                    'name' => Auth::user()->name,
                    'date' => date('l jS \of F Y h:i:s A')

                    ], function ($m) use ($emails) {
                    $m->to($emails, '')->subject('Daily Time Sheet - '.Auth::user()->name);
                });
    }

    public function getBarChart()
    {
        $today = date('Y-m-d');
        $last5 = date('Y-m-d',(strtotime ('-1 day',strtotime ($today))));
        $last4 = date('Y-m-d',(strtotime ('-1 day',strtotime ($last5))));
        $last3 = date('Y-m-d',(strtotime ('-1 day',strtotime ($last4))));
        $last2 = date('Y-m-d',(strtotime ('-1 day',strtotime ($last3))));
        $last1 = date('Y-m-d',(strtotime ('-1 day',strtotime ($last2))));

        $q6 = "SELECT COUNT(*) as total6 from tasks where created_at like '$today%';";
        $data6 = DB::connection('mysql')->select($q6);

        $q5 = "SELECT COUNT(*) as total5 from tasks where created_at like '$last5%';";
        $data5 = DB::connection('mysql')->select($q5);

        $q4 = "SELECT COUNT(*) as total4 from tasks where created_at like '$last4%';";
        $data4 = DB::connection('mysql')->select($q4);

        $q3 = "SELECT COUNT(*) as total3 from tasks where created_at like '$last3%';";
        $data3 = DB::connection('mysql')->select($q3);

        $q2 = "SELECT COUNT(*) as total2 from tasks where created_at like '$last2%';";
        $data2 = DB::connection('mysql')->select($q2);

        $q1 = "SELECT COUNT(*) as total1 from tasks where created_at like '$last1%';";
        $data1 = DB::connection('mysql')->select($q1);

        return array(
            'today' => array($today,$data6[0]->total6),
            'last5' => array($last5,$data5[0]->total5),
            'last4' => array($last4,$data4[0]->total4),
            'last3' => array($last3,$data3[0]->total3),
            'last2' => array($last2,$data2[0]->total2),
            'last1' => array($last1,$data1[0]->total1)
        );
       
    }

    public function getPieChart()
    {
      $query = "SELECT COUNT(status = 'Done' OR NULL) as done, COUNT(status = 'Pending' OR NULL) as pending FROM tasks;";
      return DB::connection('mysql')->select($query);
    }

    public function showHelpPage()
    {
      return view('tasks.help');
    }
}
