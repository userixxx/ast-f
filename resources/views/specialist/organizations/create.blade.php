@extends('layouts.specialist')

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3">Новая организация</h3>
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

                <form action="{{route('specialist.organizations.store')}}" method="POST">
                    @csrf
                    @php($organization = null)
                    <div class="col-lg-6">

                        @include('specialist.organizations.partials.create-organization-form')
                        <button type="submit" class="btn btn-primary">Создать</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
