<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Records extends Model
{
    protected $fillable = [
        'fname',
        'lname',
        'mname',
        'gender',
        'birthdate',
        'civil_status',
        'unique_id_num',
        'address',
        'city',
        'province',
        'region',
        'phone_num',
        'tel_num',
        'status',
    ];
}
