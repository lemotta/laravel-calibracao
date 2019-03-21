<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Register;
use App\Laboratory;
//use Barryvdh\DomPDF\Facade as PDF;

class ReportsController extends Controller {

    private $register;
    private $laboratory;

    public function __construct(
    Register $register, Laboratory $laboratory
    ) {
        $this->middleware('auth');
        $this->register = $register;
        $this->laboratory = $laboratory;
    }
    
    public function default_report($id) {
        $register = $this->register->find($id);
        $laboratory = $this->laboratory->pluck('laboratory', 'id');
        return view('calibration.create', compact('register', 'laboratory'));
    }

    public function report159($id) {
        return 'REPORT 159 id: ' . $id;
    }

    public function report160($id) {
        return 'REPORT 160 id: ' . $id;
    }

    public function report161($id) {
        return 'REPORT 161 id: ' . $id;
    }

    public function report163($id) {
        return 'REPORT 163 id: ' . $id;
    }

    public function report164($id) {
        return 'REPORT 164 id: ' . $id;
    }

    public function report165($id) {
        return 'REPORT 165 id: ' . $id;
    }

    public function report170($id) {
        return 'REPORT 170 id: ' . $id;
    }

    public function report175($id) {
        return 'REPORT 175 id: ' . $id;
    }

    public function report205($id) {
        return 'REPORT 205 id: ' . $id;
    }

    public function report207($id) {
        return 'REPORT 207 id: ' . $id;
    }

    public function report213($id) {
        return 'REPORT 213 id: ' . $id;
    }

    public function report324($id) {
        $register = $this->register->find($id);
        $pattern = Register::join('modelofequipaments', 'registers.modelofequipament_id', '=', 'modelofequipaments.id')
                        ->join('departments', 'registers.department_id', '=', 'departments.id')
                        ->join('typeofequipaments', 'modelofequipaments.typeofequipament_id', '=', 'typeofequipaments.id')
                        ->select('registers.id', 'registers.number', 'departments.description')
                        ->where([
                                ['typeofequipaments.id', '=', $register->report->pattern1],
                                ['registers.is_pattern', '=', '1'],
                                ['registers.active', '=', '1']
                        ])->get();
        $pattern1 = array();
        foreach ($pattern as $xpattern) {
            $pattern1[$xpattern->id] = strtoupper($xpattern->description) . ' ' . str_pad($xpattern->number, 4, '0', STR_PAD_LEFT);
        }
        $pattern = Register::join('modelofequipaments', 'registers.modelofequipament_id', '=', 'modelofequipaments.id')
                        ->join('departments', 'registers.department_id', '=', 'departments.id')
                        ->join('typeofequipaments', 'modelofequipaments.typeofequipament_id', '=', 'typeofequipaments.id')
                        ->select('registers.id', 'registers.number', 'departments.description')
                        ->where([
                                ['typeofequipaments.id', '=', $register->report->pattern2],
                                ['registers.is_pattern', '=', '1'],
                                ['registers.active', '=', '1']
                        ])->get();
        $pattern2 = array();
        foreach ($pattern as $xpattern) {
            $pattern2[$xpattern->id] = strtoupper($xpattern->description) . ' ' . str_pad($xpattern->number, 4, '0', STR_PAD_LEFT);
        }
        return view('report.324', compact('register', 'pattern1', 'pattern2'));
        //return \PDF::loadView('report.324', compact('register', 'pattern1', 'pattern2'))
          //      ->download('asffasfds.pdf');
        //$pdf = PDF::loadView('report.pdf');
        //return $pdf->download('asffasfds.pdf');
        //return view('report.pdf');
        //$pdf    = PDF::setOptions([
        //    'images' => true
        //])->loadView('report.pdf')->setPaper('a4', 'portrait');
        //return $pdf->stream('carfact_sheet.pdf');
    }
}