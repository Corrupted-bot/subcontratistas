<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AuthController;
use App\TokenStore\TokenCache;
use DB;
use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Session;
use Illuminate\Support\Facades\Redirect;
class PowerController extends Controller
{

    //VISUALIZAR LA VISTA DE REPORTES
    public function index()
    {
        $viewData = $this->loadViewData();
        try {
            $viewData['userEmail'] = $viewData['userEmail'];
        } catch (\Throwable$th) {
            return redirect("/");
        }

        // $graph = new Graph();
        // $graph->setAccessToken(session('accessToken'));

        // $totalUsarios = $graph->createRequest('GET', '/users/$count')
        //     ->addHeaders(array("ConsistencyLevel" => "eventual"))
        //     ->execute();

        // $NUMERO_TOTAL = round(($totalUsarios->getBody()/100)+1);
        // $i = 1;
        // $totalpersonas = 0;
        // while ($i <= $NUMERO_TOTAL) {
        //     if($i == 1){
        //         $users = $graph->createRequest('GET', '/users?$select=displayName,mail,department')
        //         ->execute();
        //         // print_r($users->getBody()["value"]);
        //         foreach ($users->getBody()["value"] as $user) {
        //             print_r("<li>".$user["displayName"]."-".$user["mail"]."-".$user["department"]."</li>");
        //         }
        //         $totalpersonas = $totalpersonas + count($users->getBody()["value"]);
        //     }else{
        //         $users = $graph->createRequest('GET', str_replace("https://graph.microsoft.com/v1.0","",$users->getBody()["@odata.nextLink"]))
        //         ->execute();
        //         // print_r($users->getBody()["value"]);
        //         foreach ($users->getBody()["value"] as $user) {
        //             print_r("<li>".$user["displayName"]."-".$user["mail"]."-".$user["department"]."</li>");
        //         }
        //         $totalpersonas = $totalpersonas + count($users->getBody()["value"]);
        //     }
        //     $i = $i + 1;
        // }

        // print_r($totalpersonas);
        $reportes_asignados = DB::table("reportes_asignados")
        ->where("correo","=",$viewData['userEmail'])
        ->get();
        $salida = [];
        foreach ($reportes_asignados as $value) {

            $reportes = DB::table("reportes")
            ->where("id","=",$value->id_reporte)
            ->get();

            $salida = array_merge(json_decode($reportes),$salida);


        }



        return view("powerbi", $viewData)->with("reportes_asiganados",$salida);
    }

    //VISUALIZAR LA VISTA PARA ASIGNAR
    public function Asignar()
    {
        $viewData = $this->loadViewData();
        try {
            $viewData['userEmail'] = $viewData['userEmail'];
        } catch (\Throwable$th) {
            return redirect("/");
        }
        return View("asignar", $viewData);
    }

    public function CrearReporte()
    {
        //AUTENTICACION
        $viewData = $this->loadViewData();
        try {
            $viewData['userEmail'] = $viewData['userEmail'];
        } catch (\Throwable$th) {
            return redirect("/");
        }
        return View("crearReporte", $viewData);
    }


    public function AsignarReportes(Request $request){

        DB::table('reportes_asignados')
        ->where('correo',"=",$request->prodId)
        ->delete();
        
        foreach ($request->duallistbox_demo1 as $value) {
            DB::table('reportes_asignados')->insert([
                'correo' => $request->prodId,
                'id_reporte' => $value,
            ]);
        }

        Session::flash('message', "Se agrego correctamente el reporte.");
        Session::flash('verificar', 1);
        return Redirect::back();
        //buscar si ya estan asignados




    }


    public function ObtenerAsignaciones($correo){
        

        $datos = DB::table("reportes_asignados")
        ->where("correo","=",$correo)
        ->get();
        $html = "";

        $datosReporte = DB::table("reportes")
        ->get();

        foreach ($datosReporte as  $value) {
            $cont = 0;
            foreach ($datos as $aux) {
                if($value->id == $aux->id_reporte){
                    $html .= '<option value="'.$value->id.'" selected>'.$value->nombre_reporte."</option>" ;
                    $cont = 1;
                }
            }
            if($cont==0){
                //agregar a no selected
                $html .= '<option value="'.$value->id.'">'.$value->nombre_reporte."</option>" ;
            }
        }

        return $html;
        

    }







    //API PARA CREAR REGISTROS DE INFORMES POWERBI
    public function AgregarRegistro(Request $request)
    {

        DB::table('reportes')->insert([
            'nombre_reporte' => $request->NombreReporte,
            'url_reporte' => $request->LinkReporte,
        ]);
        Session::flash('message', "Se agrego correctamente el reporte.");
        Session::flash('verificar', 1);
        return Redirect::back();
    }

    //API PARA OBTENER USUARIOS DE UN CENTRO DE COSTO EN ESPECIFICO
    //FALTA AGREGAR LOS SUB-CENTRO DE COSTO

    public function DatosUsuarios($cc)
    {
        if($cc == "Externos"){
            $datos = DB::table("usuarios")
            ->get();
            return $datos;

        }
        $graph = new Graph();
        $objeto = new TokenCache();
        $graph->setAccessToken($objeto->getAccessToken());
        //PARA EL NUMERO
        $dataInicial = $graph->createRequest('GET', '/users?$filter=startsWith(department,' . "'$cc'" . ') OR startsWith(department,' . "'CC$cc'" . ')&$select=displayName,mail,department&$top=999')
            ->addHeaders(array("ConsistencyLevel" => "eventual"))
            ->execute();

        return $dataInicial->getBody()["value"];

    }
}
