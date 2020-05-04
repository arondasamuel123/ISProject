<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $primaryKey= 'id';
        protected $fillable =['project_period', 'cover_letter', 'amount', 'g_id','f_id', 'status'];

        public function gig() {
            return $this->belongsTo(Gigs::class, 'g_id');
        }

        public function user() {
            return $this->belongsTo(User::class);
        }
}
