<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;


class Gigs extends Model implements Searchable
{
    protected $primaryKey= 'gig_id';

    protected $fillable = [
        'gig_name', 'gig_description', 'gig_duration', 'gig_payment','is_complete', 'project_files'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function bids() {
        return $this->hasMany(Bid::class);
    }
    public function milestones() {
        return $this->hasMany(Checklist::class);
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('gig.show', $this->gig_id);
       $gig = $this;

        return new SearchResult(
            $gig,
            $this->gig_name,
            $url
           
            
         );
    }
    

}
