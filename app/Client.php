<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $primaryKey= 'client_id';
    protected $fillable = [
        'company_name', 'bio', 'kra_pin','company_cert', 'status'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
      }
}
