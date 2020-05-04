<?php

namespace App\Http\Controllers;

use App\Freelancer;
use App\Gigs;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    public function search(Request $request) {

        $searchResults = (new Search())
        ->registerModel(Gigs::class, 'gig_name', 'gig_payment')
        ->perform($request->input('query'));

    return view('search', compact('searchResults'));    
    }

    public function fsearch(Request $request) {
        $searchResults = (new Search())
        ->registerModel(Freelancer::class, 'skills', 'level_type')
        ->perform($request->input('query'));

           return view('fsearch', compact('searchResults')); 
    }

    public function gsearch(Request $request) {

        $searchResults = (new Search())
        ->registerModel(Gigs::class, 'gig_name', 'gig_payment')
        ->perform($request->input('query'));

    return view('gsearch', compact('searchResults'));    
    }
}
