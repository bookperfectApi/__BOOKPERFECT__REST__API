<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TripeIdeas;
use App\Models\log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Get(
 *  path="/get__TripIdeasCategories__by__id/{id}",
 *   tags={"@TripIdeasCategories"},
 *   summary="GET TRIPIDEAS BY ID",
 *   operationId="56",
 *  @OA\Parameter(
 *      name="id",
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
class tripIdeas_idController extends Controller
{
    public function index($id)
    {
      
      $response = TripeIdeas::where('HotelID', '=', $id)->get();
      if($response){$status = 1;}else{$status = 0;}      
      return $this->log(url()->current(), request()->ip(), $status, $response);
    }
}
