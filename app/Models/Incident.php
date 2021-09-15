<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $primaryKey = 'issue_id';
    public $timestamps = false;
    protected $table = 'issue';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'facility', 'issue', 'issue_type', 'affected_dept', 'status', 'priority', 'issue_date'
    ];
    
    public function facility ()
    {
        return $this->hasOne('App\Models\Facility', 'code', 'facility');
    }
}
