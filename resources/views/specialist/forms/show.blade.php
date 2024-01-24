@extends('layouts.specialist')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8">
                <div class="d-flex justify-content-between">
                    <h3 class="h3">
                        <span class="text-black-50 d-none d-sm-inline d-lg-inline d-md-inline">Форма</span>
                        {{$form?->name}}
                    </h3>
                </div>

            </div>
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
                        <div class="table-responsive">
                            <table class="table table-secondary">
                                <tbody>
                                <tr>
                                    <th>Название</th>
                                    <td>
                                        {{$form?->name}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Описание</th>
                                    <td> {{$form?->description}} </td>
                                </tr>
                                <tr>
                                    <th>Категория</th>
                                    <td> {{$form?->category?->name}} </td>
                                </tr>
                                <tr>
                                    <th>Создан</th>
                                    <td> {{$form?->creator?->name}} / {{$form->created_at}} </td>
                                </tr>
                                <tr>
                                    <th>Активен</th>
                                    <td> {{$form?->deleted_at ? 'нет' : "да"}}</td>
                                </tr>
                                <tr>
                                    <th>Поля</th>
                                    <td>
                                        @foreach($form?->fields as $field)
                                            <p class="p">{{$field->name}}</p>
                                        @endforeach
                                        <p class="p fw-bold">Всего: {{$form->fields?->count() ?? 0}}</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

