<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Название</th>
            <th>Принадлежит форме</th>
            <th>Е.и.</th>
            <th>Тип</th>
            <th>Вычисляемое</th>
            <th>Категория</th>
            <th>Порядковый номер</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($form_fields as $field)
            <tr class="">
                <td>{{$field?->id}}</td>
                <td>{{$field?->name}}</td>
                <td>{{$field?->form?->name}}
                    @if(!$field?->form?->deleted_at)
                        <a href="{{route('admin.forms.show',['form'=>$field?->form?->id])}}">(id: {{$field?->form?->id}})</a>
                    @else
                        <a href="{{route('admin.forms.show',['form'=>$field?->form?->id])}}">(id: {{$field?->form?->id}})</a>
                        <span class="text-muted"> форма не активна</span>
                    @endif
                </td>
                <td>{{$field?->unit}}</td>
                <td>{{$field?->type}}</td>
                <td>{{$field?->class === 'computed' ? 'Да' : 'Нет'}}</td>
                <td>{{$field?->category?->name}}</td>
                <td>{{$field?->number ?? 'не задан'}}</td>
                <td>
                    <div class="d-flex">
                        <div>
                            <a href="{{route('admin.form-fields.edit',['form_field' => $field])}}"
                               class="btn btn-outline-primary">
                                <i class="fa fa-pen"></i>
                            </a>
                        </div>

                        <form action="{{route('admin.form-fields.destroy',['form_field' => $field->id])}}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-warning mx-1">
                                <nobr>
                                <i class="fa {{$field->deleted_at ? 'fa-eye    ' : 'fa-eye-slash'}}"></i>
                                {{$field->deleted_at ? 'Активировать': 'Деактивировать'}}
                                </nobr>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
