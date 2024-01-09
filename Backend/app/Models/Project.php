<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'startDate', 'endDate', 'user_id', 'status'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }
    protected static function booted()
    {
        static::creating(function ($project) {
            $project->Status = 'ongoing';
        });

        static::saving(function ($project) {
            if ($project->StartDate >= $project->EndDate) {
                return false;
            }
        });
    }
    
}
