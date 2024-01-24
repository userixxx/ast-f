<?php

namespace App\Http\Controllers\General;

use App\Actions\General\Contacts\StoreContact;
use App\Actions\General\Contacts\UpdateContact;
use App\Http\Controllers\Controller;
use App\Http\Requests\General\Contacts\StoreContactRequest;
use App\Http\Requests\General\Contacts\UpdateContactRequest;
use App\Models\Contact;
use App\Models\Interfaces\Contactable;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    private $contactable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param StoreContactRequest $request
     * @param StoreContact $storeContact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreContactRequest $request, StoreContact $storeContact)
    {
        $validatedRequest = $request->validated();
        $contact = $storeContact->execute($validatedRequest);
        return redirect()->to(url()->previous());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::withTrashed()->find($id);
        return view('general.contacts.edit',['contact' => $contact]);
    }

    /**
     * @param UpdateContactRequest $request
     * @param $id
     * @param UpdateContact $updateContact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateContactRequest $request, $id, UpdateContact $updateContact)
    {
        $validatedRequest = $request->validated();
        $contact = $updateContact->execute($validatedRequest, $id);
        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Contact::find($id)->delete();
        return redirect()->back();
    }
}
