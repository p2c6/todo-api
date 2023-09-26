<?php

namespace App\Models\Todo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class TodoItem extends Model
{
    use HasFactory;

    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }
}
