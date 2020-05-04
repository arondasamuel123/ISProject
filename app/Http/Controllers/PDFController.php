<?php

namespace App\Http\Controllers;

use App\Checklist;
use App\Freelancer;
use App\Gigs;
use PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
   public function getgigscompleted() {
       $gigs = Gigs::where('is_complete', 1)->get();
       $completed= Gigs::where('is_complete', 1)->count();
       $total = Gigs::count();
       $percent = $completed / $total * 100;

       $pdf = PDF::loadView('gigscomplete',['gigs'=>$gigs], ['percent'=>$percent]);
       return $pdf->download('gigscompleted.pdf');
       //return $percent;

   }

   public function gigclassification() {
       $classifications = Gigs::all();
       $pdf = PDF::loadView('gigsclassification',['classifications'=>$classifications]);
       return $pdf->download('gigsclassifications.pdf');
   }
   public function requirementscompleted() {
       $checklists = Checklist::where('done', 1)->get();
        $done = Checklist::where('done', 1)->count();
        $total = Checklist::count();
        $percent = $done / $total * 100;
        $pdf = PDF::loadView('completedreq',['checklists'=>$checklists], ['percent'=>$percent]);
        return $pdf->download('requirementscompleted.pdf');
        //return $percent;
   }
   public function skillsclassification() {
       $skills = Freelancer::all();
       $pdf = PDF::loadView('skillsclassified',['skills'=>$skills]);
        return $pdf->download('skillsclassified.pdf');
       //return $skills;
   }
}
