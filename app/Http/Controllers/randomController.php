<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TripeIdeas;
use App\Models\log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
/**
 * @OA\Get(
 *  path="/get__TripIdeasCategoriesHotelten__by__name/{city}",
 *   tags={"@TripIdeasCategories"},
 *   summary="GET 10 TOP HOTEL ID",
 *   operationId="61",
 *
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
class randomController extends Controller
{
    public function index($city){
        $response = TripeIdeas::where('HotelLocationCity','=',$city)->limit(10)->get();
        if($response){$status = 1;}else{$status = 0;}
        return $this->log(url()->current(), request()->ip(), $status, $response);
    }
}
