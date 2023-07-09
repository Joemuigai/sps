<?php

namespace App\Models;

use App\Models\User;
use App\Models\StudentMemberFile;
use App\Models\StudentMemberPhoto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_id',
        'expiry_date',
        'national_id',
        'passport_no',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'disabled',
        'mobile',
        'address',
        'course_faculty',
        'mode_of_study',
        'status',
    ];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function student_photo()
    {
        return $this->hasOne(StudentMemberPhoto::class, 'student_id');
    }

    public function student_id_copy()
    {
        return $this->hasOne(StudentMemberFile::class, 'student_id');
    }
}
