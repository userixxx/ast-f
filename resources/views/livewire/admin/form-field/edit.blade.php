<div>
    <form action="{{route('admin.form-fields.update',['form_field' => $form_field])}}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="form_id" value="{{$form_field->form_id}}">
        <div class="mb-3">
            <label for="name" class="form-label">Название</label>
            <input type="text" class="form-control" min="1" id="name" name="name" aria-describedby="nameHelp" value="{{old('name') ?? $form_field->name}}" required>
            <div id="nameHelp" class="form-text">Название должно быть уникальным.</div>
        </div>

        <div class="mb-3">
            <label for="number" class="form-label">Порядковый номер</label>
            <input type="number" class="form-control" id="number" name="number" aria-describedby="numberHelp" value="{{old('number') ?? $form_field->number}}" required>
            <div id="nameHelp" class="form-text">Будет формировать порядок при отображении.</div>
        </div>

        <div class="mb-3">
            <input type="hidden" name="required" value="0">
            <input class="form-check-input" type="checkbox" value="1" {{$form_field->required ? 'checked' : ''}} name="required" id="required">
            <label for="required" class="form-label">Обязательное поле</label>
        </div>

        <div class="mb-3">
            <label for="field_category_id" class="form-label">Категория поля</label>
            <select class="form-select mb-3" aria-label=".form-select example" name="field_category_id" id="field_category_id">
                @foreach($field_categories as $category)
                    <option value="{{$category->id}}" {{(old('field_category_id') ?? $form_field->category->id) == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                @endforeach
            </select>
            <div id="field_category_idHelp" class="form-text"></div>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Тип</label>
            <select class="form-select mb-3" aria-label=".form-select example" name="type" id="type" wire:model="selectedType">
                @foreach($types as $key=>$value)
                <option value="{{$key}}" {{(old('type') ?? $form_field->type) == $key ? 'selected' : ''}}>{{$value}}</option>
                @endforeach
            </select>
            <div id="nameHelp" class="form-text">Изменяя тип поля данные в старых полях могут не совпасть с типом</div>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Класс</label>
            <select class="form-select mb-3" aria-label=".form-select example" name="class" id="class" wire:model="class">
                <option value="fillable" {{(old('type') ?? $form_field->class) == 'fillable' ? 'selected' : ''}}>Обычное поле</option>
                <option value="computed" {{(old('type') ?? $form_field->class) == 'computed' ? 'selected' : ''}}>Вычисляемое поле</option>
            </select>
            <div id="nameHelp" class="form-text"></div>
        </div>

        @if($class === 'computed')
            <div class="mb-3">
                <label for="formula" class="form-label">Формула</label>
                <textarea class="form-control" name="formula" id="formula" cols="30" rows="5">{{old('class') ?? $form_field->formula}}</textarea>
            </div>
        @endif


        @if($selectedType === 'number')
        <div class="mb-3">
            <label for="step" class="form-label">Шаг</label>
            <select class="form-select mb-3" aria-label=".form-select example" name="step" id="step">
                <option value="1" {{old('step')?? $form_field->type == "1" ? 'selected' : ''}}>1</option>
                <option value="0.1" {{old('step')?? $form_field->type == "0.1" ? 'selected' : ''}}>0.1</option>
                <option value="0.01" {{old('step')?? $form_field->type == "0.01" ? 'selected' : ''}}>0.01</option>
                <option value="0.001" {{old('step')?? $form_field->type == "0.001" ? 'selected' : ''}}>0.001</option>
                <option value="0.0001" {{old('step')?? $form_field->type == "0.0001" ? 'selected' : ''}}>0.0001</option>
                <option value="0.00001" {{old('step')?? $form_field->type == "0.00001" ? 'selected' : ''}}>0.00001</option>
            </select>
            <div id="stepHelp" class="form-text">Если тип число.</div>
        </div>
        @endif
        @if($selectedType === 'checkbox' || $selectedType === 'radio' || $selectedType === 'select')
        <div class="mb-3">
            <label for="select_fields" class="form-label">Элементы для выбора</label>
            <input type="text" class="form-control" id="select_fields" name="select_fields" aria-describedby="select_fieldsHelp" value="{{old('select_fields') ?? $form_field->joinedSelectFields}}">
            <div id="select_fieldsHelp" class="form-text">Только для типов Выпадающий список, Чекбокс и Радиокнопка. Введите значения через запятую.</div>
        </div>
        @endif
        <div class="mb-3">
            <label for="unit" class="form-label">Единица измерения</label>
            <select class="form-select mb-3" aria-label=".form-select example" name="unit" id="unit">
                @foreach($field_units as $unit)
                    <option value="{{$unit->name}}" {{(old('unit')  ?? $form_field->unit)== $unit->name ? 'selected' : ''}}>{{$unit->name}}</option>
                @endforeach
            </select>
            <div id="unitHelp" class="form-text"></div>
        </div>


{{--        <div class="mb-3">--}}
{{--            <label for="operator_a" class="form-label">Оператор A</label>--}}
{{--            <select class="form-select mb-3" aria-label=".form-select-lg example" name="operator_a" id="operator_a">--}}
{{--                <option value="sum" {{(old('operator_a') ?? $form_field->operator_a) == "sum" ? 'selected' : ''}}>Сумма</option>--}}
{{--                <option value="avg" {{(old('operator_a') ?? $form_field->operator_a) == "avg" ? 'selected' : ''}}>Среднее</option>--}}
{{--                <option value="join" {{(old('operator_a') ?? $form_field->operator_a) == "join" ? 'selected' : ''}}>Объединение</option>--}}
{{--                <option value="count" {{(old('operator_a') ?? $form_field->operator_a) == "count" ? 'selected' : ''}}>Количество</option>--}}
{{--            </select>--}}
{{--            <div id="operator_aHelp" class="form-text">Оставить по умолчанию.</div>--}}
{{--        </div>--}}

{{--        <div class="mb-3">--}}
{{--            <label for="operator_b" class="form-label">Оператор B</label>--}}
{{--            <select class="form-select mb-3" aria-label=".form-select-lg example" name="operator_b" id="operator_b">--}}
{{--                <option value="sum" {{(old('operator_b')?? $form_field->operator_b) == "sum" ? 'selected' : ''}}>Сумма</option>--}}
{{--                <option value="avg" {{(old('operator_b')?? $form_field->operator_b) == "avg" ? 'selected' : ''}}>Среднее</option>--}}
{{--                <option value="join" {{(old('operator_b')?? $form_field->operator_b) == "join" ? 'selected' : ''}}>Объединение</option>--}}
{{--                <option value="count" {{(old('operator_b')?? $form_field->operator_b) == "count" ? 'selected' : ''}}>Количество</option>--}}
{{--            </select>--}}
{{--            <div id="operator_bHelp" class="form-text">Оставить по умолчанию.</div>--}}
{{--        </div>--}}

{{--        <div class="mb-3">--}}
{{--            <label for="operator_c" class="form-label">Оператор C</label>--}}
{{--            <select class="form-select mb-3" aria-label=".form-select-lg example" name="operator_c" id="operator_c">--}}
{{--                <option value="sum" {{(old('operator_c')?? $form_field->operator_c) == "sum" ? 'selected' : ''}}>Сумма</option>--}}
{{--                <option value="avg" {{(old('operator_c')?? $form_field->operator_c) == "avg" ? 'selected' : ''}}>Среднее</option>--}}
{{--                <option value="join" {{(old('operator_c')?? $form_field->operator_c) == "join" ? 'selected' : ''}}>Объединение</option>--}}
{{--                <option value="count" {{(old('operator_c')?? $form_field->operator_c) == "count" ? 'selected' : ''}}>Количество</option>--}}
{{--            </select>--}}
{{--            <div id="operator_cHelp" class="form-text">Оставить по умолчанию.</div>--}}
{{--        </div>--}}
        <button type="submit" class="btn btn-primary">Обновить</button>
    </form></div>
