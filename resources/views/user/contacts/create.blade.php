@extends('layouts.specialist')

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3"><span class="text-black-50">Новый контакт</span></h3>
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
            <div class="col-6">
                <div class="card w-100 my-1" >
                    <div class="card-body">
                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Название</h6>
                            <h5 class="card-title"></h5>
                        </div>
                    </div>
                </div>


            </div>
        </div>


    </div>
@endsection
