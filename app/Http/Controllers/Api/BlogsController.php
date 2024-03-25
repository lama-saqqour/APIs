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

class BlogsController extends Controller
{
    protected $blog,$image;
    
    public function __construct( BlogRepository $blogRepository, ImageRepository $imageRepository)
    {
        $this->blog = $blogRepository;
        $this->image = $imageRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BlogResource::collection($this->blog->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        //;
        $data = $request->validated();
        $data = $request->collect((new Blog())->getFillable())->toArray();
        if(isset($data['image'])) {
            $image = $request->image;
            $imageName = time().'.'.$image->extension();
            //$imagePath = public_path(). '/uploads/blogs';
            $imagePath = $this->image->uploadImage($image, $imageName);
            
            //$image->move($imagePath, $imageName);
            //$relativePath = $data['image'] = $this->saveImage($data['image']);
            $data['image'] = $imagePath;
            Log::info($imagePath);
        }

        $data['user_id'] = auth()->user()->id;
        $data['slug'] =  $this->make_slug($data['title']);
        /*
        $blogstate = BlogState::where('name', $data['state'])->first();

        if($blogstate) {
            $data['state_id'] = $blogstate->id;
        }else {
            $newstate = BlogState::create([
                'name' => $data['state']
            ]);

            $data['state_id'] = $newstate->id;
        }*/

        $blog = Blog::create($data);

        return $blog? response(new BlogResource($blog), 201): response(__("Cannot create Blog, contact technical support!!"), 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return new BlogResource($blog);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, $id)
    {
        $data = $request->validated();
        $data = $request->collect((new Blog())->getFillable())->toArray();
        if(isset($data['image'])) {
            $image = $request->image;
            $imageName = time().'.'.$image->extension();
            //$imagePath = public_path(). '/uploads/blogs';
            $imagePath = $this->image->uploadImage($image, $imageName);
            
            //$image->move($imagePath, $imageName);
            //$relativePath = $data['image'] = $this->saveImage($data['image']);
            $data['image'] = $imagePath;
        }
        
        $data['user_id'] = auth()->user()->id;
        $data['slug'] =  $this->make_slug($data['title']);

        $res = $this->blog->update($id, $data);
        return $res? response($this->blog->find($id), 200): response(__("Cannot update Blog, contact technical support!!"), 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
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

        $dir = 'uploads/blogs/';
        $file = Str::random() . '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;

        if(!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }

        file_put_contents($relativePath, $image);

        return $relativePath;
    }
    
    private function make_slug($string = null, $separator = "-") {
        if (is_null($string)) {
            return "";
        }
        
        $string = trim($string);
        $string = mb_strtolower($string, "UTF-8");;
        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", $separator, $string);
        
        return $string;
    }
    
}
