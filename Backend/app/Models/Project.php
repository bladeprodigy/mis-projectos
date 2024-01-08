<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

class Project extends Model
{
    protected $fillable = ['name', 'start_date', 'end_date_planned', 'status', 'participants', 'owner_id', 'description'];

    protected $casts = [
        'status' => 'boolean',
    ];
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
