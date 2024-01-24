@extends('layouts.specialist')

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3"><span class="text-black-50 d-none d-sm-inline d-lg-inline d-md-inline">Ферма</span> {{$farm->name}}</h3>
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
                        <form action="{{route('specialist.farms.update',['farm' => $farm])}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="organization_id" value="{{$farm->organization_id}}">
                            <div class="mb-3">
                                <label for="name" class="form-label">Название</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Ферма 2" value="{{$farm->name}}">
                            </div>

                            <livewire:specialist.farm.create.select-region-and-district :farm="$farm"/>

                            <div class="mb-3">
                                <label for="address" class="form-label">Адрес</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Казань, Фермское шоссе, д4" value="{{$farm->address}}">
                            </div>
                            <div class="mb-3">
                                <label for="contact_name" class="form-label">ФИО</label>
                                <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Медведев Д.А." value="{{$farm->contact_name}}">
                            </div>
                            <div class="mb-3">
                                <label for="contact_job_title" class="form-label">Должность</label>
                                <input type="text" class="form-control" id="contact_job_title" name="contact_job_title" placeholder="Помощник" value="{{$farm->contact_job_title}}">
                            </div>
                            <div class="mb-3">
                                <label for="contact_value" class="form-label">Контакт</label>
                                <input type="text" class="form-control" id="contact_value" name="contact_value" placeholder="+790123456789" value="{{$farm->contact_value}}">
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

