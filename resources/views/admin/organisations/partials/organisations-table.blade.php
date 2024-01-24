<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Организация</th>
            <th>Всего ферм</th>
            <th>Создано</th>
            <th>Удалено</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($organisations as $organisation)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$organisation->name}}</td>
                <td>{{$organisation?->farms?->count()}}</td>

                <td>{{$organisation?->created_at}}</td>
                <td>{{$organisation?->deleted_at}}</td>
                <td>
                    <div class="d-flex justify-content-evenly">

                        <div class="py-1">
                            @include('admin.organisations.partials.delete-modal')
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
