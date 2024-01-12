<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject',
        'teacher',
        'frametime',
        'starttime',
        'endtime',
        'startdate',
        'enddate',
        'class_name',
        'note',
        'created_at',
        'updated_at',
    ];
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
