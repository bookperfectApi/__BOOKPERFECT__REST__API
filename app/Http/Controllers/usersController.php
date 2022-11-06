<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Storage;
/**
 * @OA\Get(
 *  path="/get__user/{username}/{password}",
 *   tags={"@Users and Agencies"},
 *   summary="GET USER BY USERNAME AND PASSWORD",
 *   operationId="20",
 *  @OA\Parameter(
 *      name="username",
 *      in="path",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="password",
 *      in="path",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *   ),
 *)
 **/
class usersController extends Controller
{
    public function index($username, $password)
    {

        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://bookperfect.paquetedinamico.com/resources/authentication/getAuthToken?microsite=bookperfect&username=" . $username . "&password=" . $password,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array('accept: application/json',),
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
