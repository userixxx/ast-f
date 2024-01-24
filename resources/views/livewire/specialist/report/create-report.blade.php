<div>
    <form action="{{route('specialist.reports.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleDataList" class="form-label">Организация</label>
            <input class="form-control {{$organisationId ? 'border border-success' : 'border border-danger'}}" list="organisationDatalistOptions" id="selectedOrganisation"
                   autocomplete="off"
                   placeholder="Начните вводить название..."  wire:model="selectedOrganisation" >
            <datalist id="organisationDatalistOptions">
                @foreach($organisations as $organisation)
                    <option value="{{$organisation->name}}"></option>
                @endforeach
            </datalist>
            <input type="hidden" name="organization_id" value="{{$organisationId}}">

        </div>

        <div class="mb-3">
            <label for="exampleDataList" class="form-label">Фермы</label>
            <input class="form-control {{$farmId ? 'border border-success' : 'border border-danger'}}" list="farmDatalistOptions" id="selectedFarm"
                   autocomplete="off"
                   placeholder="Начните вводить название..." wire:model="selectedFarm" {{$organisationId ? '' : 'disabled'}}>
            <datalist id="farmDatalistOptions">
                @foreach($farms as $farm)
                    <option value="{{$farm->name}}">
                @endforeach
            </datalist>
            <input type="hidden" name="farm_id" value="{{$farmId}}">
            <input type="hidden" name="farm_uuid" value="{{$farmUuid}}">

        </div>


        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Дата</label>
            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder=""
                   value="{{now()->format('Y-m-d')}}" name="date">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Форма</label>
            <select class="form-select" aria-label="Default select example" wire:model="selectedForm" name="form_id">
                    <option value="0">...</option>
                @foreach($forms as $form)
                    <option value="{{$form->id}}">{{$form->name}}</option>
                @endforeach
            </select>

        </div>

        <div class="mb-3">
            @forelse($formFieldsCategories as $fieldCategory)
                @if($fieldCategory->fields->count())
                    <h3 class="h3">{{$fieldCategory->name}}</h3>
                    <div class="alert" style="background-color: {{$colors[$fieldCategory->id]}}">
                    @foreach($fieldCategory->fields as $formField)
                        @if($formField->class !== 'computed')
                            @switch($formField->type)
                                @case('number')
                                    @include('livewire.specialist.report.create.partials.number-form-item')
                                    @break
                                @case('text')
                                    @include('livewire.specialist.report.create.partials.text-form-item')
                                    @break
                                @case('checkbox')
                                    @include('livewire.specialist.report.create.partials.checkbox-form-item')
                                    @break
                                @case('select')
                                    @include('livewire.specialist.report.create.partials.select-form-item')
                                    @break
                                @case('radio')
                                    @include('livewire.specialist.report.create.partials.radio-form-item')
                                    @break
                            @endswitch
                        @else
                            <div>
                                <div class="mb-3">
                                    <label for="field_{{$formField->id}}" class="form-label">{{$formField->name}} ({{$formField->unit}})</label>
                                    <input type="text"
                                           class="form-control "
                                           disabled
                                           id="field_{{$formField->id}}"
                                           placeholder="{{$formField->placeholder}}">
                                </div>
                                <div id="field_{{$formField->id}}Help" class="form-text">{{$formField->formula}}</div>
                            </div>
                        @endif
                    @endforeach
                    </div>
                @else
                @endif
            @empty
                <p>Не найдено</p>
            @endforelse

        </div>

        <div class="mb-3">
            <label for="formFile" class="form-label">Файлы</label>
            <input class="form-control" type="file" id="formFiles" name="files[]" multiple>
        </div>


        <button type="button" class="btn btn-primary" {{$readyToSave ? '' : 'disabled'}} wire:click="fillFields">Заполнить данными</button>
        <button type="submit" class="btn btn-primary" {{$readyToSave ? '' : 'disabled'}}>Сохранить</button>
    </form>
</div>
