<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'salary',
        'location',
        'requirements',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

}
