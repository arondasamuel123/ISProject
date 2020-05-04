<?php

namespace App\Http\Controllers;

use App\Charts\UserChart;
use Illuminate\Http\Request;
use App\User;
use DB;
use App\Gigs; 
use App\Checklist;  



class ChartController extends Controller
{
    public function index() {
        $freelancers= DB::table('users')->where('user_type', 'Freelancer')->count();
        $clients = DB::table('users')->where('user_type', 'Client')->count();
       //return $users;
       $completed= DB::table('gigs')->where('is_complete', 1)->count();
       $total = Gigs::count();
       $percent = $completed / $total * 100;

       $notcompleted= DB::table('gigs')->where('is_complete', 0)->count();
       $total = Gigs::count();
       $npercent = $notcompleted / $total * 100;

       $done = DB::table('checklists')->where('done', 1)->count();
        $total = Checklist::count();
        $percent = $done / $total * 100;

        $ndone = DB::table('checklists')->where('done', 0)->count();
        $total = Checklist::count();
        $dpercent = $ndone / $total * 100;

                    
        $chart = new UserChart;
        $chart->labels(['2019', '2020']);
        $chart->dataset('Freelancers', 'bar', [$freelancers])->backgroundcolor('blue');
        $chart->dataset('Clients', 'bar', [$clients])->backgroundcolor('green');
        $chart->title('Number of Freelancers and Clients');



        
        
        $pie = new UserChart;
        $pie->labels(['Completed','Not Completed']);
        $pie->dataset('Completed','pie',[$percent, $npercent])->backgroundcolor(collect(['#7158e2','#3ae374']));
        
        // $pie->dataset('NotCompleted','pie',[$npercent])->backgroundcolor('green');
        $pie->title('Gigs Completion Rate ');

        $pie2 = new UserChart;
        $pie2->labels(['Done','Not Done']);
        $pie2->dataset('Completed','pie',[$percent, $dpercent])->backgroundcolor(collect(['#33FFDD','#FCFF33']));
        $pie2->title('Requirements Completion rate');

        

        return view('chart',compact('chart', 'pie', 'pie2'));  
    }
}
