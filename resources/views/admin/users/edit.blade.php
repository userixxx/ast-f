@extends('layouts.admin')
@section('content')
    <div class="container py-4">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        @endif
        <div class="d-flex">
            <div class="pe-4">
            <a href="{{route('admin.users.index')}}" class="btn btn-outline-secondary btn-sm">
                <i class="fa fa-arrow-left"></i>
                Назад
            </a>
            </div>
            <h3 class="h3">Редактирование пользователя Id {{$user->id}}</h3>

        </div>
        <div class="row">
            <div class="col">
                <form action="{{route('admin.users.update',['user' => $user->id])}}" method="POST">
                @csrf
                    @method('PATCH')
                    @include('admin.users.partials.create-edit-form')
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col">
            </div>
        </div>


    </div>
@endsection
