<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        "title",
        "description",
        "user_id",
        "priority",
        "completed",
        "due_date",
        "creator_id",
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, "creator_id");
    }


    public function assignee()
    {
        return $this->belongsTo(User::class, "user_id");
    }


    public function comments()
    {
        return $this->morphMany(Comment::class, "commentable");
    }
}
