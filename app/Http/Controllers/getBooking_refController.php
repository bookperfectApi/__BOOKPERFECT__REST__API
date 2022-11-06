<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Get(
 *  path="/get__Booking_ref/{ref}",
 *   tags={"@Booking"},
 *   summary="GET ALL BOOKING ACCORDING REF",
 *   operationId="100",
 * @OA\Parameter(
 *      name="ref",
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
class getBooking_refController extends Controller
{
    
    public function index($ref)
    {
        $status = null;
        $Time_Date = Carbon::now()->format('m-d-Y');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://bookperfect.paquetedinamico.com/resources/booking/getBookings/bookperfect/".$ref,
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
