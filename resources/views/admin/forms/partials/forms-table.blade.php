<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Название</th>
            <th>Создатель</th>
            <th>Категория</th>
            <th>Описание</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($forms as $form)
            <tr>
                <td>{{$form->id}}</td>
                <td>
                    <a href="{{route('admin.forms.show',['form' => $form->id])}}">
                        {{$form->name}}
                    </a>
                </td>
                <td>{{$form->creator?->name ?? '-'}}</td>
                <td>{{$form->category->name}}</td>
                <td>{{$form->description}}</td>
                <td>
                    <div class="d-flex justify-content-start">
                        <div class="py-1">
                            <a href="{{route('admin.forms.edit',['form' => $form->id])}}"
                               class="btn btn-outline-info">
                                <i class="fa fa-pen"></i>
                            </a>
                        </div>
                        <div class="p-1">
                            <form action="{{route('admin.forms.destroy',['form' => $form->id])}}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-warning">
                                        <nobr>
                                        <i class="fa {{$form->deleted_at ? 'fa-eye' : 'fa-eye-slash'}}"></i>
                                        {{$form->deleted_at ? 'Активировать' : 'Деактивировать'}}
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
