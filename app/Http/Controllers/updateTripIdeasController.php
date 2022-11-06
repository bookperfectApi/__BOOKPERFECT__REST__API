<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TripeIdeas;
use Carbon\Carbon;
use App\Models\log;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Put(
 *  path="/update__TripIdeasCategories",
 *   tags={"@TripIdeasCategories"},
 *   summary="CREATE TRIPIDEAS",
 *   operationId="51",
 * @OA\Parameter(
 *      name="HotelID",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *  @OA\Parameter(
 *      name="NewHotelID",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 * @OA\Parameter(
 *      name="DrupalCityID",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *           type="int"
 *      )
 *   ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *   ),
 *)
 **/

class updateTripIdeasController extends Controller
{
    public function index(Request $request)
    {

        $status = null;
        $response = null;
        $row = TripeIdeas::where('HotelID', '=', $request->HotelID)->first();
        if ($row == null) {
            $response = "HotelID NOT FOUND";
            $status = 'FAILED';
        } else {
            $update = TripeIdeas::where('HotelID', '=', $request->HotelID)->first();
            $update->HotelID = $request->NewHotelID;
            $update->DrupalCityID = $request->DrupalCityID == null ? $row->DrupalCityID : $request->DrupalCityID;
            $update->save();

            if ($update) {
                $response = 'Record Updated Successfully';
                $status = 'SUCCESS';
            } else {
                $response = 'Record Created Failed';
                $status = 'FAILED';
            }
        }
        return $this->log(url()->current(), request()->ip(), $status, $response);
    }
}
