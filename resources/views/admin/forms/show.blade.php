@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3"><span class="text-black-50 d-none d-sm-inline d-lg-inline d-md-inline">Форма</span> {{$form->name}}</h3>
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
                <div class="card w-100 my-1">
                    <div class="card-body">

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Категория</h6>
                            <h5 class="card-title">{{$form?->category?->name}}</h5>
                        </div>

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Описание</h6>
                            <h5 class="card-title">{{$form?->description}}</h5>
                        </div>


                        <p class="card-text text-muted">
                            Создано: {{$form->created_at}} - {{$form->creator?->name}}
                        </p>

                        <div class="d-flex">
                        <a href="{{route('admin.forms.edit',['form' => $form])}}" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-pen"></i>
                            Редактировать
                        </a>

                        <form action="{{route('admin.forms.destroy',['form' => $form->id])}}" method="POST" class="mx-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                @if(!$form->deleted_at)
                                <i class="fa fa-trash"></i> Деактивировать
                                @else
                                    <i class="fa fa-trash-restore"></i> Восстановить
                                @endif
                            </button>
                        </form>
                        </div>
                    </div>
                </div>

                <div class="card w-100 my-1">
                    <div class="card-body">
                        <div class="accordion" id="accordionFormFields">
                            @include('admin.forms.partials.show.form-fields-accordion-item')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
