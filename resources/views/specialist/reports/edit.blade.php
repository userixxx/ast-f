@extends('layouts.specialist')

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3">Редактировать отчёт ID {{$report->id}}</h3>
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

                @include('specialist.reports.partials.edit.edit-reports-form')

            </div>
        </div>

    </div>
@endsection
