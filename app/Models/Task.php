<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;
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

    public function images()
    {
        return $this->hasMany(TaskImage::class);
    }

    public function sluggable():array
    {
        return [
            "slug" => [
                "source" => "title"
            ]
        ];
    }
}
