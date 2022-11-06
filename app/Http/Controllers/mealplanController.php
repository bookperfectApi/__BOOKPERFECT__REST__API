<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\log;
use Illuminate\Support\Facades\Storage;
/**
 * @OA\Get(
 *  path="/get__mealplan",
 *   tags={"@Web content"},
 *   summary="GET MEALPLAN",
 *   operationId="32",
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *   ),
 *)
 **/
class mealplanController extends Controller
{
    
    public function index()
    {
        $status = null;
        $Time_Date = Carbon::now()->format('m-d-Y');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://bookperfect.paquetedinamico.com/resources/mealplan/bookperfect",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'accept: application/json',
                'auth-token:' . $this->auth(),
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
            $status = 0;
        } else {
            if(isset(json_decode($response, true)["error"])){
                $status = 0;
            }else{
                $status = 1;
            }
            return $this->log(url()->current(), request()->ip(), $status, $response);
        }
    }
}
