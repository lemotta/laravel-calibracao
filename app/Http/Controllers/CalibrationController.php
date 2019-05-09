<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Register;
use App\Calibration;
use Barryvdh\DomPDF\Facade as PDF;

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
        /*
         * SELECT
          calibrations.register_id AS register_id,
          MAX(calibrations.next_calibration) AS next_calibration
          FROM
          calibrations INNER JOIN registers ON calibrations.register_id = registers.id
          WHERE
          registers.active = 1
          GROUP BY
          register_id
         */
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

        $id = $dataForm['id'];
        unset($dataForm['_token']);
        unset($dataForm['id']);

        $register = $this->register->find($id);
        $period = '+' . $register->period->period_at_month . ' months';

        $status = 'APROVADO';

        if (count($dataForm) > 3) { // array maior, indica leituras de formulario            
            foreach ($dataForm as $key) {
                if ($key == 'REPROVADO') {
                    $status = 'REPROVADO';
                }
            }
            if (strcmp($status, "APROVADO") == 0) {
                $patterns = array();
                for ($i = 1; $i < count($dataForm); $i++) {
                    if (array_key_exists('pattern' . $i . '_id', $dataForm)) {
                        $patterns[] = intval($dataForm['pattern' . $i . '_id']);
                        unset($dataForm['pattern' . $i . '_id']);
                    }
                }
                $cal_pattern = array();
                for ($i = 0; $i < count($patterns); $i++) {
                    $calpattern = $this->register->calibration($patterns[$i]);
                    if (isset($calpattern)) {
                        array_splice($patterns, $i, 1);
                        if (strtotime(date('Y-m-d')) > strtotime($calpattern->next_calibration)) {
                            $msg = strtoupper($calpattern->register->department->description) . ' ' . str_pad($calpattern->register->number, 4, '0', STR_PAD_LEFT) . ' - ';
                            $msg .= 'Selecionado como padrão, não tem data de calibração válida.';
                            return view('calibration.error', compact('msg'));
                        }
                        $cal_pattern[] = $calpattern->id;
                    }
                }
                $dataForm['patterns'] ['register'] = $patterns;
                $dataForm['patterns'] ['calibration'] = $cal_pattern;
                $dataForm['status'] = $status;
                $calibration = [
                    'register_id' => intval($id),
                    'laboratory_id' => 8, //id do laboratorio interno
                    'certificate_calibration' => null,
                    'results' => serialize($dataForm),
                    'user_id' => Auth::user()->id,
                    'next_calibration' => date('Y-m-d', strtotime($period, strtotime(date("Y-m-d"))))
                ];
            } else {
                $msg = 'Formulario Reprovado! Isto impossibilita a geração do registro calibração.';
                return view('calibration.error', compact('msg'));
            }
        } else {
            $calibration = [
                'register_id' => intval($id),
                'laboratory_id' => $dataForm['laboratory_id'], //id do laboratorio interno
                'certificate_calibration' => $dataForm['certificate_calibration'],
                'results' => null,
                'user_id' => Auth::user()->id,
                'next_calibration' => date('Y-m-d', strtotime($period, strtotime(date("Y-m-d"))))
            ];
        }
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

    public function report($id) {
        $calibration = $this->calibration->find($id);
        $results = unserialize($calibration['results']);
        $status = $results['status'];
        $patterns = array();
        foreach ($results['patterns']['register'] as $pattern) {
            $patterns[] = $this->register->find($pattern);
        }
        foreach ($results['patterns']['calibration'] as $pattern) {
            $patterns[] = $this->calibration->find($pattern);
        }
        unset($results['patterns']);
        unset($results['status']);
        $pdf = PDF::setOptions([
                    'images' => true
                ])->loadView('calibration.print', compact('calibration', 'results', 'patterns', 'status'))->setPaper('a4', 'portrait');
        return $pdf->stream('formulario.pdf');
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
