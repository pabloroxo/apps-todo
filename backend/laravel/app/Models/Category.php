<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'color',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
