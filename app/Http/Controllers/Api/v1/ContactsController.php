<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Api\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $syncDate = $request->input('syncDate');

        $contacts = Contact::withTrashed()
            ->where(function ($query) use ($syncDate) {
                $query->where('created_at', '>', Carbon::createFromTimestamp($syncDate))
                    ->orWhere('updated_at', '>', Carbon::createFromTimestamp($syncDate))
                    ->orWhere('deleted_at', '>', Carbon::createFromTimestamp($syncDate));
            })
            ->get();

        return response()->json($contacts, 200);
    }

    public function updateOrCreate(Request $request, $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            $contact = new Contact();
            $contact->id = $id;
        }

        $contact->name = $request->input('name', $contact->name);
        $contact->surname = $request->input('surname', $contact->surname);
        $contact->patronymic = $request->input('patronymic', $contact->patronymic);
        $contact->job_title = $request->input('job_title', $contact->job_title);
        $contact->email = $request->input('email', $contact->email);
        $contact->phone = $request->input('phone', $contact->phone);
        $contact->mobile = $request->input('mobile', $contact->mobile);
        $contact->work_number = $request->input('work_number', $contact->work_number);
        $contact->deleted_at = $request->input('deleted_at', $contact->deleted_at);
        $contact->contactable_type = 'App\Models\Organization';
        $contactableId = $request->input('contactable_id');
        if ($contactableId !== null) {
            $contact->contactable_id = $contactableId;
        } else {
            $contact->contactable_id = $id;
        }

        $contact->save();

        return response(['contact' => $contact], 200);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
