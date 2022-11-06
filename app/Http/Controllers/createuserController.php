<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\log;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Post(
 *  path="/create__user",
 *   tags={"@Users and Agencies"},
 *   summary="CREATE USER",
 *   operationId="240",
 *  @OA\Parameter(
 *      name="Email",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *  @OA\Parameter(
 *      name="Name",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="Lastname",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="Country",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="Telephone",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="Password",
 *      in="query",
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

class createuserController extends Controller
{

    public function GET__CSRF()
    {
        return csrf_token();
    }
    public function index(Request $request)
    {

        $email = $request->Email;
        $name = $request->Name;
        $lastname = $request->Lastname;
        $country = $request->Country;
        $telephone = $request->Telephone;
        $password = $request->Password;
        $data = array(
            "username" => $email,
            "password" => $password,
            "name" => $name,
            "surname" => $lastname,
            "email" => $email,
            "telephone" => $telephone,
            "country" => $country,
            "birthDate" => "2022-08-22",
            "documentNumber" => "1234",
            "active" => true,
            "newsletter" => true,
            "b2c" => true,
            "profile" => "USER",
            "referralId" => "63",
            "agency" => "BOOKPERFECT",
            "rewards" => [],
            "externalCode" => "50",
            "courtesyTitle" => "MS",
        );
        $post_data = json_encode($data);
        $crl = curl_init('https://bookperfect.paquetedinamico.com/resources/user/bookperfect/bookperfect');
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($crl, CURLINFO_HEADER_OUT, true);
        curl_setopt($crl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($crl, CURLOPT_HTTPHEADER, array(
            'accept: application/json',
            'auth-token:' . $this->auth(),
            'Content-Type: application/json',
        ));
        $result = curl_exec($crl);
        if ($result === false) {
            $result_noti = 0;
            $status = 'fail';
            die();
        } else {
            if(isset(json_decode($result, true)["error"])){
                $status = 0;
            }else{
                $status = 1;
            }
            return $this->log(url()->current(), request()->ip(), $status, $result);
            $result_noti = 1;
            die();
            $result_noti = 1;
            die();
        }
        curl_close($crl);
    }
}
