<?php

namespace App\Models;

use App\Models\StudentMember;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentMemberPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'file_path',
        'file_type',
        'file_name',
        'disk',
    ];

    public function student_member()
    {
        return $this->belongsTo(StudentMember::class, 'student_id');
    }
}
