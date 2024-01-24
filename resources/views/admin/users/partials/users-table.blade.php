<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Телефон</th>
            <th>Email</th>
            <th>Должность</th>
            <th>Роли</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->surname}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->job_title}}</td>
                <td>{{$user->getRoleNames()->join(',')}}</td>
                <td>
                    <div class="d-flex justify-content-start">
                        <div class="py-1">
                            <a href="{{route('admin.users.edit',['user' => $user->id])}}"
                               class="btn btn-outline-info">
                                <i class="fa fa-pen"></i>
                            </a>
                        </div>
                        <div class="p-1">
                            <form action="{{route('admin.users.update',['user' => $user->id])}}"
                                  method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="deleted_at"
                                       value="{{$user->deleted_at ? 0 : 1}}">
                                <button type="submit" class="btn btn-warning">
                                <nobr>
                                    <i class="fa {{$user->deleted_at ? 'fa-eye    ' : 'fa-eye-slash'}}"></i>
                                    {{$user->deleted_at ? 'Активировать    ' : 'Декактивировать'}}
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
