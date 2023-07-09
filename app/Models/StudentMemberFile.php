<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentMember;

class StudentMemberFile extends Model
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
