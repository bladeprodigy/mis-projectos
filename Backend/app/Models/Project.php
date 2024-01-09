<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'plannedEndDate', 'owner_id', 'participants', 'status'];


    protected static function booted()
    {
        static::creating(function ($project) {
            $project->status = 'ongoing';
        });
    
        static::saving(function ($project) {
            if ($project->startDate >= $project->plannedEndDate) {
                return false;
            }
        });
    }
    public function owner()
{
    return $this->belongsTo(User::class, 'owner_id');
}
}
