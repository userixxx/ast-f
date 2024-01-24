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
            <h3 class="h3">Редактирование профиля</h3>

        </div>
        <div class="row">
            <div class="col">
                <form action="{{route('general.profiles.update',['profile' => $user])}}" method="POST">
                    @csrf
                    @method('PATCH')
                    @include('general.profiles.partials.edit-form')
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col">
            </div>
        </div>


    </div>
@endsection
