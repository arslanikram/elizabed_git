<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FabricColor;

class Color extends Model
{
    use HasFactory;

    public function fabricColor()
    {
        return $this->hasMany(FabricColor::class, 'color_id');
    }
}
