<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClearanceGroup extends Model
{
    protected $fillable = ['name'];

    public function items()
    {
        return $this->hasMany(ClearanceItem::class);
    }
}
