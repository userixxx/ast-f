<div>
    <div class="mb-3">
        <label for="field_{{$formField->id}}" class="form-label"> <span class="text-muted">{{$formField->id}}</span>: {{$formField->name}} ({{$formField->unit}}) <span class="text-muted">{{$formField->id}}</span></label>
        <select
            class="form-select"
            aria-label="data[field_{{$formField->id}}]"
            name="data[field_{{$formField->id}}]">
            @foreach($formField->select_fields as $item)
                <option value="{{$item}}"
                    {{isset($report->data['field_'.$formField->id]) ? ($report->data['field_'.$formField->id]  == $item ? 'selected' : '') : null}}>{{$item}}</option>
            @endforeach
        </select>
    </div>
    @if($formField->hint)
        <div id="field_{{$formField->id}}Help" class="form-text">{{$formField->hint}}</div>
    @endif
</div>
