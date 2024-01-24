<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>№</th>
            <th>Форма</th>
            <th>Ферма</th>
            <th>Отчёты фермы</th>
            <th>Организация</th>
            <th>Податель</th>
            <th>Данные</th>
            <th>Дата</th>
            <th>Создано</th>
            <th>Удалено</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reports as $report)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <a href="{{route('specialist.forms.show',['form' => $report?->form?->id])}}">{{$report?->form?->name}}</a>
                </td>
                <td>
                    <a href="{{route('specialist.farms.show',['farm' => $report?->farm?->id])}}">{{$report?->farm?->name}}</a>
                </td>
                <td>
                    <a href="{{route('specialist.farms.reports.index',['farm' => $report?->farm?->id])}}">Отчёты фермы</a>
                </td>
                <td>
                    <a href="{{route('specialist.organizations.show',['organization' => $report?->organization?->id])}}">{{$report?->organization?->name}}</a>
                </td>
                <td>{{$report?->creator->fullName}}</td>
                <td><a href="{{route('specialist.reports.show', ['report' => $report])}}">Данные</a></td>
                <td>{{$report?->date}}</td>
                <td>{{$report?->created_at}}</td>
                <td>{{$report?->deleted_at}}</td>
                <td>
                    <div class="d-flex justify-content-evenly">

                        <div class="py-1">
                            <form action="{{route('admin.reports.destroy',['report' => $report?->id])}}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <nobr>
                                        <i class="fa fa-trash"></i> Удалить</nobr>
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
