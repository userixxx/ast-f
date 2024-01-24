<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ферма</th>
            <th>Организация</th>
            <th>Всего отчётов</th>
            <th>Создано</th>
            <th>Удалено</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($farms as $farm)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$farm->name}}</td>
                <td>{{$farm?->organization?->name}}</td>
                <td>{{$farm?->reports?->count()}}</td>

                <td>{{$farm?->created_at}}</td>
                <td>{{$farm?->deleted_at}}</td>
                <td>
                    <div class="d-flex justify-content-evenly">

                        <div class="py-1">
                            @include('admin.farms.partials.delete-modal')
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
