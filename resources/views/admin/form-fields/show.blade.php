@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3"><span class="text-black-50 d-none d-sm-inline d-lg-inline d-md-inline">Поле </span> {{$form_field->name}}</h3>
        </div>
        <div class="row">
            <p>
                <a class="btn btn-link" href="{{route('admin.form-fields.index')}}">Все поля</a>
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
                <div class="card w-100 my-1">
                    <div class="card-body">

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Категория</h6>
                            <h5 class="card-title">{{$form_field?->category?->name}}</h5>
                        </div>

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Порядковый номер</h6>
                            <h5 class="card-title">{{$form_field?->number}}</h5>
                        </div>

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Тип</h6>
                            <h5 class="card-title">{{$form_field?->typeName}}</h5>
                        </div>

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Единица измерения</h6>
                            <h5 class="card-title">{{$form_field?->unit}}</h5>
                        </div>

                        @if(in_array($form_field?->type, ['select', 'checkbox', 'radio'] ))
                            <div class="p-2 mb-2 bg-info bg-opacity-10">
                                <h6 class="card-subtitle mb-2 text-muted">Значения для типа {{$form_field?->typeName}} </h6>
                                <h5 class="card-title">{{$form_field?->joinedSelectFields}}</h5>
                            </div>
                        @endif

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Форма</h6>
                            <h5 class="card-title"><a href="{{route('admin.forms.show',['form'=>$form_field?->form])}}">{{$form_field?->form?->name}}</a></h5>
                        </div>

{{--                        <div class="p-2 mb-2 bg-info bg-opacity-10">--}}
{{--                            <h6 class="card-subtitle mb-2 text-muted">Оператор А</h6>--}}
{{--                            <h5 class="card-title">{{$form_field?->translatedOperatorA}}</h5>--}}
{{--                        </div>--}}


{{--                        <div class="p-2 mb-2 bg-info bg-opacity-10">--}}
{{--                            <h6 class="card-subtitle mb-2 text-muted">Оператор B</h6>--}}
{{--                            <h5 class="card-title">{{$form_field?->translatedOperatorB}}</h5>--}}
{{--                        </div>--}}


{{--                        <div class="p-2 mb-2 bg-info bg-opacity-10">--}}
{{--                            <h6 class="card-subtitle mb-2 text-muted">Оператор C</h6>--}}
{{--                            <h5 class="card-title">{{$form_field?->translatedOperatorC}}</h5>--}}
{{--                        </div>--}}


                        <p class="card-text text-muted">
                            Создано: {{$form_field->created_at}}
                        </p>

                        <div class="d-flex">
                            <a href="{{route('admin.form-fields.edit',['form_field' => $form_field->id])}}" class="btn btn-outline-secondary">
                                <i class="fa-solid fa-pen"></i>
                                Редактировать
                            </a>

                            <form action="{{route('admin.form-fields.destroy',['form_field' => $form_field->id])}}" method="POST" class="mx-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    @if(!$form_field->deleted_at)
                                        <i class="fa fa-trash"></i> Удалить
                                    @else
                                        <i class="fa fa-trash-restore"></i> Восстановить
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
