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
            </div>
        </div>
        <div class="row">
            <h3 class="h3">Фермы</h3>
        </div>
        <div class="row">
            <div class="col-2 my-1 ">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{route('specialist.farms.create')}}" type="button"
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
                    <a href="{{route('specialist.farms.index',['select' => 'withTrashed'])}}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == 'withTrashed' ? 'active' : ''}}">Все</a>
                    <a href="{{route('specialist.farms.index',['select' =>null])}}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == '' ? 'active' : ''}}">Активные</a>
                    <a href="{{route('specialist.farms.index',['select' => 'trashed']) }}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == 'trashed' ? 'active' : ''}}">Деактивированные</a>
                </div>
            </div>
            <div class="col my-1 ms-auto">
                <div class="form-group">
                    <form action="{{route(request()->route()->getName(),request()->getQueryString())}}">
                        <input type="hidden" name="select" value="{{request()->select}}">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Поиск по названию" value="{{old('name')}}">
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @include('specialist.farms.partials.farms-table')
                {!! $farms->appends(request()->query())->links() !!}
            </div>
        </div>



    </div>
@endsection
