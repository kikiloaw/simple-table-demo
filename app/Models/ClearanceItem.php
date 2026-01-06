<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClearanceItem extends Model
{
    protected $fillable = ['name', 'clearance_group_id'];

    public function group()
    {
        return $this->belongsTo(ClearanceGroup::class, 'clearance_group_id');
    }
}
