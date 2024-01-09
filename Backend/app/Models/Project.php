<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'startDate', 'endDate',];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($project) {
            $project->status = 'ongoing';
        });

        static::saving(function ($project) {
            if ($project->startDate >= $project->endDate) {
                return false;
            }
        });
    }
}
