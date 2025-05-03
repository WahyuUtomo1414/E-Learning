<?php

namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory, Notifiable, SoftDeletes, AuditedBySoftDelete;
    protected $table = 'student';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function classrooms()
    {
        return $this->hasMany(StudentClassroomsMapping::class, 'student_classrooms_mapping', 'student_id', 'classroom_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
