<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_member_id',
        'car_registration_number',
        'entry_time',
        'exit_time',
        'parking_space_number',
    ];

    public function studentMember()
    {
        return $this->belongsTo(StudentMember::class, 'student_member_id');
    }
}
