@extends(auth()->user()->hasRole('admin') ? 'layouts.admin' : 'layouts.specialist')

@section('content')
    <div class="container py-4">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        @endif
        <div class="d-flex">
            <div class="pe-4">
                <a href="/home" class="btn btn-outline-secondary btn-sm">
                    <i class="fa fa-arrow-left"></i>
                    Назад
                </a>
            </div>
            <h3 class="h3">Страница редактирования Вашего профиля</h3>

        </div>
        <div class="row">
            <div class="col">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Имя:</td>
                        <td>{{$user->name}}</td>
                    </tr>
                    <tr>
                        <td>Фамилия:</td>
                        <td>{{$user->surname}}</td>
                    </tr>
                    <tr>
                        <td>Телефон:</td>
                        <td>{{$user->phone}}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                        <td>Должность:</td>
                        <td>{{$user->job_title}}</td>
                    </tr>
                    <tr>
                        <td>Создан:</td>
                        <td>{{$user->created_at}}</td>
                    </tr>
                    <tr>
                        <td>Обновлён:</td>
                        <td>{{$user->updated_at}}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a href="{{route('general.profiles.edit',['profile' => $user])}}" class="btn btn-primary">Редактировать</a>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col">
            </div>
        </div>


    </div>
@endsection
