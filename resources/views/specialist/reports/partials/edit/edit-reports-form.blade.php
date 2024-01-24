<div>
    <form action="{{route('specialist.reports.update', ['report' => $report])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="organization_id" class="form-label">Организация</label>
                <select class="form-select" name="organization_id" id="organization_id" disabled>
                    <option value="{{$report?->organization?->id}}">{{$report?->organization?->name}}</option>
                </select>
            <input type="hidden" name="organization_id" value="{{$report?->organization?->id}}">
            </div>

            <div class="mb-3">
                <label for="organization_id" class="form-label">Ферма</label>
                <select class="form-select" name="organization_id" id="organization_id" disabled>
                    <option selected value="{{$report?->farm?->id}}">{{$report?->farm?->name}}</option>
                </select>
                <input type="hidden" name="farm_id" value="{{$report?->farm?->id}}">

            </div>

            <div class="mb-3">
                <label for="date" class="form-label fw-bolder">Дата</label>
                <input type="date" class="form-control" name="date" id="date" value="{{$report->date}}">
            </div>

            <div class="mb-3">
                <label for="form_id" class="form-label fw-bolder">Форма</label>
                <select  class="form-select" id="form_id" name="form_id" disabled>
                        <option selected
                            value="{{$report?->form->id}}" >{{$report->form->name}}</option>
                </select>
                <div id="innHelp" class="form-text"></div>
                <input type="hidden" name="farm_id" value="{{$report?->form?->id}}">
            </div>


            @foreach($formFields as $key =>$formFieldGroup)
                <h6 class="h6 fw-bold bg-secondary bg-opacity-10 p-2">{{$fieldCategories[$loop->iteration]->name}}</h6>
                <div class="alert" style="background-color: {{$colors[$loop->iteration]}}">
                    @foreach($formFieldGroup as $formField)
                        @if($formField->class !== 'computed')
                        @switch($formField->type)
                            @case('number')
                                @include('specialist.reports.partials.edit.number-form-item')
                                @break
                            @case('text')
                                @include('specialist.reports.partials.edit.text-form-item')
                                @break
                            @case('checkbox')
                                @include('specialist.reports.partials.edit.checkbox-form-item')
                                @break
                            @case('select')
                                @include('specialist.reports.partials.edit.select-form-item')
                                @break
                            @case('radio')
                                @include('specialist.reports.partials.edit.radio-form-item')
                                @break
                        @endswitch
                        @else
                            <div>
                                <div class="mb-3">
                                    <label for="field_{{$formField->id}}" class="form-label"> <span class="text-muted">{{$formField->id}}</span>: {{$formField->name}} ({{$formField->unit}})</label>
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
            @endforeach

            <div class="mb-3">
                <label for="formFile" class="form-label">Файлы</label>
                <input class="form-control" type="file" id="formFiles" name="files[]" multiple>
            </div>
            <div>
                @foreach($report->getMedia('reports') as $media)
                    <figure class="figure" style="width:200px; height:150px;">
                        @if($media->mime_type == 'image/png')
                        <img src="{{$media->getUrl()}}" class="figure-img img-fluid rounded  border-1 border p-1" alt="{{$media->name}}">
                        <figcaption class="figure-caption">
                            <input type="hidden" value="{{$media->id}}" name="media_items[{{$media->id}}]">
                            <input class="me-2" type="checkbox" value="" checked name="media_items[{{$media->id}}]"/>{{$media->name}}</figcaption>
                        @endif
                    </figure>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Обновить</button>
        </div>
    </form>

</div>
