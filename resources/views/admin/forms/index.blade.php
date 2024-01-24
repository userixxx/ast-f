@extends('layouts.admin')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="my-3">
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>
            </div>
        @endforeach
    @endif
    <div class="container py-4">
        <div class="row">
            <h3 class="h3">Формы</h3>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{route('admin.forms.create')}}" type="button"
                       class="btn btn-outline-primary">
                        <nobr>
                            <i class="fa fa-solid fa-plus"></i>
                            <span class="">Создать</span>
                        </nobr>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{route('admin.forms.index',['select' => 'withTrashed'])}}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == 'withTrashed' ? 'active' : ''}}">Все</a>
                    <a href="{{route('admin.forms.index',['select' =>'withoutTrashed'])}}" type="button"
                       class="btn btn-outline-secondary {{(request()->get('select') == 'withoutTrashed') || (request()->get('select') == null) ? 'active' : ''}}">Активные</a>
                    <a href="{{route('admin.forms.index',['select' => 'trashed']) }}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == 'trashed' ? 'active' : ''}}">Деактивированные</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                @include('admin.forms.partials.forms-table')
            </div>
        </div>

        <div class="row">
            <div class="col">
                {{$forms->withQueryString()->links()}}
            </div>
        </div>


    </div>
@endsection
