<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class TaskImage extends Model
{
    protected $fillable = ["task_id", "path"];

    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn() => asset('storage/' . $this->path),
        );
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

}
