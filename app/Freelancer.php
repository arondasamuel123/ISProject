<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Freelancer extends Model implements Searchable
{
  protected $primaryKey= 'freelancer_id';
    protected $fillable = [
        'skills', 'bio', 'level_type','status'
    ];

   
    public function user() {
      return $this->belongsTo(User::class, 'id');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('freelancer.show', $this->freelancer_id);

        return new SearchResult(
            $this,
            $this->skills,
            $url
         );
    }

}
