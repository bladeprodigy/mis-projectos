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
        return $this->belongsTo('App\Models\User');
    }
}
