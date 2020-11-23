<?php

namespace App\Http\Controllers;

use App\Models\CntWorkers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ValidateController;
use Exception;
use Illuminate\Routing\Controller;
class CntWorkerController extends Controller
{
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
                $validateData = $this->getValidate()->ValidateData($request,'contract');
                //Si no existe mensaje
                if(!isset($validateData['mensaje'])){
                    if($this->getValidateContract($request['code_contract'])){
                        if($this->saveWorker($request)){
                            return response()->json(['mensaje' => 'El contrato del trabajador a sido guardada exitosamente'], 200);
                        }else{
                            return response()->json(['mensaje'=> 'El contrato no existe'],400);
                        }
                    }else{
                        return response()->json(['mensaje' => 'Estimado usuario, revisar el formato del contrato de la persona'],400);
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
    public function getValidateContract($rut)
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CntWorkers  $cntWorkers
     * @return \Illuminate\Http\Response
     */
    public function show(CntWorkers $cntWorkers)
    {
        try{
            return response()->json(['mensaje' => json_decode($cntWorkers::all(),true)],200);
        }catch(Exception $e){
            Log::info('error en linea: ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
            Log::info('error en archivo: ' . $e->getFile());
        }
    }
    public function getWorker(Request $request,CntWorkers $worker)
    {
        try{
            if($request->method('GET')){
                $validateData = $this->getValidate()->ValidateData($request,'getworker');
                if(!isset($validateData['mensaje'])){
                    $exist = $this->obtenerWorker($request['code_contract']);
                    if($exist){
                        return response()->json(['mensaje' => $this->getParam($exist)],200);
                    }else{
                        return response()->json(['mensaje' =>'El trabajador no existe'],404);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CntWorkers  $cntWorkers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CntWorkers $cntWorkers)
    {
        try{
            if($request->method('PUT')){
                $validateData = $this->getValidate()->ValidateData($request,'updatecontract');
                if(!isset($validateData['mensaje'])){
                    $exist = $this->obtenerWorker($request['code_contract']);
                    if($exist){
                        if($this->updateWorker($request,$exist)){
                            return response()->json(['mensaje' => 'Contracto actualizado correctamente'],200);
                        }else{
                            return response()->json(['mensaje'=> 'No a sido posible actualizar el Contracto'],400);
                        }
                        return response()->json(['mensaje' => $this->getParam($exist)],200);
                    }else{
                        return response()->json(['mensaje' =>'El Contracto no existe'],404);
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
    public function updateWorker($data,$workers){
        try{
            $workers->update(array(
                'contract_code'         => $data['contract_code']== $data['identificador'] ? $data['contract_code']: $data['identificador'],
                'fkid_company'          => $data['fkid_company'],
                'fkid_persona'          => $data['fkid_persona'],
                'fkid_position'         => $data['fkid_position'],
                'fkid_work_shift'       => $data['fkid_work_shift'],
                'fkid_type_contract'    => $data['fkid_type_contract'],
                'contract_start_date'   => $data['contract_start_date'],
                'contract_end_date'     => $data['contract_end_date']
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
     * @param  \App\Models\CntWorkers  $cntWorkers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , CntWorkers $cntWorkers)
    {
        try{
            if($request->method('POST')){
                $validateData = $this->getValidate()->ValidateData($request,'deleteworker');
                if(!isset($validateData['mensaje'])){
                    $exist = $this->obtenerWorker($request['code_contract']);
                    if($exist){
                        if($exist->delete()){
                            return response()->json(['mensaje'=>'Contrato del trabajador eliminada correctamente'],200);
                        }else{
                            return response()->json(['mensaje' => 'Contrato del trabajador no pudo ser eliminada'],200);
                        } 
                    }else{
                        return response()->json(['mensaje' =>'La Contrato del trabajador no existe'],404);
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
                'contract_code' => $params['contract_code'],
                'fkid_company'  => $params['fkid_company'],
                'fkid_persona'=> $params['fkid_persona'],
                'fkid_position' => $params['fkid_position'],
                'fkid_work_shift' => $params['fkid_work_shift'],
                'fkid_type_contract' => $params['fkid_type_contract'],
                'contract_start_date' => $params['contract_start_date'],
                'contract_end_date' => $params['contract_end_date']
            );
            return $param;
        }catch(Exception $e){
            Log::info('error en linea: ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
            Log::info('error en archivo: ' . $e->getFile());
        }
    }
    public function Contract(){
        try{
            return new CntWorkers(); 
        }catch (Exception $e) {
            Log::info('error en linea: ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
            Log::info('error en archivo: ' . $e->getFile());
        }
    }
    public function saveWorker($data){
        try{
            Log::info($data);
            if(!$this->obtenerWorker($data['contract_code'])){
                $contract = $this->Contract();
                $contract->contract_code        = $data['contract_code'];
                $contract->fkid_company         = $data['fkid_company'];
                $contract->fkid_persona         = $data['fkid_persona'];
                $contract->fkid_position        = $data['fkid_position'];
                $contract->fkid_work_shift      = $data['fkid_work_shift'];
                $contract->fkid_type_contract   = $data['fkid_type_contract'];
                $contract->contract_start_date  = $data['contract_start_date'];
                $contract->contract_end_date    = $data['contract_end_date'];
                $contract->save();
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
    public function obtenerWorker($contract_code){
        $existe = $this->Contract()::where('contract_code',$contract_code);
        if($existe->count()>0){
            return $existe->first();
        }else{
            return false;
        }
        
    }
}
