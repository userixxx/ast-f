<form action="{{route('specialist.organizations.update', ['organization' => $organization])}}" method="POST">
    @csrf
    @method('PATCH')
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="name" class="form-label fw-bolder">Название</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name') ?? $organization?->name}}" required>
            <div id="nameHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>

        <livewire:specialist.organizations.edit.select-region-and-district :organization="$organization"/>

        <div class="mb-3">
            <label for="inn" class="form-label fw-bolder">ИНН</label>
            <input type="text" class="form-control" id="inn" name="inn" value="{{old('inn') ?? $organization?->inn}}" required>
            <div id="innHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label fw-bolder">Адрес</label>
            <input type="text" class="form-control" id="address" name="address" value="{{old('address') ?? $organization?->address }}" required>
            <div id="addressHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bolder">Активен</label>
            <div class="form-check">
                <input type='hidden' value='1' name='deleted_at'>
                <input type="checkbox" class="form-check-input" id="deleted_at" name="deleted_at" value="0" {{$organization?->deleted_at ? '' : 'checked'}}>
                <label class="form-check-label" for="deleted_at">{{$organization?->deleted_at ? 'Не активен' : 'Активен'}}</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Обновить</button>
    </div>
</form>
