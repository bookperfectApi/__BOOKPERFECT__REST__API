<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
/**
 * @OA\Get(
 *  path="/get__package__all",
 *   tags={"@Ideas and Packages"},
 *   summary="GET ALL PACKAGES",
 *   operationId="36",
 * @OA\Parameter(
 *      name="supplierid",
 *      in="path",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="origin Code",
 *      in="path",
 *      required=false,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="month",
 *      in="path",
 *      required=false,
 *      @OA\Schema(
 *           type="array",
 *           @OA\Items( type="enum", enum={
 *               "January",
 *               "February",
 *               "March",
 *               "April",
 *               "May",
 *               "June",
 *               "July",
 *               "August",
 *               "September",
 *               "October",
 *               "November",
 *               "December",}
 *        ),
 *      ),
 *   ),
 * @OA\Parameter(
 *      name="destinations",
 *      in="path",
 *      required=false,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="lang",
 *      in="path",
 *      required=false,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="currency",
 *      in="path",
 *      required=false,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="countryCode",
 *      in="path",
 *      required=false,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="onlyVisible",
 *      in="path",
 *      required=false,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="fromCreationDate",
 *      in="path",
 *      required=false,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="toCreationDate",
 *      in="path",
 *      required=false,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="first",
 *      in="path",
 *      required=false,
 *      @OA\Schema(
 *           type="integer($int32)"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="limit",
 *      in="path",
 *      required=false,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="provider",
 *      in="path",
 *      required=false,
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


class package__allController extends Controller
{
    
    public function index(
    $origin=null,
    $month=null,
    $destinations=null,
    $lang=null,
    $currency=null,
    $countryCode=null,
    $onlyVisible=null,
    $fromCreationDate=null,
    $toCreationDate=null,
    $first=null,
    $limit=null,
    $provider=null)
    {
        $status = null;
        $Time_Date = Carbon::now()->format('m-d-Y');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://bookperfect.paquetedinamico.com/resources/package/bookperfect",
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
