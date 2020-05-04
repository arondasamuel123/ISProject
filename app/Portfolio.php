<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'project_url', 'overview'
    ];

    
    public function user() {
      return $this->belongsTo(User::class);
    }
}
