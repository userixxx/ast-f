@extends('layouts.admin')
@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3">Поля формы</h3>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{route('admin.form-fields.create',['from' => 'form_fields'])}}" type="button"
                       class="btn btn-outline-primary">
                        <nobr>
                            <i class="fa fa-solid fa-plus"></i>
                            <span class="">Создать поле</span>
                        </nobr>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{route('admin.form-fields.index',['select' => 'withTrashed'])}}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == 'withTrashed' ? 'active' : ''}}">Все</a>
                    <a href="{{route('admin.form-fields.index',['select' =>null])}}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == null ? 'active' : ''}}">Активные</a>
                    <a href="{{route('admin.form-fields.index',['select' => 'trashed']) }}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == 'trashed' ? 'active' : ''}}">Деактивированные</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                @include('admin.form-fields.partials.form-fields-table')
            </div>
        </div>

        <div class="row">
            <div class="col">
                {{$form_fields->withQueryString()->links()}}
            </div>
        </div>


    </div>
@endsection
