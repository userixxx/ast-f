<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>№</th>
            <th>Название</th>
            <th>Форма</th>
            <th>Коллекция</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($field_templates as $fieldTemplate)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    {{$fieldTemplate?->name}}
                </td>
                <td style="width:10%">
                    {{$fieldTemplate?->form->name}}
                </td>
                <td style="width:90%">
                    <p>
                        <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFieldTemplate{{$fieldTemplate?->id}}" aria-expanded="false" aria-controls="collapseExample">
                            Показать/Закрыть
                        </button>
                    </p>
                    <div class="collapse" id="collapseFieldTemplate{{$fieldTemplate?->id}}">
                        <div class="card card-body">
                            {{$fieldTemplate?->fieldsCollection}}                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex justify-content-evenly">
                        <div class="py-1">
                            <a href="{{route('specialist.field-templates.edit',['field_template' => $fieldTemplate?->id])}}"
                               class="btn btn-outline-info mx-1">
                                <i class="fa fa-pen"></i>
                            </a>
                        </div>
                        <div class="py-1">
                            <form
                                action="{{route('specialist.field-templates.destroy',['field_template' => $fieldTemplate?->id])}}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="deleted_at"
                                       value="{{$fieldTemplate?->deleted_at ? 0 : 1}}">
                                <button type="submit" class="btn btn-warning">
                                    <nobr>
                                    <i class="fa {{$fieldTemplate?->deleted_at ? 'fa-eye' : 'fa-eye-slash'}}"></i>
                                        {{$fieldTemplate?->deleted_at ? 'Активировать    ' : 'Деактивировать'}}
                                    </nobr>
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
