@extends('layouts.specialist')

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3"><span class="text-black-50 d-none d-sm-inline d-lg-inline d-md-inline">Организация</span> {{$organization->name}}</h3>
            <span class="text-black-50 d-none d-sm-inline d-lg-inline d-md-inline">{{$organization->deleted_at ? 'деактивирована' : ''}}</span>
        </div>
        <div class="row">
            <p>
                <a class="btn btn-outline-secondary btn-sm" href="{{route('specialist.organizations.index')}}">Все организации</a>
            </p>
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
                                <thead>
                                <tr>
                                    <th>Регион</th>
                                    <td>{{$organization?->region?->name}}</td>
                                </tr>
                                <tr>
                                    <th>Район</th>
                                    <td>{{$organization?->district?->name}}</td>
                                </tr>
                                <tr>
                                    <th>Адрес</th>
                                    <td>{{$organization?->address}}</td>
                                </tr>
                                <tr>
                                    <th>ИНН</th>
                                    <td>{{$organization?->inn}}</td>
                                </tr>
                                <tr>
                                    <th>Создано</th>
                                    <td>{{$organization->created_at}} - {{$organization->creator?->name}}</td>
                                </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="d-flex">
                        <a href="{{route('specialist.organizations.edit',['organization' => $organization])}}" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-pen"></i>
                            Редактировать
                        </a>
                        <form action="{{route('specialist.organizations.destroy',['organization' => $organization])}}"
                              method="POST" class="mx-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-warning">
                                @if(!$organization->deleted_at)
                                    <i class="fa fa-eye-slash"></i> Деактивировать
                                @else
                                    <i class="fa fa-eye"></i> Активировать
                                @endif
                            </button>
                        </form>
                        </div>
{{--                        @include('specialist.organizations.partials.show.destroy-organization-modal')--}}
                    </div>
                </div>

                <div class="card w-100 my-1">
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            @include('specialist.organizations.partials.show.contacts-accordion-item')
                            @include('specialist.organizations.partials.show.farms-accordion-item')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
