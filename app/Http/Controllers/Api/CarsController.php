<?php

namespace App\Http\Controllers\Api;

use App\Models\Car;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarsResource;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Resources\CarsCategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Client\Request as ClientRequest;
use App\Repositories\CarRepository;

class CarsController extends Controller
{
    protected $car;
    
    public function __construct( CarRepository $carRepository)
    {
        $this->car = $carRepository;
    }
    
    public function index()
    {
        return CarsResource::collection($this->car->all());
        //return ['cars' => CarsResource::collection(Car::query()->orderBy('name', 'asc')->get()), 'categories' => CarsCategoryResource::collection(CarCategory::query()->orderBy('name', 'asc')->get())];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {

        $data = $request->validated();

        if(isset($data['image'])) {
            $relativePath = $data['image'] = $this->saveImage($data['image']);
            $data['image'] = $relativePath;
        }


        $car = Car::create($data);

        return response([new CarsResource($car), 201, []]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return new CarsResource($car);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $data = $request->validated();

        if(isset($data['image'])) {
            $relativePath = $data['image'] = $this->saveImage($data['image']);
            $data['image'] = $relativePath;
        }

        if(isset($data['image'])) {
            if(File::exists(public_path($car->image))) {
                File::delete(public_path($car->image));
            }
        }

        $car->update($data);
        return new CarsResource($car);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return response('', 204);
    }

    private function saveImage($image)
    {
        if(preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            $image = substr($image, strpos($image, ',') + 1);

            $type = strtolower($type[1]);

            if(!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('Invalid image type.');
            }

            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if($image === false) {
                throw new \Exception('base64_decode failed.');
            }
        } else {
            throw new \Exception('did not match data URI with image data.');
        }

        $dir = 'uploads/cars/';
        $file = Str::random() . '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;

        if(!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }

        file_put_contents($relativePath, $image);

        return $relativePath;
    }
}
