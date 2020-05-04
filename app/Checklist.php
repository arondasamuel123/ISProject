<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $fillable = [
        'milestone' ,'done', 'user_id' ,'g_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function gig() {
        return $this->belongsTo(Gigs::class, 'gig_id');
    }

    public function mark() {
        $this->done = $this->done ? 0 : 1; 
        $this->save();
    }

}
