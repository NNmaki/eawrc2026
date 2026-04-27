<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rally extends Model
{
    protected $fillable = ['rally_name', 'country', 'total_distance'];

    public function stages() {
        return $this->hasMany(Stage::class);
    }
}