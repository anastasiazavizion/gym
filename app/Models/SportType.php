<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SportType extends Model
{
    protected $fillable = ['name'];

    public function trainers() : BelongsToMany
    {
        return $this->belongsToMany(Trainer::class);

    }
}
