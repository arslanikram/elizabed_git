<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fabric;
use App\Models\Color;

class FabricColor extends Model
{
    use HasFactory;

    public function fabric()
    {
    	return $this->belongsTo(Fabric::class,'fabric_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class,'color_id');
    }
}
