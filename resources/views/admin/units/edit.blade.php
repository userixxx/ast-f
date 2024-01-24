@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3">Новая единица</h3>
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

                    @if(session()->has('msg'))
                        <div class="alert alert-success">
                            {{ session()->get('msg') }}
                        </div>
                    @endif

                <form action="{{route('admin.units.update', ['unit'=>$unit] )}}" method="POST">
                    @csrf
                    @METHOD('PATCH')
                    <div class="col-lg-6">

                        <div class="mb-3">
                            <label for="name" class="form-label">Название</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" required value="{{$unit->name}}">
                            <div id="nameHelp" class="form-text">Название единицы сделайте уникальным</div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Описание</label>
                            <input type="text" class="form-control" id="description" name="description" aria-describedby="descriptionHelp" required value="{{$unit->description}}">
                            <div id="descriptionHelp" class="form-text">Описание единицы сделайте уникальным</div>
                        </div>
                        <a href={{route('admin.units.index')}} type="submit" class="btn btn-secondary">Назад</a>
                        <button type="submit" class="btn btn-primary">Обновить</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
