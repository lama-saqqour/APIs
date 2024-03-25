<?php
namespace App\Http\Controllers\Api;

use App\Models\BlogState;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Repositories\BlogStateRepository;
use App\Http\Resources\BlogStateResource;
use App\Http\Requests\Blog\BlogStateRequest;

class BlogStateController extends Controller
{

    protected $blog_state, $blog;

    public function __construct(BlogStateRepository $stateRepository)
    {
        $this->blog_state = $stateRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BlogStateResource::collection($this->blog_state->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogStateRequest $request)
    {
        // ;
        $data = $request->validated();
        $data = $request->collect((new BlogState())->getFillable())
            ->toArray();

        $blog_state = $this->blog_state->create($data);

        return $blog_state ? response(new BlogStateResource($blog_state),201) : response(__("Cannot create BlogState, contact technical support!!"), 500);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog_state = $this->blog_state->find($id);
        return $blog_state ?: response(__("Blog State not found"), 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogStateRequest $request, $id)
    {
        $data = $request->validated();
        $res = $this->blog_state->update($id, $data);
        return $res ? response(new BlogStateResource($this->blog_state->find($id)), 200) : response(__("Blog State not found"), 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (! $id)
            return response(__("You Should Provide Blog State id"), 500);
        else
            $res = $this->blog_state->delete($id);
        return ($res == 1) ? response(__("Record Deleted Successfully"), 200) : response(__("Blog State not found"), 404);
    }

}
