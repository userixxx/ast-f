@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3"><span class="text-black-50 d-none d-sm-inline d-lg-inline d-md-inline">Форма </span> {{$form->name}}</h3>
        </div>
        <div class="row">
            <p>
                <a class="btn btn-outline-secondary btn-sm" href="{{route('admin.forms.index')}}">Все формы</a>
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
                <form action="{{route('admin.forms.update',['form' => $form])}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="name" class="form-label">Название</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" value="{{old('name') ?? $form->name}}" required>
{{--                        <div id="nameHelp" class="form-text">We'll never share your email with anyone else.</div>--}}
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Описание</label>
                        <input type="text" class="form-control" id="description" name="description" aria-describedby="descriptionHelp" value="{{old('description') ?? $form->description}}" >
{{--                        <div id="descriptionHelp" class="form-text">We'll never share your email with anyone else.</div>--}}
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Категория формы</label>
                        <select class="form-select mb-3" aria-label=".form-select example" name="category_id" id="category_id">
                            @foreach($form_categories as $category)
                                <option value="{{$category->id}}" {{(old('category_id') ?? $form->category->id) == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                            @endforeach
                        </select>
{{--                        <div id="field_category_idHelp" class="form-text">We'll never share your email with anyone else.</div>--}}
                    </div>

                    <button type="submit" class="btn btn-primary">Обновить</button>
                </form>

            </div>
        </div>
    </div>
@endsection
