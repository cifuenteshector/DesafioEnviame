<?php

namespace App\Http\Controllers;

use App\Models\Companys;
use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ValidateController;

class CompanyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            //Valida que el metodo sea de tipo POST
            if($request->method('POST')){
                //Valida que el request tenga todo y devuelve un response, un mensaje o un ok
                $validateData = $this->getValidate()->ValidateData($request,'company');
                //Si no existe mensaje
                if(!isset($validateData['mensaje'])){
                    //Validacion de rut que no venga con guión y que no tenga más de 8 digitos
                    if($this->getValidateRut($request['rut_company'])){
                        //Guardando los datos de la empresa, se verifica su existencia
                        if($this->saveCompany($request)){
                            return response()->json(['mensaje' => 'La empresa a sido guardada exitosamente'], 200);
                        }else{
                            return response()->json(['mensaje'=> 'La empresa existe'],400);
                        }
                    }else{
                        return response()->json(['mensaje' => 'Estimado usuario, revisar el formato del rut de su empresa'],400);
                    }
                }else{
                    return response()->json([$validateData],400);
                }
            }else{
                return response()->json(['mensaje'=> 'El metodo ingresado no es valido'],405);
            }
        }catch(Exception $e){
            Log::info('error en linea: ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
            Log::info('error en archivo: ' . $e->getFile());
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Companys  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Companys $company)
    {
        try{
            return response()->json(['mensaje' => json_decode($company::all(),true)],200);
        }catch(Exception $e){
            Log::info('error en linea: ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
            Log::info('error en archivo: ' . $e->getFile());
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Companys  $companys
     * @return \Illuminate\Http\Response
     */
    public function getEmpresa(Request $request,Companys $companys)
    {
        try{
            if($request->method('GET')){
                $validateData = $this->getValidate()->ValidateData($request,'getcompany');
                if(!isset($validateData['mensaje'])){
                    $exist = $this->getCompany($request['rut_company']);
                    if($exist){
                        return response()->json(['mensaje' => $this->getParam($exist)],200);
                    }else{
                        return response()->json(['mensaje' =>'La empresa no existe'],404);
                    }
                }else{
                    return response()->json([$validateData],400);
                }
            }else{
                    return response()->json(['mensaje'=> 'El metodo ingresado no es valido'],405);
            }
        }catch(Exception $e){
            Log::info('error en linea: ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
            Log::info('error en archivo: ' . $e->getFile());
        }
        
    }
    public function getParam($params){
        try{
            $param = array(
                'rut_company' => $params['rut_company'],
                'dv_company'  => $params['dv_company'],
                'business_name'=> $params['business_name'],
                'fantasy_name' => $params['fantasy_name'],
                'address' => $params['address']
            );
            return $param;
        }catch(Exception $e){
            Log::info('error en linea: ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
            Log::info('error en archivo: ' . $e->getFile());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Companys  $companys
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companys $companys)
    {
        try{
            if($request->method('PUT')){
                //la unica variable obligatoria es el rut empresa, para realizar la busqueda correspondiente
                $validateData = $this->getValidate()->ValidateData($request,'updatecompany');
                if(!isset($validateData['mensaje'])){
                    $exist = $this->getCompany($request['rut_company']);
                    if($exist){
                        if($this->updateCompany($request,$exist)){
                            return response()->json(['mensaje' => 'Empresa actualizada correctamente'],200);
                        }else{
                            return response()->json(['mensaje'=> 'No a sido posible actualizar la empresa'],400);
                        }
                        return response()->json(['mensaje' => $this->getParam($exist)],200);
                    }else{
                        return response()->json(['mensaje' =>'La empresa no existe'],404);
                    }
                }else{
                    return response()->json([$validateData],400);
                }
            }else{
                    return response()->json(['mensaje'=> 'El metodo ingresado no es valido'],405);
            }
        }catch(Exception $e){
            Log::info('error en linea: ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
            Log::info('error en archivo: ' . $e->getFile());
        }
    }
    public function updateCompany($data,$empresa){
        try{
            $empresa->update(array(
                'rut_company'   => $data['rut_company'] == $data['new_rut'] ? $data['rut_company']: $data['new_rut'],
                'dv_company'    => $data['dv_company'],
                'business_name' => $data['business_name'],
                'fantasy_name'  => $data['fantasy_name'],
                'address'       => $data['address']
            ));
            return true;
        }catch(Exception $e){
            Log::info('error en linea: ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
            Log::info('error en archivo: ' . $e->getFile());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Companys  $companys
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Companys $companys)
    {
        try{
            if($request->method('POST')){
                $validateData = $this->getValidate()->ValidateData($request,'deletecompany');
                if(!isset($validateData['mensaje'])){
                    $exist = $this->getCompany($request['rut_company']);
                    if($exist){
                        if($exist->delete()){
                            return response()->json(['mensaje'=>'Empresa eliminada correctamente'],200);
                        }else{
                            return response()->json(['mensaje' => 'Empresa no pudo ser eliminada'],200);
                        } 
                    }else{
                        return response()->json(['mensaje' =>'La empresa no existe'],404);
                    }
                }else{
                    return response()->json([$validateData],400);
                }
            }else{
                    return response()->json(['mensaje'=> 'El metodo ingresado no es valido'],405);
            }
        }catch(Exception $e){
            Log::info('error en linea: ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
            Log::info('error en archivo: ' . $e->getFile());
        }
    }
    public function getValidateRut($rut)
    {
        try {
            //* Se verifica que el rut venga sin guion, sin k ni letras
            if (strpos($rut, '-') || !ctype_digit($rut)) {
                return false;
            } else {
                return $rut;
            }
        } catch (Exception $e) {
            Log::info('error en linea: ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
            Log::info('error en archivo: ' . $e->getFile());
        }
    }

    public function getValidate(){
        try{
            $validarDatos = new ValidateController();
            return $validarDatos;
        }catch (Exception $e) {
            Log::info('error en linea: ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
            Log::info('error en archivo: ' . $e->getFile());
        }
        
    }

    public function Company(){
        try{
            return new Companys(); 
        }catch (Exception $e) {
            Log::info('error en linea: ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
            Log::info('error en archivo: ' . $e->getFile());
        }
    }

    public function getCompany($company_rut){
        //Verificando en base de datos la existencia de la empresa
        $existe = $this->Company()::where('rut_company',$company_rut);
        if($existe->count()>0){
            //Si existe la empresa la retorna
            return $existe->first();
        }else{
            return false;
        }
        
    }
    public function saveCompany($data){
        try{
            //Si existe el rut empresa no se debe realizar el guardado de esta
            if(!$this->getCompany($data['rut_company'])){
                $company = $this->Company();
                $company->rut_company   = $data['rut_company'];
                $company->dv_company    = $data['dv_company'];
                $company->business_name = $data['business_name'];
                $company->fantasy_name  = $data['fantasy_name'];
                $company->address       = $data['address'];
                $company->save();
                return true;
            }else{
                return false;
            }
            

        }catch (Exception $e) {
            Log::info('error en linea: ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
            Log::info('error en archivo: ' . $e->getFile());
        }
        
    }
}
