@extends('layouts.specialist')

@section('content')
    <div class="container py-4">
        <div class="col my-1 ms-auto">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{route('specialist.field-templates.index',['select' => 'withTrashed'])}}" type="button"
                   class="btn btn-outline-secondary {{request()->get('select') == 'withTrashed' ? 'active' : ''}}">Все</a>
                <a href="{{route('specialist.field-templates.index',['select' =>null])}}" type="button"
                   class="btn btn-outline-secondary {{request()->get('select') == '' ? 'active' : ''}}">Активные</a>
                <a href="{{route('specialist.field-templates.index',['select' => 'trashed']) }}" type="button"
                   class="btn btn-outline-secondary {{request()->get('select') == 'trashed' ? 'active' : ''}}">Деактивированные</a>
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

                @if (session()->get('msg'))
                    <div class="alert alert-success" role="alert">
                        {{session()->get('msg')}}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <h3 class="h3">Шаблоны полей</h3>
        </div>
        <div class="row">

        </div>
        <div class="row">
            <div class="col">
                @include('specialist.field-templates.partials.field-templates-table')
            </div>
        </div>


    </div>
@endsection
