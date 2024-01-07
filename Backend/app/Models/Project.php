<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
    'name', 'start_date', 'end_date_planned', 'status', 'participants', 'owner_id', 'description',
    ];

    public function owner()
    {
    return $this->belongsTo(User::class, 'owner_id');
    }
}
