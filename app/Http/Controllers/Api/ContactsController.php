<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Resources\ContactResource;
use App\Repositories\ContactRepository;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $contact;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contact = $contactRepository;
    }
    public function index()
    {
        return ContactResource::collection(
            Contact::query()->get()
        );
    }
    public function store(UpdateContactRequest $request)
    {
        //Log::info(print_r(["Request starts"],true));
        $data = $request->validated();
        $data = $request->collect((new Contact())->getFillable())
            ->toArray();
        $contact = $this->contact->create($data);

        return $contact ? response(new ContactResource($contact),201) : response(__("Cannot create Contact, contact technical support!!"), 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return new ContactResource($contact);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $data = $request->validated();
        $contact->update($data);
        return new ContactResource($contact);
    }

    public function destroy($id)
    {
        if (! $id)
            return response(__("You Should Provide Contact id"), 500);
        else
            $res = $this->contact->delete($id);
        return ($res == 1) ? response(__("Contact Deleted Successfully"), 200) : response(__("Contact not found"), 404);
    }

}
