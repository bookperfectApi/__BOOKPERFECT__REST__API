<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripeIdeas extends Model
{
    use HasFactory;
    protected $table='TripIdeasCategories';
    protected $fillable = ['HotelLocationCity', 'HotelLocationCountry', 'HotelLocationContinent' , 'HotelID' ,'DrupalCityID','HotelStartRate'];
}
