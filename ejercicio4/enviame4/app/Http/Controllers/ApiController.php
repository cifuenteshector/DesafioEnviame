<?php

namespace App\Http\Controllers;

use App\Models\WsApiEnviame;
use Illuminate\Http\Request;
use Exception;
use Facade\FlareClient\Http\Client;
use GuzzleHttp\Client as GuzzleHttpClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;
class ApiController extends Controller
{

    public function getHeader(){
        try {
            $getToken   = '7d066821f33647851bffb8802bf81113';
            $header     = array('Content-Type' =>'application/json','Accept'=> 'application/json', 'api-key' => $getToken);
            return $header;
        } catch (Exception $e) {
            Log::info('error en archivo: ' . $e->getFile());
            Log::info('error en linea : ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
        }
    }
    public function baseUriEnviame(){
        try {
            return 'http://stage.api.enviame.io/api/s2/v2/companies/620/deliveries';
        } catch (Exception $e) {
            Log::info('error en archivo: ' . $e->getFile());
            Log::info('error en linea : ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
        }
    }
    public function PostEnviame()
    {
        try {
            $param              = $this->ParamEnviame();
            $header             = $this->getHeader();
            $url                = $this->baseUriEnviame();
            $client = new GuzzleHttpClient(['headers'=> $header]);

            $r = $client->request('POST',$url,[
                'body' => $param
            ]);

            $response= $r->getBody()->getContents();

            // Log::info('response');
            // Log::info($response);
            // $ch                 = curl_init($url);

            // curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_POST, true);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $param);

            // $result             = curl_exec($ch);
            // $validadorConsumo   = json_decode($result, true);

            // $info               = curl_getinfo($ch);
            // curl_close($ch);

            // Log::alert('info');
            // Log::info($info);
            // Log::info('resultado');
            // Log::info($result);

            if ($r->getStatusCode() === 200) {
                    $this->guardarConsumo($r->getStatusCode(),json_decode($response,true));
            }
        } catch (Exception $e) {
            Log::info('error en archivo: ' . $e->getFile());
            Log::info('error en linea : ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
        }
    }
    public function guardarConsumo($status,$response)
    {
        try {      
            foreach ($response as $value) {
                WsApiEnviame::create(array(
                    'http_response'     => $status,
                    'identifier'        => $value[0]['identifier'],
                    'imported_id'       => $value[0]['imported_id'],
                    'tracking_number'   => $value[0]['tracking_number'],
                    'customer'          => implode("|",$value[0]['customer']),
                    'shipping_address'  => implode("|",$value[0]['shipping_address']),
                    'carrier'           => $value[0]['carrier'],
                    'service'           => $value[0]['service'],
                    'country'           => $value[0]['country'],
                    'url_consumo'       => $this->baseUriEnviame(),
                    'status'            => json_encode($value[0]['status'])
                ));
            }
        } catch (Exception $e) {
            Log::info('error en archivo: ' . $e->getFile());
            Log::info('error en linea : ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
        }
    }
    //Generacion del param enviado del personal
    public function ParamEnviame()
    {
        try {
            $param      = array (
                'shipping_order' => 
                    array (
                        'imported_id' => '123123',
                        'order_price' => '100',
                        'n_packages' => '1',
                        'content_description' => 'Prendas de vestir',
                        'type' => 'delivery',
                        'weight' => '',
                        'volume' => '1',
                    ),
                'shipping_destination' => 
                    array (
                        'customer' => 
                            array (
                                'name' => 'Jonh Doe',
                                'phone' => '569123456789',
                                'email' => 'correo@mail.com',
                            ),
                        'delivery_address' => 
                            array (
                                'home_address' => 
                                    array (
                                        'place' => 'Providencia',
                                        'full_address' => 'Luis Thayer ojeda 0127',
                                        'information' => '',
                                    ),
                            ),
                        ),
                'shipping_origin' => 
                    array (
                        'warehouse_code' => 'cod_bod',
                    ),
                'carrier' => 
                    array (
                        'carrier_code' => 'CCH',
                        'carrier_service' => 'normal',
                        'tracking_number' => '',
                    ),
                );
            return json_encode($param);
        } catch (Exception $e) {
            Log::info('error en archivo: ' . $e->getFile());
            Log::info('error en linea : ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
        }
    }

}
