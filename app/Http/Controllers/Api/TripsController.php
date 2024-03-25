<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Blog\BlogRequest;
use App\Repositories\BlogRepository;
use App\Repositories\ImageRepository;
use App\Repositories\TripRepository;
use App\Http\Resources\TripResource;
use App\Http\Resources\TripCollection;

class TripsController extends Controller
{
    protected $trip;
    
    public function __construct( TripRepository $tripRepository)
    {
        $this->trip = $tripRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new TripCollection($this->trip->all());
    }
}
