<div>
    <form method="POST" action="{{route('general.contacts.update', ['contact' => $contact])}}">
        @csrf
        @method('PATCH')
        <input type="hidden" name="contactable_type" value="{{$contactableType}}">
        <input type="hidden" name="contactable_id" value="{{$contactableId}}">
        <div class="col-lg-6 col-sm-12">
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Имя<span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name"
                           value="{{old('name') ?? $contact->name}}"
                           placeholder="Игорь" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Отчество</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="patronymic" name="patronymic"
                           value="{{old('patronymic') ?? $contact->patronymic}}"
                           placeholder="Петрович">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Фамилия</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="surname" name="surname"
                           value="{{old('surname') ?? $contact->surname}}"
                           placeholder="Ермолаев" >
                </div>
            </div>

            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label"><nobr>Должность*</nobr></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="job_title" name="job_title"
                           value="{{old('job_title') ?? $contact->job_title}}"
                           placeholder="Директор">
                </div>
            </div>


            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email"
                           value="{{old('email') ?? $contact->email}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Мобильный</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="mobile" name="mobile"
                           value="{{old('mobile') ?? $contact->mobile}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Основной</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone" name="phone"
                           value="{{old('phone') ?? $contact->phone}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Рабочий</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="work_number" name="work_number"
                           value="{{old('work_number') ?? $contact->work_number}}">
                </div>
            </div>

            <button class="btn btn-outline-primary" type="submit">Сохранить</button>
        </div>
    </form>
</div>
