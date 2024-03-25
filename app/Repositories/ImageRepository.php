<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
class ImageRepository
{
    /**
     * Upload the image
     * @param $image
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function uploadImage($image, $name=null)
    {
        return $this->upload($image,$name);
    }
    /**
     * Upload the image
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    private function upload($image, $name=null)
    {
        try{
            $name == null ? $name = uniqid() : $name = $name;
            $path = Storage::disk('public')->put('uploads/blogs', $image);
            $imageName = explode('/', $path);
            $imageName=$imageName[count($imageName)-1];
            Log::info($imageName);
            return "storage/app/uploads/blogs/$imageName";
        }catch (\Exception $exception){
            return response('Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}