<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $fillable = ['rally_id', 'stage_number', 'stage_name', 'distance_km'];

    public function rally() {
        return $this->belongsTo(Rally::class);
    }
}