<div>
    <div class="mb-3">
        <label for="region_name" class="form-label">Регион </label>
        <input class="form-control" list="regionDatalistOptions" wire:model.debounce.100ms="regionSearch" name="region_name" id="region_name" placeholder="Республика Татарстан">
        <datalist id="regionDatalistOptions">
            @foreach($this->regions as $region)
                <option data-value="1">{{$region->name}}</option>
            @endforeach
        </datalist>


        <input type="hidden" value="{{$regionId}}" name="region_id">
    </div>

    <div class="mb-3">
        <label for="district_name" class="form-label">Район </label>
        <input class="form-control" list="districtDatalistOptions" wire:model.debounce.100ms="districtSearch" name="district_name" id="district_name" placeholder="Актанышский район">
        <datalist id="districtDatalistOptions">
            @foreach($this->districts as $district)
                <option data-value="1" >{{$district->name}}</option>
            @endforeach
        </datalist>
        <input type="hidden" value="{{$districtId}}" name="district_id">
    </div>
</div>
