<button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#fieldCreateOffcanvas" aria-controls="fieldCreateOffcanvas">Добавить поле</button>

<div class="offcanvas offcanvas-bottom h-auto" tabindex="-1" id="fieldCreateOffcanvas" aria-labelledby="fieldCreateOffcanvasLabel">
    <div class="container overflow-auto">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="fieldCreateOffcanvasLabel">Новое поле для формы</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small">
{{--        <form action="{{route('admin.form-fields.store')}}" method="POST">--}}
{{--            @csrf--}}
{{--            <input type="hidden" name="form_id" value="{{$form->id}}">--}}
{{--            <div class="mb-3">--}}
{{--                <label for="name" class="form-label">Название</label>--}}
{{--                <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" value="{{old('name')}}" required>--}}
{{--                <div id="nameHelp" class="form-text"></div>--}}
{{--            </div>--}}

{{--            <div class="mb-3">--}}
{{--                <label for="number" class="form-label">Порядковый номер</label>--}}
{{--                <input type="number" min="1" class="form-control" id="number" name="number" aria-describedby="numberHelp" value="{{old('number')}}" required>--}}
{{--                <div id="numberHelp" class="form-text">Используется при отображении.</div>--}}
{{--            </div>--}}

{{--            <div class="mb-3">--}}
{{--                <label for="field_category_id" class="form-label">Категория поля</label>--}}
{{--                <select class="form-select mb-3" aria-label=".form-select example" name="field_category_id" id="field_category_id">--}}
{{--                    @foreach($field_categories as $category)--}}
{{--                        <option value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--                <div id="field_category_idHelp" class="form-text"></div>--}}
{{--            </div>--}}


{{--            <div class="mb-3">--}}
{{--                <input type="hidden" name="required" value="0">--}}
{{--                <input class="form-check-input" type="checkbox" value="1" name="required" id="required">--}}
{{--                <label for="required" class="form-label">Обязательное поле</label>--}}
{{--            </div>--}}

{{--            <div class="mb-3">--}}
{{--                <label for="type" class="form-label">Тип</label>--}}
{{--                <select class="form-select mb-3" aria-label=".form-select example" name="type" id="type">--}}
{{--                    <option value="text" {{old('type' == "text" ? 'selected' : '')}}>Строка</option>--}}
{{--                    <option value="number" {{old('type' == "number" ? 'selected' : '')}}>Число</option>--}}
{{--                    <option value="select" {{old('type' == "select" ? 'selected' : '')}}>Выпадающий список</option>--}}
{{--                    <option value="checkbox" {{old('type' == "checkbox" ? 'selected' : '')}}>Чекбокс</option>--}}
{{--                    <option value="radio" {{old('type' == "radio" ? 'selected' : '')}}>Радиокнопка</option>--}}
{{--                </select>--}}
{{--                <div id="nameHelp" class="form-text"></div>--}}
{{--            </div>--}}


{{--            <div class="mb-3">--}}
{{--                <label for="step" class="form-label">Шаг</label>--}}
{{--                <select class="form-select mb-3" aria-label=".form-select example" name="step" id="step">--}}
{{--                    <option value="1" {{old('step') == "1" ? 'selected' : ''}}>1</option>--}}
{{--                    <option value="0.1" {{old('step') == "0.1" ? 'selected' : ''}}>0.1</option>--}}
{{--                    <option value="0.01" {{old('step') == "0.01" ? 'selected' : ''}}>0.01</option>--}}
{{--                    <option value="0.001" {{old('step') == "0.001" ? 'selected' : ''}}>0.001</option>--}}
{{--                    <option value="0.0001" {{old('step') == "0.0001" ? 'selected' : ''}}>0.0001</option>--}}
{{--                    <option value="0.00001" {{old('step') == "0.00001" ? 'selected' : ''}}>0.00001</option>--}}
{{--                </select>--}}
{{--                <div id="stepHelp" class="form-text">Если тип число.</div>--}}
{{--            </div>--}}

{{--            <div class="mb-3">--}}
{{--                <label for="select_fields" class="form-label">Элементы для выбора</label>--}}
{{--                <input type="text" class="form-control" id="select_fields" name="select_fields" aria-describedby="select_fieldsHelp" value="{{old('select_fields')}}">--}}
{{--                <div id="select_fieldsHelp" class="form-text">Только для типов Выпадающий список, Чекбокс и Радиокнопка. Введите значения через запятую.</div>--}}
{{--            </div>--}}

{{--            <div class="mb-3">--}}
{{--                <label for="unit" class="form-label">Единица измерения</label>--}}
{{--                <select class="form-select mb-3" aria-label=".form-select example" name="unit" id="unit">--}}
{{--                    @foreach($field_units as $unit)--}}
{{--                    <option value="{{$unit}}" {{old('unit' == $unit ? 'selected' : '')}}>{{$unit}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--                <div id="unitHelp" class="form-text"></div>--}}
{{--            </div>--}}


{{--            <div class="mb-3">--}}
{{--                <label for="operator_a" class="form-label">Оператор A</label>--}}
{{--                <select class="form-select mb-3" aria-label=".form-select-lg example" name="operator_a" id="operator_a">--}}
{{--                    <option value="sum" {{old('operator_a' == "sum" ? 'selected' : '')}}>Сумма</option>--}}
{{--                    <option value="avg" {{old('operator_a' == "avg" ? 'selected' : '')}}>Среднее</option>--}}
{{--                    <option value="join" {{old('operator_a' == "join" ? 'selected' : '')}}>Склейка</option>--}}
{{--                    <option value="count" {{old('operator_a' == "count" ? 'selected' : '')}}>Количество</option>--}}
{{--                </select>--}}
{{--                <div id="operator_aHelp" class="form-text">Оставить по умолчанию.</div>--}}
{{--            </div>--}}

{{--            <div class="mb-3">--}}
{{--                <label for="operator_b" class="form-label">Оператор B</label>--}}
{{--                <select class="form-select mb-3" aria-label=".form-select-lg example" name="operator_b" id="operator_b">--}}
{{--                    <option value="sum" {{old('operator_b' == "sum" ? 'selected' : '')}}>Сумма</option>--}}
{{--                    <option value="avg" {{old('operator_b' == "avg" ? 'selected' : '')}}>Среднее</option>--}}
{{--                    <option value="join" {{old('operator_b' == "join" ? 'selected' : '')}}>Склейка</option>--}}
{{--                    <option value="count" {{old('operator_b' == "count" ? 'selected' : '')}}>Количество</option>--}}
{{--                </select>--}}
{{--                <div id="operator_bHelp" class="form-text">Оставить по умолчанию.</div>--}}
{{--            </div>--}}

{{--            <div class="mb-3">--}}
{{--                <label for="operator_c" class="form-label">Оператор C</label>--}}
{{--                <select class="form-select mb-3" aria-label=".form-select-lg example" name="operator_c" id="operator_c">--}}
{{--                    <option value="sum" {{old('operator_c' == "sum" ? 'selected' : '')}}>Сумма</option>--}}
{{--                    <option value="avg" {{old('operator_c' == "avg" ? 'selected' : '')}}>Среднее</option>--}}
{{--                    <option value="join" {{old('operator_c' == "join" ? 'selected' : '')}}>Склейка</option>--}}
{{--                    <option value="count" {{old('operator_c' == "count" ? 'selected' : '')}}>Количество</option>--}}
{{--                </select>--}}
{{--                <div id="operator_cHelp" class="form-text">Оставить по умолчанию.</div>--}}
{{--            </div>--}}
{{--            <button type="submit" class="btn btn-primary">Сохранить</button>--}}
{{--        </form>--}}
    <livewire:admin.form-field.create :form="$form" :field_categories="$field_categories" :field_units="$field_units">
    </div>
    </div>
</div>
