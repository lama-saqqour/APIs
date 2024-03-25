<?php

namespace App\Http\Resources;

use App\Models\BlogState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //$datecurrent = $this->created_at;

        //$date = new \DateTime($datecurrent);

        setlocale(LC_ALL, 'ar');

        //$formatted_date = $date->format('Y-m-d');

        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'state' => $this->state,
            'image' => $this->image,
            'views' => $this->views,
            'category' => $this->category,
            'slug' => $this->slug,
            'status'=> $this->status,
            'tags'=> $this->tags,
            'meta_description'=> $this->meta_description,
            'keywords'=> $this->keywords,
            'user'=> $this->user,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            
        ];
    }
}
