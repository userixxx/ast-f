<div class="col-lg-6">
    <div class="mb-3">
        <label for="name" class="form-label fw-bolder">Имя</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$user?->name}}">
        <div id="nameHelp" class="form-text"></div>
    </div>

    <div class="mb-3">
        <label for="surname" class="form-label fw-bolder">Фамилия</label>
        <input type="text" class="form-control" id="surname" name="surname" value="{{$user?->surname}}">
        <div id="surnameHelp" class="form-text"></div>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label fw-bolder">Телефон</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{$user?->phone}}">
        <div id="phoneHelp" class="form-text"></div>
    </div>

    <div class="mb-3">
        <label for="job_title" class="form-label fw-bolder">Должность</label>
        <input type="text" class="form-control" id="job_title" name="job_title" value="{{$user?->job_title}}">
        <div id="jobTitleHelp" class="form-text"></div>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label fw-bold">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
               value="{{$user?->email}}">
        <div id="emailHelp" class="form-text"></div>
    </div>

    {{--<div class="mb-3">--}}
    {{--    <label for="exampleInputPassword1" class="form-label">Password</label>--}}
    {{--    <input type="password" class="form-control" id="exampleInputPassword1">--}}
    {{--</div>--}}
    <div class="mb-3">
        <label class="form-label fw-bolder">Активен</label>
        <div class="form-check">
            <input type='hidden' value='1' name='deleted_at'>
            <input type="checkbox" class="form-check-input" id="deleted_at" name="deleted_at" value="0" {{$user->deleted_at ? '' : 'checked'}}>
            <label class="form-check-label" for="deleted_at">{{$user->deleted_at ? 'Не активен' : 'Активен'}}</label>
        </div>
    </div>

    <div class="mb-3">
        <label for="roles" class="form-label fw-bolder">Роли</label>
        @foreach($roles as $role)
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="role_{{$role->id}}" name="roles[]"
                       value="{{$role->name}}" {{$user?->hasRole($role->name) ? 'checked' : ''}}>
                <label class="form-check-label" for="role_{{$role->id}}">{{$role->name}}</label>
            </div>
        @endforeach

    </div>

    <button type="submit" class="btn btn-primary">Обновить</button>
</div>
