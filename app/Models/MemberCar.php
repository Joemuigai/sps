<?php

namespace App\Models;

use App\Models\StudentMember;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberCar extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_member_id',
        'registration_number',
        'make',
        'model',
        'color',
        'registration_date',
        'status',
        'expiry_date',
    ];

    public function studentMember()
    {
        return $this->belongsTo(StudentMember::class, 'student_member_id');
    }
}
