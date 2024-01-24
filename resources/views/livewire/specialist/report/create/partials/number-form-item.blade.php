<div>
    <div class="mb-3">
        <label for="field_{{$formField->id}}" class="form-label">{{$formField->name}} ({{$formField->unit}})</label>
        <input type="number"
               class="form-control"
               id="field_{{$formField->id}}"
               name="data[field_{{$formField->id}}]"
               {{$formField->required ? 'required' : ''}}
               min="{{$formField->min}}"
               max="{{$formField->max}}"
               step="{{$formField->step}}"
               value="{{$lastReportData["field_".$formField?->id] ?? ''}}"
               placeholder="{{$formField->placeholder}}">
    </div>
        <div id="field_{{$formField->id}}Help" class="form-text">{{$formField->hint}}</div>
{{--    @if($formField->hint)--}}
{{--    @endif--}}
</div>
