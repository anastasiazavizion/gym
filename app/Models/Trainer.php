<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Trainer extends Model
{
    protected $fillable = ['name', 'phone', 'email'];

    public function sportTypes() : BelongsToMany
    {
        return $this->belongsToMany(SportType::class);

    }
}
