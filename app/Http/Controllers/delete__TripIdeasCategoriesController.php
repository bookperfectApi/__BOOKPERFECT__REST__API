<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TripeIdeas;
use App\Models\log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Get(
 *  path="/delete__TripIdeasCategories/{HotelId}",
 *   tags={"@TripIdeasCategories"},
 *   summary="DELETE BY HOTEL ID",
 *   operationId="58",
 *
 *  @OA\Parameter(
 *      name="HotelId",
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
class delete__TripIdeasCategoriesController extends Controller
{
    public function index($Hotelid)
    {
        $row = TripeIdeas::where('HotelID', '=', $Hotelid)->first();
        if ($row->delete()) {
            $status = 1;
            $response =  'Record Deleted Successfully';
        } else {
            $response = 'removing record  Failed';
            $status = 0;
        }
        return $this->log(url()->current(), request()->ip(), $status, $response);
    }
}
