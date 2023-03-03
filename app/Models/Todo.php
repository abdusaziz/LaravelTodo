<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id'
    ];

    // OneToOne Relationship with User model
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    // OneToOne Relationship with Task model
    public function task()
    {
        return $this->hasOne(Task::class);
    }
}
