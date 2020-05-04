<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function clients() {
        return $this->hasMany(Client::class);
    }
    
    public function freelancers() {
        return $this->hasMany(Freelancer::class, 'user_id');
    }

    public function portfolios(){
    	return $this->hasMany(Portfolio::class);
    }

    public function gigs() {
        return $this->hasMany(Gigs::class);
    }
    public function bids() {
        return $this->hasMany(Bid::class);
    }
    public function milestones() {
        return $this->hasMany(Checklist::class);
    }
}
