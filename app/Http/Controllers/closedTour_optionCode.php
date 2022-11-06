<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Get(
 *  path="/get_closedTour_optionCode/{suplierid}/{closertourcode}/{optionCode}",
 *   tags={"@Contracts"},
 *   summary="GET CLOSET TOUR BY SUPPLIER ID AND CLOSEDTOURCODE AND OPTIOIN CODE",
 *   operationId="1301",
 *  @OA\Parameter(
 *      name="suplierid",
 *      in="path",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="closertourcode",
 *      in="path",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="optionCode",
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
class closedTour_optionCode extends Controller
{

    public function index($suplierId, $closedTour, $optionCode)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://bookperfect.paquetedinamico.com/resources/closedtour/" . $suplierId . '/' . $closedTour . '/' . $optionCode,
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
