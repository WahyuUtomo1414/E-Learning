<?php

namespace App\Models;

use App\Models\Major;
use App\Models\School;
use App\Models\Teacher;
use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentClassroomsMapping;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    use HasFactory, Notifiable, SoftDeletes, AuditedBySoftDelete;
    protected $table = 'classroom';
    protected $guarded = ['id'];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
    
    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function studentMappings()
    {
        return $this->hasMany(StudentClassroomsMapping::class, 'class_id');
    }

    public function students()
    {
        return $this->hasMany(StudentClassroomsMapping::class, 'class_id');
    }

    // Akses langsung nama siswa dari relasi user
    public function studentNames()
    {
        return $this->studentMappings->map(fn($m) => $m->student->user->name ?? '-')->implode(', ');
    }
    
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
