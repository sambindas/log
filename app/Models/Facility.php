<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $primaryKey = 'facility_id';
    public $timestamps = false;
    protected $table = 'facility';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'code', 'contact_person', 'contact_person_phone', 'server_ip', 'online_url'
    ];
    
}
