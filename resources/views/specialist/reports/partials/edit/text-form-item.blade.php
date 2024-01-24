<div>
    <div class="mb-3">
        <label for="field_{{$formField->id}}" class="form-label"> <span class="text-muted">{{$formField->id}}</span>: {{$formField->name}} ({{$formField->unit}}) <span class="text-muted">{{$formField->id}}</span></label>
        <input type="text"
               class="form-control"
               id="field_{{$formField->id}}"
               name="data[field_{{$formField->id}}]"
               {{$formField->required ? 'required' : ''}}
               placeholder="{{$formField->placeholder}}"
               value="{{$report->data['field_'.$formField->id] ?? ''}}">
    </div>
    @if($formField->hint)
        <div id="field_{{$formField->id}}Help" class="form-text">{{$formField->hint}}</div>
    @endif
</div>
