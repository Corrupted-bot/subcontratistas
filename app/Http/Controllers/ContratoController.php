<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Subcontratista;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contrato = new Contrato();
        $contrato->nombre = $request->nombre;
        $contrato->id_subcontratista = $request->id_subcontratista;
        $contrato->save();
        return redirect("/contrato/".$request->id_subcontratista);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $viewData = $this->loadViewData();
        try {
            $viewData['userEmail'] = $viewData['userEmail'];
            $contratos = Contrato::where("id_subcontratista",$id)->get();
            $subcontratista = Subcontratista::find($id);
            return View("contrato",$viewData)->with("contratos",$contratos)->with("subcontratista",$subcontratista);
        } catch (\Throwable$th) {
            return redirect("/");
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function contratoExterno()
    {

        $viewData = $this->loadViewData();
        try {
            $viewData['userEmail'] = $viewData['userEmail'];
            $contratos = Contrato::where("id_subcontratista",$viewData['department'])->get();
            $subcontratista = Subcontratista::find($viewData['department']);
            return View("contratoExterno",$viewData)->with("contratos",$contratos)->with("subcontratista",$subcontratista);
        } catch (\Throwable$th) {
            return redirect("/");
        }

    }



}
