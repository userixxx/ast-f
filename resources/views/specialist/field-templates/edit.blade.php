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
                @if (session()->get('msg'))
                        <div class="alert alert-success" role="alert">
                            {{session()->get('msg')}}
                        </div>
                @endif
            </div>
        </div>
        <div class="row">
            <h3 class="h3">Редактирование шаблона - {{$fields_template->name}}</h3>
        </div>
        <div class="row">
            <div class="col">
                <form action="{{route('specialist.field-templates.update',['field_template' => $fields_template])}}"
                      method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="name" class="form-label">Название</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp"
                               value="{{old('name') ?? $fields_template->name}}">
                        @error('name')
                        <div id="nameHelp" class="form-text">We'll never share your email with anyone else.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="d-flex flex-wrap">
                            @foreach($fields as $field)
                                <div class="form-check m-2 px-4 border border-secondary border-1 rounded-1">
                                    <input class="form-check-input" type="checkbox" id="field_{{$field->id}}"
                                           name="fields[]" value="{{$field->id}}" {{in_array($field->id, $fields_template->fields) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="disabledFieldsetCheck">
                                        {{$field->name}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('name')
                        <div id="nameHelp" class="form-text">We'll never share your email with anyone else.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Обновить</button>
                        <a href="{{route('specialist.field-templates.index')}}" class="btn btn-secondary">Отменить</a>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
