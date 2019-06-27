<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ModelOfEquipamentFormRequest;
use App\Modelofequipament;
use App\Manufacturer;
use App\Typeofequipament;

class ModelOfEquipamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $modelofequipament;
    private $manufacturer;
    private $typeofequipament;
    
    public function __construct(
            Modelofequipament $modelofequipament,
            Manufacturer $manufacturer,
            Typeofequipament $typeofequipament
            ) {
        $this->middleware('auth');
        $this->modelofequipament = $modelofequipament;
        $this->manufacturer = $manufacturer;
        $this->typeofequipament = $typeofequipament;
    }
            
    public function index()
    {
        $modelofequipaments = $this->modelofequipament->all();
        return view('equipament.index', compact('modelofequipaments'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manufacturer = $this->manufacturer->pluck('name', 'id');
        $typeofequipament = $this->typeofequipament->pluck('type', 'id');        
        return view('equipament.create-edit', compact('manufacturer','typeofequipament'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModelOfEquipamentFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->modelofequipament->create($dataForm);
        if ($insert) {
            return redirect()->route('models_eqp.index')->with(['success' => 'Created register!']);
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
    public function show($id)
    {
        $modelofequipament = $this->modelofequipament->find($id);
        return view('equipament.show', compact('modelofequipament'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modelofequipament = $this->modelofequipament->find($id);
        $manufacturer = $this->manufacturer->pluck('name', 'id');
        $typeofequipament = $this->typeofequipament->pluck('type', 'id');        
        return view('equipament.create-edit', compact('modelofequipament','manufacturer','typeofequipament'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModelOfEquipamentFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $modelofequipament = $this->modelofequipament->find($id);
        $update = $modelofequipament->update($dataForm);
        if ($update) {
            return redirect()->route('models_eqp.index');
        } else {
            return redirect()->route('models_eqp.edit', $id)->with(['errors' => 'edit failure']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modelofequipament = $this->modelofequipament->find($id);
        $delete = $modelofequipament->delete();
        if ($delete) {
            return redirect()->route('models_eqp.index');
        } else {
            return redirect()->route('models_eqp.show', $id)->with(['errors' => 'delete failure']);
        }
    }
}
