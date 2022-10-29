<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TripeIdeas;
use App\Models\log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Get(
 *  path="/get__TripIdeasCategories__by__name/{city}",
 *   tags={"@TripIdeasCategories"},
 *   summary="GET TRIPIDEAS BY CITY NAME",
 *   operationId="57",
 *  @OA\Parameter(
 *      name="city",
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
class tripIdeasController extends Controller
{
  public function index($city)
  {
    $response = TripeIdeas::where('HotelLocationCity', '=', $city)->get();
    if ($response) {
      $status = 1;
    } else {
      $status = 0;
    }
    return $this->log(url()->current(), request()->ip(), $status, $response);
  }
}
