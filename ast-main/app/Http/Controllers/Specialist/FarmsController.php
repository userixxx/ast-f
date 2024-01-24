<?php

namespace App\Http\Controllers\Specialist;

use App\Actions\Specialist\Farm\CreateFarm;
use App\Actions\Specialist\Farm\UpdateFarm;
use App\Http\Controllers\Controller;
use App\Http\Filters\FarmsFilter;
use App\Http\Requests\Specialist\Farm\CreateFarmRequest;
use App\Http\Requests\Specialist\Farm\UpdateFarmRequest;
use App\Models\Farm;
use Illuminate\Http\Request;

class FarmsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(FarmsFilter $farmsFilter)
    {
        $farms = Farm::filter($farmsFilter)->with(['organization', 'district', 'region'])->orderBy('created_at')->paginate(30);
        return view('specialist.farms.index', ['farms' => $farms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('specialist.organizations.index')->withErrors(['message' => 'Для создания фермы выберите организацию или создайте организацию']);
    }

    /**
     * @param CreateFarmRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateFarmRequest $request, CreateFarm $createFarm)
    {
        $validated = $request->validated();
        $farm = $createFarm->execute($validated);

        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {

        $farm = Farm::with(['reports','region','district','organization'])->withTrashed()->find($id);
        session()->put('farm_id', $id);
        return view('specialist.farms.show',['farm' => $farm]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $farm = Farm::withTrashed()->find($id);
        return view('specialist.farms.edit',['farm' => $farm]);
    }

    /**
     * @param UpdateFarmRequest $request
     * @param $id
     * @param UpdateFarm $updateFarm
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateFarmRequest $request, $id, UpdateFarm $updateFarm)
    {
        $validatedRequest = $request->validated();
        $farm = $updateFarm->execute($validatedRequest, $id);
        return redirect()->route('specialist.farms.show', ['farm' => $farm]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $farm = Farm::withTrashed()->find($id);
        if(!$farm->deleted_at) {
            $farm->delete();
            return redirect()->route('specialist.farms.index');
        }
        $farm->restore();
        return redirect()->route('specialist.farms.index');
    }
}
