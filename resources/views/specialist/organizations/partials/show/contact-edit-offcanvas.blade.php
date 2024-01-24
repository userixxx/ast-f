<button class="btn btn-link" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasContactEdit_{{$id}}" aria-controls="offcanvasContactEdit_{{$id}}">
    <i class="fa-solid fa-file-signature"></i>
    Изменить
</button>
<div class="offcanvas offcanvas-bottom h-auto " tabindex="-1" id="offcanvasContactEdit_{{$id}}"
     aria-labelledby="offcanvasContactEdit_{{$id}}Label">
    <div class="offcanvas-header">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <h5 class="offcanvas-title" id="offcanvasContactEdit_{{$id}}Label">Редактировать контакт организации {{$organization->name}}</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="container">
        <div class="offcanvas-body small">
            @include('general.contacts.partials.edit-contact-form',['contactableType' => get_class($organization), 'contactableId'=>$organization->id])
        </div>
    </div>
</div>
