<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'todo_id',
        'status'
    ];
    public function todo()
    {
        return $this->belongsTo(todo::class);
    }
}
