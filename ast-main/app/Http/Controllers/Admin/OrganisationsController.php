<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Filters\OrganizationsFilter;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganisationsController extends Controller
{
    /**
     * @param OrganizationsFilter $organizationsFilter
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(OrganizationsFilter $organizationsFilter)
    {
        $organisations = Organization::filter($organizationsFilter)->paginate(15);
        return view('admin.organisations.index',['organisations' => $organisations]);
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
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        DB::transaction(function() use ($id){
            $organisation = Organization::withTrashed()->find($id);
            $organisationReports = $organisation->reports()->withTrashed()->get();
            $organisationFarms = $organisation->farms()->withTrashed()->get();

            foreach($organisationReports as $report) {
                $report->forceDelete();
            }
            foreach($organisationFarms as $farm) {
                $farm->forceDelete();
            }
            $organisation->forceDelete();
        });

        return redirect()->back()->with(['msg'=>'Организация удалена']);
    }
}
