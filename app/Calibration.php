<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calibration extends Model
{
    protected $fillable = [
        'register_id',
        'laboratory_id',
        'certificate_calibration',
        'results',
        'next_calibration'        
    ];
    
    public function register() {
        return $this->belongsTo(Register::class);
    }    
    
    public function laboratory() {
        return $this->belongsTo(Laboratory::class);
    }
}
