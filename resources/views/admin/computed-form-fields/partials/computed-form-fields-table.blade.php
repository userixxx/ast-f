<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Название</th>
            <th>Принадлежит форме</th>
            <th>Е.и.</th>
            <th>Тип</th>
            <th>Категория</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($fields as $field)
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
                <td>{{$field?->category?->name}}</td>
                <td>
                    <div class="d-flex">
                        <div>
                            <a href="{{route('admin.computed-form-fields.edit',['computed_form_field' => $field])}}"
                               class="btn btn-outline-primary">
                                <i class="fa fa-pen"></i>
                            </a>
                        </div>

                        <form action="{{route('admin.computed-form-fields.destroy',['computed_form_field' => $field->id])}}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger mx-1">
                                <i class="fa {{$field->deleted_at ? 'fa-trash-restore    ' : 'fa-trash'}}"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
                <p class="p">Нет полей</p>
            @endforelse
        </tbody>
    </table>
</div>
