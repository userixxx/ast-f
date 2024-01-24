<div class="table responsible">
    <table class="table">
        <thead>
        <tr>
            <th>Id поля</th>
            <th>Название поля</th>
            <th>Значение</th>
            <th>Единица</th>
        </tr>
        </thead>
        <tbody class="tbody">
        @foreach($formFields as $field)
            <tr>
                <td>{{$field->id}}</td>
                <td>{{$field->name}}</td>
                <td >
                    @if($field->class !== 'computed')
                    @if($field->type == 'checkbox')
                        {{implode(',',($report->data)["field_".$field->id] ?? []) }}

                    @else
                        {{($report->data)["field_".$field->id] ?? ''}}
                    @endif
                    @else
                    <span @if(App\Services\Specialist\FormFieldService::compute($field, $report) === "/0") class="fw-bold text-danger" @endif}}>
                        {{ App\Services\Specialist\FormFieldService::compute($field, $report) }}
                    </span>
                    @endif
                </td>
                <td>{{$field->unit}}</td>
            </tr>
        @endforeach
        <tr>
            <th>Файлы</th>
            <td></td>
            <td>
                @foreach($report->getMedia('reports') as $item)
                    <p class="bordered border-bottom border-primary">
                    <a href="{{$item->getFullUrl()}}" class="btn btn-link">
                        <i class="fa fa-eye" aria-hidden="true"></i> {{$item->file_name}}
                    </a>
                    <br>
                    <a download href="{{$item->getFullUrl()}}" class="btn btn-link">
                        <i class="fa fa-download" aria-hidden="true"></i>
                        {{$item->file_name}}
                    </a>
                        <button type="button" class="btn btn-link text-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                            <i class="fa fa-trash" aria-hidden="true"></i> Удалить
                        </button>

                        <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Удаление файла</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Файл будет безвозвратно удалён!
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить
                                    </button>
                                    <form action="{{route('specialist.reports.delete-file', ['file'=>$item->id])}}" method="POST">
                                        @csrf()
                                        @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    </p>
                @endforeach
            </td>
        </tr>
        </tbody>
    </table>
</div>
