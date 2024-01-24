<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>№</th>
            <th>Наименование фермы</th>
            <th>Наименование организации</th>
            <th>Регион</th>
            <th>Район</th>
            <th>Адрес</th>
            <th>Контакт</th>
            <th>Всего отчётов</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($farms as $farm)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <a href="{{route('specialist.farms.show',['farm' => $farm->id])}}">{{$farm?->name}}</a>
                </td>
                <td>
                    <a href="{{route('specialist.organizations.show',['organization' => $farm?->organization_id])}}">
                        {{$farm?->organization->name}}
                    </a>
                </td>
                <td>{{$farm?->region?->name}}</td>
                <td>{{$farm?->district?->name}}</td>
                <td>{{$farm?->address}}</td>
                <td>{{$farm?->contact_value}} {{$farm?->contact_name}}</td>
                <td>{{$farm?->reports->count()}}</td>
                <td>
                        <div class="d-flex justify-content-evenly">
                        <div class="py-1">
                            <a href="{{route('specialist.farms.edit',['farm' => $farm?->id])}}"
                               class="btn btn-outline-info">
                                <i class="fa fa-pen"></i>
                            </a>
                        </div>
                        <div class="py-1 ps-1">
                            <form action="{{route('specialist.farms.destroy',['farm' => $farm?->id])}}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="deleted_at"
                                       value="{{$farm?->deleted_at ? 0 : 1}}">
                                <button type="submit" class="btn btn-warning">
                                    <nobr>
                                    <i class="fa {{$farm?->deleted_at ? 'fa-eye' : 'fa-eye-slash'}}"></i>
                                    {{$farm?->deleted_at ? 'Активировать' : 'Деактивировать'}}</nobr>
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
