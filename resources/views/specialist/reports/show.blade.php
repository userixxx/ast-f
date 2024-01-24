@extends('layouts.specialist')

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3"><span
                    class="text-black-50 d-none d-sm-inline d-lg-inline d-md-inline">Отчёт</span> ID {{$report->id}} / {{$report->date}}
            </h3>
        </div>
        <div class="row">
            <p>
                <a class="btn btn-secondary" href="{{route('specialist.reports.index')}}">Ко всем отчётам</a>
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
            <div class="col">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
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
                                    <th>Огранизация</th>
                                    <td>
                                        <a href="{{route('specialist.organizations.show',['organization' => $report->organization])}}">
                                            {{$report->organization?->name}}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Регион и район организации</th>
                                    <td>
                                        {{$report->organization?->region?->name}}, {{$report->organization?->district?->name}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ферма</th>
                                    <td>
                                        <a href="{{route('specialist.farms.show',['farm' => $report->farm])}}">
                                            {{$report->farm?->name}}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Регион и район фермы</th>
                                    <td>
                                        {{$report->farm?->region?->name}}, {{$report->farm?->district?->name}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Дата отчёта</th>
                                    <td>
                                        {{$report->date}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Дата внесения</th>
                                    <td>
                                        {{$report->created_at}} / {{$report->updated_at}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Имя специалиста</th>
                                    <td>
                                        {{$report->creator?->fullName}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Форма</th>
                                    <td>
                                        {{$report->form?->name}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Данные</h6>
                            @include('specialist.reports.partials.report-data-table')
                        </div>

                        <div class="d-flex">
                            <div>

                            <a href="{{route('specialist.reports.edit',['report' => $report])}}"
                               class="btn btn-outline-secondary">
                                <i class="fa-solid fa-pen"></i>
                                Редактировать
                            </a>
                            </div>
                            <form action="{{route('specialist.reports.destroy',['report' => $report->id])}}"
                                  method="POST" class="mx-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning">
                                    @if(!$report->deleted_at)
                                        <i class="fa fa-eye-slash"></i> Деактивировать
                                    @else
                                        <i class="fa fa-eye"></i> Активировать
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
