@extends('layouts.specialist')

@section('content')
    <div class="container py-4">
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
            <h3 class="h3">Аналитика</h3>
        </div>
        <div class="row">
            <div class="col">
                <livewire:specialist.analytics.index/>
            </div>
        </div>



    </div>
@endsection
