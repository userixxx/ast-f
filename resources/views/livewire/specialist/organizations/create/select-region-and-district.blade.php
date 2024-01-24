<div>
    <div class="mb-3">
        <label for="region_name" class="form-label">Регион </label>
        <input class="form-control {{$regionId ? 'bordered border-success' : 'border-danger'}}" list="regionDatalistOptions" wire:mode="regionSearch" wire:model.debounce.100ms="regionSearch" name="region_name" id="region_name" placeholder="Введите название региона ..." autocomplete="off">
        <datalist id="regionDatalistOptions">
            @foreach($this->regions as $region)
                <option data-value="1">{{$region->name}}</option>
            @endforeach
        </datalist>


        <input type="hidden" value="{{$regionId}}" name="region_id">

    </div>

    <div class="mb-3">
        <label for="district_name" class="form-label">Район </label>
        <input class="form-control {{$districtId ? 'bordered border-success' : 'border-danger'}}" list="districtDatalistOptions" wire:mode="districtSearch" wire:model.debounce.100ms="districtSearch" name="district_name" id="district_name" placeholder="Введите название района ..." autocomplete="off">
        <datalist id="districtDatalistOptions">
            @foreach($this->districts as $district)
                <option data-value="1" >{{$district->name}}</option>
            @endforeach
        </datalist>
        <input type="hidden" value="{{$districtId}}" name="district_id">
    </div>
</div>

