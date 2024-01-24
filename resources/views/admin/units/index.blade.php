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
            <h3 class="h3">Единицы измерения</h3>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{route('admin.units.create')}}" type="button"
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
                @include('admin.units.partials.units-table')
            </div>
        </div>

        <div class="row">
            <div class="col">
                {{$units->withQueryString()->links()}}
            </div>
        </div>


    </div>
@endsection
