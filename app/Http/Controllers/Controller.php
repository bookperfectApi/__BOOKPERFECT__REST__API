<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * @OA\Info(
 *    title="",
 *    version="... BOOKPERFECT API DESIGNED BY HOTELISTAN COMPANY ...",
 * ),
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $__USERNAME__ = 'apiuser';
    public $__PASSWORD__ = 'Apiuser@2022';
    public $__URL__ = 'https://bookperfect.paquetedinamico.com/resources/authentication/getAuthToken?microsite=bookperfect';
    public function auth()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->__URL__ . '&username=' . $this->__USERNAME__ . '&password=' . $this->__PASSWORD__,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'accept: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, true);
            return  $data["token"];
        }
    }
    public function log($__REQUESTNAME, $__IP, $__STATUS, $__RESPONSE)
    {
        //RECODE IN DATABASE : SECTION

        log::create([
            'requestName'  => $__REQUESTNAME,
            'IP'           => $__IP,
            'status'       => $__STATUS,
            'date'         => Carbon::now()->setTimezone('Turkey'),
        ]);
        // FILE MAKER : SECTION
        $__CONTENT = 'REQUEST_NAME------->' . $__REQUESTNAME . PHP_EOL . 'RESPONSE------>' . $__RESPONSE;
        $__ROW = log::latest()->first();
        $__DIR = 'api_log_files/' . 'DATE' . str_replace('-', '', date('Y-m-d'));
        $__FILENAME = 'REQUEST_RESPONSE_' . $__ROW->id . '_' . str_replace('-', '', date('Y-m-d')) . str_replace(' ', '', Carbon::now()->setTimezone('Turkey')->format('H i s'));
        Storage::put($__DIR . '/' . $__FILENAME . '.txt', $__CONTENT);
        return json_decode($__RESPONSE);
    }
}
