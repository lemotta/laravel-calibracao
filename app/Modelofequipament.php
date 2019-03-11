<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelofequipament extends Model {
    
    protected $fillable = [
        'manufacturer_id',
        'typeofequipament_id',
        'model'
    ];

    public function manufacturer() {
        return $this->belongsTo(Manufacturer::class);
    }

    public function typeofequipament() {
        return $this->belongsTo(Typeofequipament::class);
    }

}
