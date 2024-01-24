<?php

namespace App\Http\Controllers\Specialist;

use App\Actions\Specialist\Organizations\StoreOrganisation;
use App\Actions\Specialist\Organizations\UpdateContacts;
use App\Actions\Specialist\Organizations\UpdateOrganization;
use App\Http\Controllers\Controller;
use App\Http\Filters\OrganizationsFilter;
use App\Http\Requests\Specialist\Organizations\StoreOrganizationRequest;
use App\Http\Requests\Specialist\Organizations\UpdateOrganizationRequest;
use App\Models\Contact;
use App\Models\Organization;
use App\Services\DadataService;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class OrganizationsController extends Controller
{
    use SoftDeletes;
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(OrganizationsFilter $organizationsFilter)
    {
        $organizations = Organization::filter($organizationsFilter)->orderBy('created_at')->paginate(30);

        session()->flashInput(request()->input());

        return view('specialist.organizations.index',[
            'organizations' => $organizations,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('specialist.organizations.create');
    }

    /**
     * @param StoreOrganizationRequest $request
     * @param StoreOrganisation $storeOrganisation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreOrganizationRequest $request, StoreOrganisation $storeOrganisation)
    {
        $validatedRequest = $request->validated();

//Из метода ниже удалён второй параметр $organizationFromDadata
        $organization = $storeOrganisation->execute($validatedRequest);

        return redirect()->route('specialist.organizations.show',['organization' => $organization]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $organization = Organization::withTrashed()->with(['region', 'district', 'creator', 'farms','farms.district', 'farms.region'])->find($id);

        return view('specialist.organizations.show', ['organization' => $organization]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $organization = Organization::withTrashed()->find($id);
        return view('specialist.organizations.edit', ['organization' => $organization]);
    }

    /**
     * @param UpdateOrganizationRequest $request
     * @param $id
     * @param UpdateOrganization $updateOrganization
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateOrganizationRequest $request, $id, UpdateOrganization $updateOrganization)
    {
        $validatedRequest = $request->validated();
        $organization = Organization::withTrashed()->with('contacts')->find($id);

        $updateOrganization->execute($validatedRequest, $organization);
        return redirect()->route('specialist.organizations.show',['organization' => $organization]);
    }

    /**
     * @param $id
     * @return string
     */
    public function destroy($id)
    {
        $organization = Organization::find($id);
        if($organization) {
            $organization->delete();
            return redirect()->route('specialist.organizations.index');
        }

        $organization = Organization::withTrashed()->find($id);
        $organization->restore();
        return redirect()->route('specialist.organizations.show',['organization' => $organization]);
    }
}
