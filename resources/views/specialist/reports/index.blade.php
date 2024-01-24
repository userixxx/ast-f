@extends('layouts.specialist')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                    @if (Session::has('msg'))
                        <div class="alert alert-success">{{ Session::get('msg') }}</div>
                    @endif
            </div>
        </div>
        <div class="row">
            <h3 class="h3">Отчёты</h3>
        </div>
        <div class="row">
            <div class="col-2 my-1 ">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{route('specialist.reports.create')}}" type="button"
                       class="btn btn-outline-primary">
                        <nobr>
                            <i class="fa fa-solid fa-plus"></i>
                            <span class="">Создать</span>
                        </nobr>
                    </a>
                </div>
            </div>
            <div class="col my-1 ms-auto">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{route('specialist.reports.index',['select' => 'withTrashed'])}}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == 'withTrashed' ? 'active' : ''}}">Все</a>
                    <a href="{{route('specialist.reports.index',['select' =>null])}}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == '' ? 'active' : ''}}">Активные</a>
                    <a href="{{route('specialist.reports.index',['select' => 'trashed']) }}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == 'trashed' ? 'active' : ''}}">Деактивированные</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @include('specialist.reports.partials.reports-table')
                {!! $reports->appends(request()->query())->links() !!}
            </div>
        </div>



    </div>
@endsection
