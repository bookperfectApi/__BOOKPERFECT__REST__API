<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CP_CLOUD_MODEL;

class cpCloud extends Command
{
    public $auth;
    public $__USERNAME__ = 'apiuser';
    public $__PASSWORD__ = 'Apiuser@2022';
    public $__URL__ = 'https://bookperfect.paquetedinamico.com/resources/authentication/getAuthToken?microsite=bookperfect';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cp:cloud';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy Cloud into LocalDB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
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
            $this->auth=$data["token"];
        }
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
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
                'auth-token:' . $this->auth,
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
            $status = 'fail';
        } else {
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
            info('Cloud DB Copied on Local DB');
        }
        return 0;
    }
}
