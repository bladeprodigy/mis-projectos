<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'User_id', 'Name', 'StartDate', 'EndDate', 'Status', 'Participants', 'Description',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
    protected static function booted()
    {
        static::creating(function ($project) {
            $project->Status = 'Ongoing';
        });

        static::saving(function ($project) {
            if ($project->StartDate >= $project->EndDate) {
                return false;
            }
        });
    }
    
}