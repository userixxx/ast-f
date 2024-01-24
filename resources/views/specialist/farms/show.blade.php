@extends('layouts.specialist')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8">
                <div class="d-flex justify-content-between">
                    <h3 class="h3"><span
                            class="text-black-50 d-none d-sm-inline d-lg-inline d-md-inline">Ферма</span> {{$farm->name}}
                    </h3>
                </div>

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
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8">
                <div class="card w-100 my-1">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-secondary">
                                <tbody>
                                <tr>
                                    <th>Организация</th>
                                    <td>
                                        <a href="{{route('specialist.organizations.show',['organization' =>$farm?->organization_id])}}">{{$farm?->organization?->name}}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Регион</th>
                                    <td>
                                        {{$farm?->region?->name}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Район</th>
                                    <td> {{$farm?->district?->name}} </td>
                                </tr>
                                <tr>
                                    <th>Адрес</th>
                                    <td> {{$farm?->address}} </td>
                                </tr>
                                <tr>
                                    <th>Имя контакта</th>
                                    <td> {{$farm?->contact_name}} </td>
                                </tr>
                                <tr>
                                    <th>Должность контакта</th>
                                    <td> {{$farm?->contact_job_title}} </td>
                                </tr>
                                <tr>
                                    <th>Значение контакта</th>
                                    <td> {{$farm?->contact_value}} </td>
                                </tr>
                                <tr>
                                    <th>Активен</th>
                                    <td> {{$farm?->deleted_at ? 'нет' : "да"}}</td>
                                </tr>
                                <tr>
                                    <th>Всего отчётов</th>
                                    <td>
                                        {{$farm?->reports?->count()}}
                                        <a href="{{$farm->deleted_at ? '' : route('specialist.farms.reports.index',['farm' => $farm])}}" class="{{$farm->deleted_at ? 'btn btn-link disabled' : 'btn btn-link disabled'}}">

                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <a href="{{route('specialist.farms.edit',['farm' => $farm])}}" class="btn btn-outline-primary m-1">Редактировать</a>
                    <form href="{{route('specialist.farms.destroy',['farm' => $farm])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-warning m-1">{{$farm->deleted_at ? 'Активировать' : 'Деактивировать'}}</button>
                    </form>

                    @if(!$farm->deleted_at)
                        <a class="btn btn-outline-secondary m-1" href="{{route('specialist.reports.create')}}">Подать отчёт</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

