<?php

namespace App\Http\Livewire\Specialist\Organizations\Edit;


use App\Models\District;
use App\Models\Region;
use Livewire\Component;

class SelectRegionAndDistrict extends Component
{
    public $organization = null;
    public $regions = [];
    public $region;
    public $districts = [];
    public $district;
    public $regionSearch = '';
    public $districtSearch = '';
    public $regionId = null;
    public $districtId = null;

    public function __construct()
    {
        $this->regions = Region::where('name', 'like', '%' . $this->regionSearch . '%')->get();

    }

    public function mount($organization)
    {
        $this->organization = $organization;
        $this->regionSearch = $organization?->region->name;
        $this->regionId = $organization?->region_id;
        $this->districtSearch = $organization?->district->name;
        $this->districtId = $organization?->district_id;

    }

    public function hydrate()
    {
        $this->regions = Region::where('name', 'like', '%' . $this->regionSearch . '%')->get();
    }


    public function updatedRegionSearch()
    {
        $this->regions = Region::where('name', 'like', '%' . $this->regionSearch . '%')->get();
        $this->regionId = Region::where('name', $this->regionSearch)?->first()?->id;
        $this->districtSearch = '';
        $this->getDistricts();
    }

    public function updatedDistrictSearch()
    {
        $this->getDistricts();
        $this->districtId = District::where('name', $this->districtSearch)?->first()?->id;

    }

    public function getDistricts()
    {
        $this->districts = District::where('region_id', $this->regionId)
            ->where('name', 'like', '%' . $this->districtSearch . '%')
            ->get();
    }
    public function render()
    {
        return view('livewire.specialist.organizations.edit.select-region-and-district');
    }
}
