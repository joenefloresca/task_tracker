<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Input;
use Auth;

class ReportController extends Controller
{
    public function showEosrReport()
    {
        if(Auth::user()->access_level = 1 && Auth::check())
        {
            return view('reports.eosr');
        }
        else
        {
            return Redirect::to('tasks/create');
        }
    }

    public function getEosrReport()
    {
        $from  = Input::get('from');
        $to    = Input::get('to');
        $query = "SELECT b.name, COUNT(*) as cnt, SUM(a.amount) as total FROM payments a INNER JOIN users b ON a.agent_id = b.id
            WHERE a.created_at >= '$from' AND a.created_at <= '$to' GROUP BY a.agent_id;";

        $data = DB::connection('mysql')->select($query);
        return json_encode($data);    
    }

    public function getBarChart()
    {
        $today = date('Y-m-d');
        $last5 = date('Y-m-d',(strtotime ('-1 day',strtotime ($today))));
        $last4 = date('Y-m-d',(strtotime ('-1 day',strtotime ($last5))));
        $last3 = date('Y-m-d',(strtotime ('-1 day',strtotime ($last4))));
        $last2 = date('Y-m-d',(strtotime ('-1 day',strtotime ($last3))));
        $last1 = date('Y-m-d',(strtotime ('-1 day',strtotime ($last2))));

        $q6 = "SELECT SUM(amount) as total6 from tasks where created_at like '$today%';";
        $data6 = DB::connection('mysql')->select($q6);

        $q5 = "SELECT SUM(amount) as total5 from tasks where created_at like '$last5%';";
        $data5 = DB::connection('mysql')->select($q5);

        $q4 = "SELECT SUM(amount) as total4 from tasks where created_at like '$last4%';";
        $data4 = DB::connection('mysql')->select($q4);

        $q3 = "SELECT SUM(amount) as total3 from tasks where created_at like '$last3%';";
        $data3 = DB::connection('mysql')->select($q3);

        $q2 = "SELECT SUM(amount) as total2 from tasks where created_at like '$last2%';";
        $data2 = DB::connection('mysql')->select($q2);

        $q1 = "SELECT SUM(amount) as total1 from tasks where created_at like '$last1%';";
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

    public function getBarChart2()
    {
        $query ="SELECT b.name, sum(amount) AS cnt FROM payments a INNER JOIN users b ON a.agent_id = b.id 
        GROUP BY a.agent_id ORDER BY cnt DESC;";
        return DB::connection('mysql')->select($query);
    }
}
