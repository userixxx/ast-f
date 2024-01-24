<?php
namespace App\Http\Livewire\Specialist\Organizations\Create;

use App\Models\District;
use App\Models\Region;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class SelectRegionAndDistrict extends Component
{
    public $region;
    public $district;

    public Region|Collection $regions;
    public District|Collection $districts;
    public $regionSearch = '';
    public $districtSearch = '';
    public $regionId = null;
    public $districtId = null;

    public function __construct()
    {
        $this->regions = Region::all();
        $this->districts = new Collection();

    }

    public function mount($farm = null)
    {

    }

    public function updatingRegionSearch($value)
    {
        $this->region = $this->regions->firstWhere('name', $value);
        if ($this->region) {
            $this->districts = District::where('region_id', $this->region?->id)->get();
            $this->regionId = $this->region->id;
        } else{
            $this->dropRegion();
        }
    }

    public function updatedDistrictSearch($value)
    {
        if ($this->region) {
            $this->district = $this->districts->firstWhere('name', $value);
            if($this->district) {
                $this->districtId = $this->district?->id;
            } else {
                $this->dropDistrict();
            }
        }
    }

    public function render()
    {
        return view('livewire.specialist.organizations.create.select-region-and-district');
    }

    private function dropRegion()
    {
        $this->region = new Region();
        $this->regionId = null;
        $this->district = new District();
        $this->districtId = null;
        $this->districtSearch = '';
        $this->districts = new Collection();
    }

    private function dropDistrict()
    {
        $this->district = new District();
        $this->districtId = null;
    }
}
