@extends('layouts.admin')
@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3">Пользователи</h3>
        </div>
        <div class="row">
            <div class="col">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{route('admin.users.index',['select' => null])}}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == null ? 'active' : ''}}">Все</a>
                    <a href="{{route('admin.users.index',['select' =>'withoutTrashed'])}}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == 'withoutTrashed' ? 'active' : ''}}">Активные</a>
                    <a href="{{route('admin.users.index',['select' => 'trashed']) }}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == 'trashed' ? 'active' : ''}}">Деактивированные</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                @include('admin.users.partials.users-table')
            </div>
        </div>


    </div>
@endsection
