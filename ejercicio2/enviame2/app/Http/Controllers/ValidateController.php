<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
class ValidateController extends Controller
{
    public function ValidateData($data, $tipo_validador)
    {
        try {
            $validate = $this->ParamValidate($data, $tipo_validador);
            $validacion = Validator::make($validate[0], $validate[1]);
            if ($validacion->fails()) {
                $mensaje = $this->getErrorMessages($validacion);
                return (array('mensaje' => $mensaje));
            } else {
                return $data;
            }
        } catch (Exception $e) {
            Log::info('error: ' . $e->getMessage());
            Log::info('error en linea: ' . $e->getLine());
            Log::info('error en archivo: ' . $e->getFile());
        }
    }
    public function ParamValidate($data, $tipo_validador)
    {
        switch ($tipo_validador) {
            case 'company':
                $validacion = array(
                    'rut_company'        => isset($data['rut_company'])     ? $data['rut_company'] : '',
                    'dv_company'         => isset($data['dv_company'])      ? $data['dv_company'] : '',
                    'business_name'      => isset($data['business_name'])   ? $data['business_name'] : '',
                    'fantasy_name'       => isset($data['fantasy_name'])    ? $data['fantasy_name'] : '',
                    'address'            => isset($data['address'])         ? $data['address'] : '',
                );
                $validate = array(
                    'rut_company'       =>  'required|integer|digits_between:7,8',
                    'dv_company'        =>  'required|string|min:1',
                    'business_name'     =>  'required|string|max:100',
                    'fantasy_name'      =>  'required|string|max:100',
                    'address'           =>  'required|string|max:100',
                );
                return array($validacion, $validate);
                break;
            case 'getcompany':
                $validacion = array(
                    'rut_company'        => isset($data['rut_company'])     ? $data['rut_company'] : '',
                    'dv_company'         => isset($data['dv_company'])      ? $data['dv_company'] : '',
                    'business_name'      => isset($data['business_name'])   ? $data['business_name'] : '',
                    'fantasy_name'       => isset($data['fantasy_name'])    ? $data['fantasy_name'] : '',
                    'address'            => isset($data['address'])         ? $data['address'] : '',
                );
                $validate = array(
                    'rut_company'       =>  'required|integer|digits_between:7,8',
                    'dv_company'        =>  'string|min:1',
                    'business_name'     =>  'string|max:100',
                    'fantasy_name'      =>  'string|max:100',
                    'address'           =>  'string|max:100',
                );
                return array($validacion, $validate);
                break;
            case 'updatecompany':
                    $validacion = array(
                        'rut_company'        => isset($data['rut_company'])     ? $data['rut_company'] : '',
                        'new_rut'            => isset($data['new_rut'])     ? $data['new_rut'] : '',
                        'dv_company'         => isset($data['dv_company'])      ? $data['dv_company'] : '',
                        'business_name'      => isset($data['business_name'])   ? $data['business_name'] : '',
                        'fantasy_name'       => isset($data['fantasy_name'])    ? $data['fantasy_name'] : '',
                        'address'            => isset($data['address'])         ? $data['address'] : '',
                    );
                    $validate = array(
                        'rut_company'       =>  'required|integer|digits_between:7,8',
                        'new_rut'           =>  'required|integer|digits_between:7,8',
                        'dv_company'        =>  'string|min:1',
                        'business_name'     =>  'string|max:100',
                        'fantasy_name'      =>  'string|max:100',
                        'address'           =>  'string|max:100',
                    );
                    return array($validacion, $validate);
                    break;
                case 'deletecompany':
                    $validacion = array(
                        'rut_company'        => isset($data['rut_company'])     ? $data['rut_company'] : '',
                    );
                    $validate = array(
                        'rut_company'       =>  'required|integer|digits_between:7,8',
                    );
                    return array($validacion, $validate);
                    break;
            case 'persona':
                $validacion = array(
                    'rut_person'        => isset($data['rut_person'])     ? $data['rut_person'] : '',
                    'dv_verif_person'   => isset($data['dv_verif_person'])      ? $data['dv_verif_person'] : '',
                    'fkid_civil_status' => isset($data['fkid_civil_status'])   ? $data['fkid_civil_status'] : '',
                    'fkid_gender'       => isset($data['fkid_gender'])    ? $data['fkid_gender'] : '',
                    'fkid_nationality'  => isset($data['fkid_nationality'])    ? $data['fkid_nationality'] : '',
                    'passport'          => isset($data['passport'])         ? $data['passport'] : '',
                    'first_name'        => isset($data['first_name'])         ? $data['first_name'] : '',
                    'last_name'         => isset($data['last_name'])         ? $data['last_name'] : '',
                );
                $validate = array(
                    'rut_person'        =>  'required|integer|digits_between:7,8',
                    'dv_verif_person'   =>  'string|min:1',
                    'fkid_civil_status' =>  'string|max:100',
                    'fkid_gender'       =>  'string|max:100',
                    'fkid_nationality'  =>  'string|max:100',
                    'passport'          =>  'string|max:100',
                    'birthday'          =>  'string|max:100',
                    'first_name'        =>  'string|max:100',
                    'last_name'         =>  'string|max:100',
                );
                return array($validacion, $validate);
                break;
            case 'updateperson':
                $validacion = array(
                    'rut_person'        => isset($data['rut_person'])     ? $data['rut_person'] : '',
                    'identificador'     => isset($data['identificador'])     ? $data['identificador'] : '',
                    'dv_verif_person'   => isset($data['dv_verif_person'])      ? $data['dv_verif_person'] : '',
                    'fkid_civil_status' => isset($data['fkid_civil_status'])   ? $data['fkid_civil_status'] : '',
                    'fkid_gender'       => isset($data['fkid_gender'])    ? $data['fkid_gender'] : '',
                    'fkid_nationality'  => isset($data['fkid_nationality'])    ? $data['fkid_nationality'] : '',
                    'passport'          => isset($data['passport'])         ? $data['passport'] : '',
                    'first_name'        => isset($data['first_name'])         ? $data['first_name'] : '',
                    'last_name'         => isset($data['last_name'])         ? $data['last_name'] : '',
                );
                $validate = array(
                    'rut_person'        =>  'required|integer|digits_between:7,8',
                    'identificador'     =>  'required|integer|digits_between:7,8',
                    'dv_verif_person'   =>  'string|min:1',
                    'fkid_civil_status' =>  'string|max:100',
                    'fkid_gender'       =>  'string|max:100',
                    'fkid_nationality'  =>  'string|max:100',
                    'passport'          =>  'string|max:100',
                    'birthday'          =>  'string|max:100',
                    'first_name'        =>  'string|max:100',
                    'last_name'         =>  'string|max:100',
                );
                return array($validacion, $validate);
                break;
            case 'deleteperson':
                $validacion = array(
                    'rut_person'        => isset($data['rut_person'])     ? $data['rut_person'] : '',
                );
                $validate = array(
                    'rut_person'       =>  'required|integer|digits_between:7,8',
                );
                return array($validacion, $validate);
                break;
            default:
                # code...
                break;
        }
    }
    public function getErrorMessages($validacion)
    {
        try {
            $errores = array();
            foreach ($validacion->messages()->toArray() as $error) {
                foreach ($error as $suberror) {
                    array_push($errores, $suberror);
                }
            }
            return ($errores);
        } catch (Exception $e) {
            Log::info('error: ' . $e->getMessage());
            Log::info('error en linea: ' . $e->getLine());
            Log::info('error en archivo: ' . $e->getFile());
        }
    }
}
