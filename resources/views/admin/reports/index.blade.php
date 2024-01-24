@extends('layouts.admin')
@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3">Отчёты</h3>
        </div>
        <div class="row">
            <div class="col">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{route('admin.reports.index',['select' => 'withTrashed'])}}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == 'withTrashed'  ? 'active' : ''}}">Все</a>
                    <a href="{{route('admin.reports.index',['select' =>'withoutTrashed'])}}" type="button"
                       class="btn btn-outline-secondary {{(request()->get('select') == 'withoutTrashed' || request()->get('select') == null)? 'active' : ''}}">Активные</a>
                    <a href="{{route('admin.reports.index',['select' => 'trashed']) }}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == 'trashed' ? 'active' : ''}}">Деактивированные</a>
                </div>
            </div>
        </div>

        @if(Session::has('msg'))
        <div class="row mt-4">
            <div class="col">
                <div class="alert alert-success" role="alert">
                    {{ Session::get('msg') }}
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col">
                @include('admin.reports.partials.reports-table')
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                {{$reports->withQueryString()->links()}}
            </div>
        </div>


    </div>
@endsection
