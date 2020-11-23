<?php

namespace App\Http\Controllers;

use App\Models\Persons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ValidateController;
use Exception;
use Illuminate\Routing\Controller;
class PersonController extends Controller
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
                $validateData = $this->getValidate()->ValidateData($request,'person');
                //Si no existe mensaje
                if(!isset($validateData['mensaje'])){
                    //Validacion de rut que no venga con guión y que no tenga más de 8 digitos
                    if($this->getValidateRut($request['rut_person'])){
                        if($this->savePerson($request)){
                            return response()->json(['mensaje' => 'La persona a sido guardada exitosamente'], 200);
                        }else{
                            return response()->json(['mensaje'=> 'La persona existe'],400);
                        }
                    }else{
                        return response()->json(['mensaje' => 'Estimado usuario, revisar el formato del rut de la persona'],400);
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
     * @param  \App\Models\Persons  $persons
     * @return \Illuminate\Http\Response
     */
    public function show(Persons $persons)
    {
        try{
            return response()->json(['mensaje' => json_decode($persons::all(),true)],200);
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
     * @param  \App\Models\Persons  $persons
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persons $persons)
    {
        try{
            if($request->method('PUT')){
                //la unica variable obligatoria es el rut, para realizar la busqueda correspondiente
                $validateData = $this->getValidate()->ValidateData($request,'updateperson');
                if(!isset($validateData['mensaje'])){
                    $exist = $this->obtenerPerson($request['rut_person']);
                    if($exist){
                        if($this->updatePerson($request,$exist)){
                            return response()->json(['mensaje' => 'Persona actualizada correctamente'],200);
                        }else{
                            return response()->json(['mensaje'=> 'No a sido posible actualizar a la persona'],400);
                        }
                        return response()->json(['mensaje' => $this->getParam($exist)],200);
                    }else{
                        return response()->json(['mensaje' =>'La persona no existe'],404);
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
    public function updatePerson($data,$persons){
        try{
            $persons->update(array(
                'rut_person'        => $data['rut_person'] == $data['identificador'] ? $data['rut_person']: $data['identificador'],
                'dv_verif_person'   => $data['dv_verif_person'],
                'fkid_civil_status' => $data['fkid_civil_status'],
                'fkid_gender'       => $data['fkid_gender'],
                'fkid_nationality'  => $data['fkid_nationality'],
                'passport'          => $data['passport'],
                'birthday'          => $data['birthday'],
                'first_name'        => $data['first_name'],
                'last_name'         => $data['last_name'],
                'address'           => $data['address']
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
     * @param  \App\Models\Persons  $persons
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Persons $persons)
    {
        {
            try{
                if($request->method('POST')){
                    $validateData = $this->getValidate()->ValidateData($request,'deleteperson');
                    if(!isset($validateData['mensaje'])){
                        $exist = $this->obtenerPerson($request['rut_person']);
                        if($exist){
                            if($exist->delete()){
                                return response()->json(['mensaje'=>'Persona eliminada correctamente'],200);
                            }else{
                                return response()->json(['mensaje' => 'Persona no pudo ser eliminada'],200);
                            } 
                        }else{
                            return response()->json(['mensaje' =>'La persona no existe'],404);
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
    public function getPerson(Request $request,Persons $person)
    {
        try{
            if($request->method('GET')){
                $validateData = $this->getValidate()->ValidateData($request,'getperson');
                if(!isset($validateData['mensaje'])){
                    $exist = $this->obtenerPerson($request['rut_person']);
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
    public function Person(){
        try{
            return new Persons(); 
        }catch (Exception $e) {
            Log::info('error en linea: ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
            Log::info('error en archivo: ' . $e->getFile());
        }
    }
    public function savePerson($data){
        try{
            Log::info($data);
            //Si existe el rut empresa no se debe realizar el guardado de esta
            if(!$this->obtenerPerson($data['rut_person'])){
                $person = $this->Person();
                $person->rut_person         = $data['rut_person'];
                $person->dv_verif_person    = $data['dv_verif_person'];
                $person->fkid_civil_status  = $data['fkid_civil_status'];
                $person->fkid_gender        = $data['fkid_gender'];
                $person->fkid_nationality   = $data['fkid_nationality'];
                $person->birthday           = $data['birthday'];
                $person->first_name         = $data['first_name'];
                $person->last_name          = $data['last_name'];
                $person->save();
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
    public function obtenerPerson($person_rut){
        //Verificando en base de datos la existencia de la empresa
        $existe = $this->Person()::where('rut_person',$person_rut);
        if($existe->count()>0){
            //Si existe la empresa la retorna
            return $existe->first();
        }else{
            return false;
        }
        
    }
}
