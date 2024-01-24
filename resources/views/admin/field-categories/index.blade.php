@extends('layouts.admin')
@section('content')
    <div class="container py-4">
        @if(Session::has('successMsg'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('successMsg') }}
            </div>
        @endif
        <div class="row">
            <h3 class="h3">Категория поля</h3>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{route('admin.field-categories.create')}}" type="button"
                       class="btn btn-outline-primary">
                        <nobr>
                            <i class="fa fa-solid fa-plus"></i>
                            <span class="">Создать</span>
                        </nobr>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                @include('admin.field-categories.partials.fc-table')
            </div>
        </div>


    </div>
@endsection
