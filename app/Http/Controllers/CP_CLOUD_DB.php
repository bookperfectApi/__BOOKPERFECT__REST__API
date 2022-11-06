<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CP_CLOUD_MODEL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
/**
 * @OA\Get(
 *  path="/create_user_copy",
 *   tags={"@Users and Agencies"},
 *   summary="GET USERS AND COPY CLOUD DB",
 *   operationId="1302",
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *   ),
 *)
 **/
class CP_CLOUD_DB extends Controller
{
    public function index()
    {

        $ack = CP_CLOUD_MODEL::all();
        if (count($ack) >= 1) {
            CP_CLOUD_MODEL::truncate();
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://bookperfect.paquetedinamico.com/resources/user/bookperfect",
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
            $status = 'fail';
        } else {
            // if ($response == '{"status":"UNAUTHORIZED","error":["Invalid or expired token"]}') {
            //     $status = "INVALID REQUEST";
            // } else {
            //     $status = "SUCCESS";
            // }
            $data = json_decode($response, true);
            foreach ($data['user'] as $item) {
                CP_CLOUD_MODEL::create([
                    'userName' => $item['username'],
                    'userEmailID' => $item['email'],
                    'userCountry' => isset($item['country']) ? $item['country'] : 'TR',
                    'userAgency' => $item['agency'],
                    'userSurname' => $item['surname'],
                    'userProfile' => $item['profile'],
                    'userIsB2C' => $item['b2c'],
                    'userRegisterViaAPI' => 0,
                ]);
            }
            return json_decode($response);
        }
    }
}
