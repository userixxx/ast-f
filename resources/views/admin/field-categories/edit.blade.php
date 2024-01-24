@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3">Редактирование категории поля</h3>
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
                @if(Session::has('successMsg'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('successMsg') }}
                    </div>
                @endif

                <form action="{{route('admin.field-categories.update', ['field_category' => $field_category])}}"
                      method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="col-lg-6">

                        <div class="mb-3">
                            <label for="name" class="form-label">Название</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp"
                                   required value="{{old('name') ?? $field_category->name}}">
                            <div id="nameHelp" class="form-text">Название сделайте уникальным</div>
                        </div>
                        <a href="{{route('admin.field-categories.index')}}" type="submit" class="btn btn-secondary">Назад</a>
                        <button type="submit" class="btn btn-primary">Обновить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
