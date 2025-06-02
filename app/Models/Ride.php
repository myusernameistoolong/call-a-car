<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'arrive_date',
        'arrive_time',
        'dest_country',
        'dest_city',
        'dest_street',
        'start_country',
        'start_city',
        'start_street',
        'distance',
        'costs'
    ];
}
