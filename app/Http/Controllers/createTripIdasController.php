<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TripeIdeas;
use Carbon\Carbon;
use App\Models\log;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Post(
 *  path="/create__TripIdeasCategories",
 *   tags={"@TripIdeasCategories"},
 *   summary="CREATE TRIPIDEAS",
 *   operationId="50",
 *  @OA\Parameter(
 *      name="HotelLocationCity",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *  @OA\Parameter(
 *      name="HotelLocationCountry",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="HotelLocationContinent",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="HotelID",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="HotelStartRate",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="DrupalCityID",
 *      in="query",
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
class createTripIdasController extends Controller
{
    public function index(Request $request)
    {
        $check = TripeIdeas::all();
        $flag = false;
        $status = null;
        foreach ($check as $item) {
            if ($item->HotelID == $request->HotelID) {
                $flag = true;
            }
        }
        if (!$flag) {
            $insert = TripeIdeas::create([
                'HotelLocationCity' => $request->HotelLocationCity,
                'HotelLocationCountry' => $request->HotelLocationCountry,
                'HotelLocationContinent' => $request->HotelLocationContinent,
                'HotelID' => $request->HotelID,
                'DrupalCityID' => $request->DrupalCityID,
                'HotelStartRate' => $request->HotelStartRate,
            ]);
            if ($insert) {
                $response =  'Record Created Successfully';
                $status = 1;
            } else {
                $response =  'Record Created Failed';
                $status = 0;
            }
        } else {
            $response =  'THIS HOTEL ID IS ALREADY CREATED';
            $status = 0;
        }
        return $this->log(url()->current(), request()->ip(), $status, $response);
    }
}
