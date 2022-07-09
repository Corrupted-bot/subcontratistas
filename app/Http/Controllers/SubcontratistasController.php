<?php

namespace App\Http\Controllers;

use App\Models\Subcontratista;
use Illuminate\Http\Request;
class SubcontratistasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viewData = $this->loadViewData();
        try {
            $viewData['userEmail'] = $viewData['userEmail'];
            $subcontratistas = Subcontratista::all();
            return View("subcontratistas", $viewData)->with("subcontratistas",$subcontratistas);
        } catch (\Throwable$th) {
            return redirect("/");
        }
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

        $subcontratista = new Subcontratista();
        $subcontratista->razon_social = $request->razonsocial;
        $subcontratista->representante_legal = $request->representantelegal;
        $subcontratista->numero_contacto = $request->contacto;
        $subcontratista->contacto_comercial = $request->contactocomercial;
        $subcontratista->direccion = $request->direccion;
        $subcontratista->correo = $request->correo;
        $subcontratista->persona_jej = $request->personajej;
        $subcontratista->disciplina = $request->disciplina;
        $subcontratista->save();
        return redirect("/subcontratistas");


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
