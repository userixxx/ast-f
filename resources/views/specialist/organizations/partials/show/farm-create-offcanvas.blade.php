<button class="btn btn-outline-primary m-2" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
    <i class="fa-solid fa-file-signature"></i>
    Добавить ферму
</button>

<div class="offcanvas offcanvas-bottom h-auto" tabindex="-1" id="offcanvasBottom"
     aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <h5 class="offcanvas-title" id="offcanvasBottomLabel">Добавить новую ферму к {{$organization->name}}</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="container mb-5 overflow-auto scroll">
        <div class="offcanvas-body small">
            <form action="{{route('specialist.farms.store')}}" method="POST">
                @csrf
                <input type="hidden" name="organization_id" value="{{$organization->id}}">
                <div class="mb-3">
                    <label for="name" class="form-label">Название</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Ферма 2">
                </div>
                <livewire:specialist.farm.create.select-region-and-district/>
                <div class="mb-3">
                    <label for="address" class="form-label">Адрес</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Казань, Фермское шоссе, д4">
                </div>
                <div class="mb-3">
                    <label for="contact_name" class="form-label">ФИО</label>
                    <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Медведев Д.А.">
                </div>
                <div class="mb-3">
                    <label for="contact_job_title" class="form-label">Должность</label>
                    <input type="text" class="form-control" id="contact_job_title" name="contact_job_title" placeholder="Помощник">
                </div>
                <div class="mb-3">
                    <label for="contact_value" class="form-label">Контакт</label>
                    <input type="text" class="form-control" id="contact_value" name="contact_value" placeholder="+790123456789">
                </div>
                <button type="submit" class="btn btn-outline-primary">Сохранить</button>
            </form>
        </div>
    </div>
</div>
