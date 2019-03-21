<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model {

    protected $fillable = [
        'department_id',
        'number',
        'serialnumber',
        'modelofequipament_id',
        'require_calibration',
        'is_pattern',
        'period_id',
        'report_id',
        'instruction_id',
        'contact'
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function modelofequipament() {
        return $this->belongsTo(Modelofequipament::class);
    }

    public function period() {
        return $this->belongsTo(Period::class);
    }

    public function report() {
        return $this->belongsTo(Report::class);
    }

    public function instruction() {
        return $this->belongsTo(Instruction::class);
    }
    
    public function calibration($id) {
        return Calibration::where('register_id', $id)->orderBy('register_id', 'desc')->first();
    }

}
