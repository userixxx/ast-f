<button class="btn btn-outline-primary m-2" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasContactCreate" aria-controls="offcanvasContactCreate">
    <i class="fa-solid fa-file-signature"></i>
    Добавить контакт
</button>
<div class="offcanvas offcanvas-bottom h-auto " tabindex="-1" id="offcanvasContactCreate"
     aria-labelledby="offcanvasContactCreateLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <h5 class="offcanvas-title" id="offcanvasContactCreateLabel">Добавить новый контакт к {{$organization->name}}</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="container">
        <div class="offcanvas-body small">
                @include('user.contacts.partials.create-contact-form')
        </div>
    </div>
</div>
