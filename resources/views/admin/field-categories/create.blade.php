@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3">Новая категория поля</h3>
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

                <form action="{{route('admin.field-categories.store')}}" method="POST">
                    @csrf
                    <div class="col-lg-6">

                        <div class="mb-3">
                            <label for="name" class="form-label">Название</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" required>
                            <div id="nameHelp" class="form-text">Название сделайте уникальным</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Создать</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
