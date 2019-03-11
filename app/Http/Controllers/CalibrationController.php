<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Register;
use App\Calibration;

class CalibrationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $register;
    private $calibration;

    public function __construct(
    Register $register, Calibration $calibration) {
        $this->middleware('auth');
        $this->register = $register;
        $this->calibration = $calibration;
    }

    public function index() {
        $calibration = $this->calibration->all();
        return view('calibration.index', compact('calibration'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $dataForm = $request->all();
        unset($dataForm['_token']);
        $register = $this->register->find($dataForm['id']);
        $period = '+' . $register->period->period_at_month . ' months';
        $calibration = [
            'register_id' => intval($dataForm['id']),
            'laboratory_id' => 8, //id do laboratorio interno
            'certificate_calibration' => null,
            'results' => serialize($dataForm),
            'next_calibration' => date('Y-m-d', strtotime($period, strtotime(date("Y-m-d"))))
        ];
        $insert = $this->calibration->create($calibration);
        if ($insert) {
            return redirect()->route('calibration.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
