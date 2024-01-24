@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3"><span class="text-black-50 d-none d-sm-inline d-lg-inline d-md-inline">Новое поле </span></h3>
        </div>
        <div class="row">
            <p>
                <a class="btn btn-outline-secondary btn-sm" href="{{route('admin.form-fields.index')}}">Все поля</a>
            </p>
        </div>
        <div class="row">
            <div class="col">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8">
                <form action="{{route('admin.computed-form-fields.update',['computed_form_field' => $computed_form_field])}}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="field_category_id" class="form-label">Название формы</label>
                        <select class="form-select mb-3" aria-label=".form-select example" name="form_id" id="form_id">
                            @foreach($forms as $form)
                                <option value="{{$form->id}}" {{(old('form_id') ?? $computed_form_field->form_id) == $form->id ? 'selected' : ''}}>{{$form->name}}</option>
                            @endforeach
                        </select>
                        <div id="field_category_idHelp" class="form-text"></div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Название</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" value="{{old('name') ?? $computed_form_field->name }}" required>
                        <div id="nameHelp" class="form-text"></div>
                    </div>

                    <div class="mb-3">
                        <label for="field_category_id" class="form-label">Категория поля</label>
                        <select class="form-select mb-3" aria-label=".form-select example" name="field_category_id" id="field_category_id">
                            @foreach($field_categories as $category)
                                <option value="{{$category->id}}" {{(old('field_category_id') ?? $computed_form_field->field_category_id)  == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                        <div id="field_category_idHelp" class="form-text"></div>
                    </div>


                    <div class="mb-3">
                        <input type="hidden" name="required" value="0">
                        <input class="form-check-input" type="checkbox" value="1" {{(old('required') || $computed_form_field->required) ? 'checked' : ''}} name="required" id="required">
                        <label for="required" class="form-label">Обязательное поле</label>
                    </div>

                    <div class="mb-3">
                        <label for="formula" class="form-label">Формула</label>
                        <textarea class="form-control" name="formula" id="formula" cols="30" rows="5">{{old('formula') ?? $computed_form_field->formula}}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="unit" class="form-label">Единица измерения</label>
                        <select class="form-select mb-3" aria-label=".form-select example" name="unit" id="unit">
                            @foreach($field_units as $unit)
                                <option value="{{$unit}}" {{(old('unit') ?? $computed_form_field->unit )== $unit ? 'selected' : ''}}>{{$unit}}</option>
                            @endforeach
                        </select>
                        <div id="unitHelp" class="form-text"></div>
                    </div>


                    <div class="mb-3">
                        <label for="operator_a" class="form-label">Оператор A</label>
                        <select class="form-select mb-3" aria-label=".form-select-lg example" name="operator_a" id="operator_a">
                            <option value="sum" {{(old('operator_a') ?? $computed_form_field->operator_a) == "sum" ? 'selected' : ''}}>Сумма</option>
                            <option value="avg" {{(old('operator_a')?? $computed_form_field->operator_a) == "avg" ? 'selected' : ''}}>Среднее</option>
                            <option value="join" {{(old('operator_a')?? $computed_form_field->operator_a) == "join" ? 'selected' : ''}}>Объединение</option>
                            <option value="count" {{(old('operator_a')?? $computed_form_field->operator_a) == "count" ? 'selected' : ''}}>Количество</option>
                        </select>
                        <div id="operator_aHelp" class="form-text">Итоговые вычисления.</div>
                    </div>

                    <div class="mb-3">
                        <label for="operator_b" class="form-label">Оператор B</label>
                        <select class="form-select mb-3" aria-label=".form-select-lg example" name="operator_b" id="operator_b">
                            <option value="sum" {{(old('operator_b') ?? $computed_form_field->operator_b) == "sum" ? 'selected' : ''}}>Сумма</option>
                            <option value="avg" {{(old('operator_b') ?? $computed_form_field->operator_b) == "avg" ? 'selected' : ''}}>Среднее</option>
                            <option value="join" {{(old('operator_b') ?? $computed_form_field->operator_b) == "join" ? 'selected' : ''}}>Объединение</option>
                            <option value="count" {{(old('operator_b') ?? $computed_form_field->operator_b) == "count" ? 'selected' : ''}}>Количество</option>
                        </select>
                        <div id="operator_bHelp" class="form-text">Итоговые вычисления.</div>
                    </div>

                    <div class="mb-3">
                        <label for="operator_c" class="form-label">Оператор C</label>
                        <select class="form-select mb-3" aria-label=".form-select-lg example" name="operator_c" id="operator_c">
                            <option value="sum" {{(old('operator_c') ?? $computed_form_field->operator_c) == "sum" ? 'selected' : ''}}>Сумма</option>
                            <option value="avg" {{(old('operator_c') ?? $computed_form_field->operator_c) == "avg" ? 'selected' : ''}}>Среднее</option>
                            <option value="join" {{(old('operator_c') ?? $computed_form_field->operator_c) == "join" ? 'selected' : ''}}>Объединение</option>
                            <option value="count" {{(old('operator_c') ?? $computed_form_field->operator_c) == "count" ? 'selected' : ''}}>Количество</option>
                        </select>
                        <div id="operator_cHelp" class="form-text">Итоговые вычисления.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>

            </div>
        </div>
    </div>
@endsection
