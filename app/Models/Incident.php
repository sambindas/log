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
        'facility', 'issue', 'issue_type', 'affected_dept', 'status', 'priority', 'issue_date', 'issue_level',
        'issue_client_reporter', 'support_officer', 'issue_reported_on', 'resolution_date', 'resolved_by', 'item',
        'info_relayed_to', 'info_medium', 'month', 'user', 'type', 'state_id', 'is_bump', 'module', 'email_to_client',
    ];
    
    public function facility ()
    {
        return $this->hasOne('App\Models\Facility', 'code', 'facility');
    }
}
