<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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
        $calibration = Calibration::join('registers', 'calibrations.register_id', 'registers.id')
                ->whereRaw('registers.active = 1 AND calibrations.id IN (SELECT MAX(calibrations.id) from calibrations group by calibrations.register_id)')
                ->groupBy('calibrations.register_id')
                ->select('calibrations.*')
                ->paginate(10);
        return view('calibration.index', compact('calibration'));
    }

    public function alarms() {
        $calibration = Calibration::join('registers', 'calibrations.register_id', 'registers.id')
                ->whereRaw('registers.active = 1 AND calibrations.id IN (SELECT MAX(calibrations.id) from calibrations group by calibrations.register_id)')
                ->groupBy('calibrations.register_id')
                ->select('calibrations.*')
                ->where('calibrations.next_calibration','<', Carbon::now()->addDays(30) )
                ->paginate(10);
        return view('calibration.alarms', compact('calibration'));
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
                if ($key == 'REPROVADO' || $key == 'ERRO') {
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
                    $register_pattern = $this->register->find($patterns[$i]);
                    if ($register_pattern->require_calibration) {
                        $calpattern = $this->register->calibration($patterns[$i]);
                        if (isset($calpattern)) {
                            if (strtotime(date('Y-m-d')) > strtotime($calpattern->next_calibration)) {
                                $msg = strtoupper($calpattern->register->department->description) . ' ' . str_pad($calpattern->register->number, 4, '0', STR_PAD_LEFT) . ' - ';
                                $msg .= 'Selecionado como padrão, não tem data de calibração válida.';
                                return view('calibration.error', compact('msg'));
                            }
                            $dataForm['patterns'] [] = array([$patterns[$i], $calpattern->id]);
                        } else {
                            $msg = 'Padrão Selecionado sem Calibração vigente Reprovado! Isto impossibilita a geração do registro calibração --> ' . $patterns[$i];
                            return view('calibration.error', compact('msg'));
                        }
                    } else {
                        $dataForm['patterns'] [] = array([$patterns[$i], null]);
                    }
                }
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
        $calibration = Calibration::
                where('calibrations.register_id','=', $id)
                ->latest('calibrations.id')
                ->paginate(10);
        return view('calibration.index', compact('calibration'));
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
        for ($i = 0; $i < count($results['patterns']); $i++) {
            if (isset($results['patterns'][$i][0][1])) {
                $pattern = $results['patterns'][$i][0][1];
                $patterns[] = $this->calibration->find($pattern);
            } else {
                $pattern = $results['patterns'][$i][0][0];
                $patterns[] = $this->register->find($pattern);
            }
        }
        unset($results['patterns']);
        unset($results['status']);

        $pdf = PDF::setOptions([
                    'images' => true,
                    'isPhpEnabled' => true
                ])->loadView('calibration.print', compact('calibration', 'results', 'patterns', 'status'))->setPaper('a4', 'portrait');
        return $pdf->stream('formulario.pdf');
    }

    public function tag($id) {
        $calibration = $this->calibration->find($id);
        $content = "~JA\n" .
                "^XA\n" .
                "^PRA\n" .
                "^FO150,030^AEN,8,8^FDCALIBRADO^FS\n" .
                "^FO025,80^GB410,0,3^FS\n" .
                "^FO025,120^ADN,8,4^FDSERIAL: " . $calibration->register->serialnumber . " / " . strtoupper($calibration->register->department->description) . " " . str_pad($calibration->register->number, 4, '0', STR_PAD_LEFT) . "^FS\n" .
                "^FO025,150^ADN,8,4^FDVALIDADE: " . date('M j, Y', strtotime($calibration->next_calibration)) . "^FS\n" .
                "^FO025,180^ADN,8,4^FDRESPONSAVEL: " . ucwords(auth()->user()->name) . "^FS\n" .
                "^FO025,010^XGp14,1,1^FS\n" .
                "^PQ0001,0,1,Y\n" .
                "^BY1,2.5:1,9\n" .
                "^XZ\n";
        $diskLocal = Storage::disk('local');
        $diskLocal->put("print.zpl", $content);
        $output = "smbclient " . config('app.addr_print', null) .
                " --workgroup=" . config('app.domain', null) .
                " --user=" . config('app.user_print', null) .
                " --pass \"" . config('app.pass_print', null) . "\"" .
                " --command=\"put print.zpl print.zpl;\"";

        exec($output, $error, $return);

        if ($return == 0) {
            return redirect()->route('calibration.index');
        } else {
            $msg = "Failure command: " . $output;
            return view('calibration.error', compact('msg'));
        }
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
