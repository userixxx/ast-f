<div>
    <div class="mb-3">
        <label for="field_{{$formField->id}}" class="form-label"> <span class="text-muted">{{$formField->id}}</span>: {{$formField->name}} ({{$formField->unit}})</label>
        @foreach($formField->select_fields as $item)
        <div class="form-check">
            <input class="form-check-input"
                   type="checkbox"
                   value="{{$item}}"
                   id="item_{{$loop->iteration}}"
                   name="data[field_{{$formField->id}}][]"
                {{isset($report->data['field_'.$formField->id]) ? (in_array($item, $report->data['field_'.$formField->id]) ? 'checked' : '') : null}}>
            <label class="form-check-label" for="item_{{$loop->iteration}}">
                {{$item}}
            </label>
        </div>
        @endforeach
    </div>
    @if($formField->hint)
        <div id="field_{{$formField->id}}Help" class="form-text">{{$formField->hint}}</div>
    @endif
</div>
