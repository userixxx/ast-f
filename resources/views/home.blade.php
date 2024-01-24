@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        @endif
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header ">
                        <div class="d-flex">
                            @if (Auth::check())
                                Welcome {{ Auth::user()->name }}
                                <br>{{ Auth::user()->email }}
                            @else
                                Please login to access your account
                            @endif

                        </div>
                        <div class="d-flex justify-content-between">
                            {{ __('auth.Dashboard') }}
                            <span class="text-muted small">{{ __('auth.You are logged in!') }}</span>
                        </div>


                    </div>

                    <div class="card-body">
                        <div class="d-flex flex-column align-content-start">

                        @if(auth()->user()->hasRole('admin'))
                            <a class="btn btn-light" href="{{route('admin.users.index')}}">Пользователи</a>
                                <a class="btn btn-light" href="{{route('admin.units.index')}}">Единицы измерения</a>
                                <a class="btn btn-light" href="{{route('admin.field-categories.index')}}">Категории</a>
                                <a class="btn btn-light" href="{{route('admin.form-fields.index')}}">Поля</a>
                                <a class="btn btn-light" href="{{route('admin.forms.index')}}">Формы</a>
                                <a class="btn btn-light" href="{{route('admin.organisations.index')}}">Организации</a>
                                <a class="btn btn-light" href="{{route('admin.farms.index')}}">Фермы</a>
                                <a class="btn btn-light" href="{{route('admin.reports.index')}}">Отчёты</a>
{{--                                <a class="btn btn-light" href="{{route('admin.computed-form-fields.index')}}">Вычисляемые поля</a>--}}
                        @elseif(auth()->user()->hasRole('specialist'))
                                <a class="btn btn-light" href="{{route('specialist.organizations.index')}}">Все организации</a>
                                <a class="btn btn-light" href="{{route('specialist.farms.index')}}">Все фермы</a>
                                <a class="btn btn-light" href="{{route('specialist.reports.index')}}">Все отчёты</a>
                                <a class="btn btn-light" href="{{route('specialist.field-templates.index')}}">Шаблоны полей</a>
                                <a class="btn btn-light" href="{{route('specialist.analytics.index')}}">Аналитика</a>
                            @else
                                <p class="p">Дождитесь, пока администратор одобрит вашу заявку</p>

                            @endif
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
