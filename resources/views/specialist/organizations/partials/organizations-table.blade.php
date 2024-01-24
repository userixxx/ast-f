<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>№</th>
            <th>Наименование</th>
            <th>ИНН</th>
            <th>Регион</th>
            <th>Район</th>
            <th>Адрес</th>
            <th>Контакт</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($organizations as $organization)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <a href="{{route('specialist.organizations.show',['organization' => $organization->id])}}">{{$organization?->name}}</a>
                </td>
                <td>{{$organization?->inn}}</td>
                <td>{{$organization?->region?->name}}</td>
                <td>{{$organization?->district?->name}}</td>
                <td>{{$organization?->address}}</td>
                <td>{{$organization?->contacts?->first()?->phone ?? $organization?->contacts?->first()?->mobile ?? $organization?->contacts?->first()?->work_number}} <br> {{$organization?->contacts?->first()?->name}} {{$organization?->contacts?->first()?->surname}}</td>
                <td>
                    <div class="d-flex justify-content-evenly">
                        <div class="py-1">
                            <a href="{{route('specialist.organizations.edit',['organization' => $organization?->id])}}"
                               class="btn btn-outline-info">
                                <i class="fa fa-pen"></i>
                            </a>
                        </div>
                        <div class="py-1 ps-1">
                            <form action="{{route('specialist.organizations.destroy',['organization' => $organization?->id])}}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="deleted_at"
                                       value="{{$organization?->deleted_at ? 0 : 1}}">
                                <button type="submit" class="btn btn-warning">
                                    <nobr>
                                    <i class="fa {{$organization?->deleted_at ? 'fa-eye' : 'fa-eye-slash'}}"></i>
                                    {{$organization?->deleted_at ? 'Активировать' : 'Деактивировать'}}
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
