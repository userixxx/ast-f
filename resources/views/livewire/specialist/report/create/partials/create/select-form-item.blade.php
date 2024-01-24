<div>
    <div class="mb-3">
        <label for="field_{{$formField->id}}" class="form-label">{{$formField->name}} ({{$formField->unit}})</label>
        <select class="form-select" aria-label="data[field_{{$formField->id}}]" name="data[field_{{$formField->id}}]">
            @foreach($formField->select_fields as $item)
                <option value="{{$item}}">{{$item}}</option>
            @endforeach
        </select>
    </div>
    @if($formField->hint)
        <div id="field_{{$formField->id}}Help" class="form-text">{{$formField->hint}}</div>
    @endif
</div>
