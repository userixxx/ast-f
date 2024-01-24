<div>
    <div class="mb-3">
        <label for="field_{{$formField->id}}" class="form-label">{{$formField->name}} ({{$formField->unit}})</label>
        @foreach($formField->select_fields as $item)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="{{$item}}" id="item_{{$loop->iteration}}" name="data[field_{{$formField->id}}][]">
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
