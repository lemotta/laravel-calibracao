<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\RegisterFormRequest;
use App\Register;
use App\Department;
use App\Modelofequipament;
use App\Period;
use App\Report;
use App\Instruction;

class RegisterController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $register;
    private $department;
    private $modeloofequipament;
    private $period;
    private $report;
    private $instruction;

    public function __construct(
    Register $register, Department $department, Modelofequipament $modeloofequipament, Period $period, Report $report, Instruction $instruction) {
        $this->middleware('auth');
        $this->register = $register;
        $this->department = $department;
        $this->modeloofequipament = $modeloofequipament;
        $this->period = $period;
        $this->report = $report;
        $this->instruction = $instruction;
    }

    public function index() {
        $registers = $this->register->paginate(5);
        return view('register.index', compact('registers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $department = $this->department->pluck('description', 'id');
        $modeloofequipament = $this->modeloofequipament->pluck('model', 'id');
        $period = $this->period->pluck('period_at_month', 'id');
        $period[] = 'no calibration required';        
        $report = $this->report->pluck('number', 'id');
        $report[] = 'no report';
        $instruction = $this->instruction->pluck('description', 'id');
        return view('register.create-edit', compact('department', 'modeloofequipament', 'period', 'report', 'instruction'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterFormRequest $request) {
        $dataForm = $request->all();
        $period = $this->period->find($dataForm['period_id']);
        $report = $this->report->find($dataForm['report_id']);
        if(!isset($period)) {
            $dataForm['period_id'] = null;
            $dataForm['require_calibration'] = '0';
        } else {
            $dataForm['require_calibration'] = '1';
        }        
        if(!isset($report)) {
            $dataForm['report_id'] = null;
        }        
        $insert = $this->register->create($dataForm);
        if ($insert) {
            return redirect()->route('registers.index')->with(['success' => 'Created register!']);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $register = $this->register->find($id);
        return view('register.show', compact('register'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $register = $this->register->find($id);
        $department = $this->department->pluck('description', 'id');
        $modeloofequipament = $this->modeloofequipament->pluck('model', 'id');
        $period = $this->period->pluck('period_at_month', 'id');
        $period[] = 'no calibration required';
        $report = $this->report->pluck('number', 'id');
        $instruction = $this->instruction->pluck('description', 'id');
        return view('register.create-edit', compact('register', 'department', 'modeloofequipament', 'period', 'report', 'instruction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegisterFormRequest $request, $id) {
        $dataForm = $request->all();
        $register = $this->register->find($id);
        $period = $this->period->find($dataForm['period_id']);
        $report = $this->report->find($dataForm['report_id']);
        if(!isset($dataForm['active'])) {
            $dataForm['active'] = '0';
        } else {
            $dataForm['active'] = '1';
        }
        if(!isset($dataForm['is_pattern'])) {
            $dataForm['is_pattern'] = '0';
        } else {
            $dataForm['is_pattern'] = '1';
        }
        if(!isset($period)) {
            $dataForm['period_id'] = null;
            $dataForm['require_calibration'] = '0';
        } else {
            $dataForm['require_calibration'] = '1';
        }        
        if(!isset($report)) {
            $dataForm['report_id'] = null;
        }
        $update = $register->update($dataForm);
        if ($update) {
            return redirect()->route('registers.index');
        } else {
            return redirect()->route('registers.edit', $id)->with(['errors' => 'edit failure']);
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $register = $this->register->find($id);
        $delete = $register->delete();
        if ($delete) {
            return redirect()->route('registers.index');
        } else {
            return redirect()->route('registers.show', $id)->with(['errors' => 'delete failure']);
        }
    }

}
