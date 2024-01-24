<div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseContacts" aria-expanded="true"
                aria-controls="collapseContacts">
            Контакты
        </button>
    </h2>
    <div id="collapseContacts" class="accordion-collapse collapse hide"
         aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body p-0">
            @foreach($organization->contacts as $contact)
                <div class="p-2 mb-2 bg-secondary bg-opacity-10">
                    <table class="table">
                        <tbody>
                        @if(isset($contact->name))
                        <tr>
                            <th scope="row" class="col-2">Имя</th>
                            <td>{{$contact->name}}</td>
                        </tr>
                        @endif
                        @if(isset($contact->job_position))
                        <tr>
                            <th scope="row">Должность</th>
                            <td>{{$contact->job_position}}</td>
                        </tr>
                        @endif
                        @if($contact->email)
                        <tr>
                            <th scope="row">Email:</th>
                            <td>{{$contact->email}}</td>
                        </tr>
                        @endif
                        @if($contact->phone)
                        <tr>
                            <th scope="row">Основной:</th>
                            <td>{{$contact->phone}}</td>
                        </tr>
                        @endif
                        @if($contact->mobile)
                        <tr>
                            <th scope="row">Мобильный:</th>
                            <td>{{$contact->mobile}}</td>
                        </tr>
                        @endif
                        @if($contact->work_number)
                        <tr>
                            <th scope="row">Рабочий</th>
                            <td>{{$contact->work_number}}</td>
                        </tr>
                            @endif
                        </tbody>
                    </table>
{{--                    @if($contact->name || $contact->surname || $contact->patronymic)--}}
{{--                        <h5 class="card-title"><span--}}
{{--                                class="card-subtitle text-muted">Имя: </span> {{$contact->name}}--}}
{{--                        </h5>--}}
{{--                    @endif--}}
{{--                    @if($contact->job_title)--}}
{{--                        <h5 class="card-title"><span class="card-subtitle text-muted">Должность: </span> {{$contact->job_title}}--}}
{{--                        </h5>--}}
{{--                    @endif--}}
{{--                    @if($contact->email)--}}
{{--                        <h5 class="card-title"><span class="card-subtitle text-muted">Email: </span> {{$contact->email}}--}}
{{--                        </h5>--}}
{{--                    @endif--}}
{{--                    @if($contact->phone)--}}
{{--                        <h5 class="card-title"><span class="card-subtitle text-muted">Основной: </span> {{$contact->phone}}--}}
{{--                        </h5>--}}
{{--                    @endif--}}
{{--                    @if($contact->mobile)--}}
{{--                        <h5 class="card-title"><span class="card-subtitle text-muted">Мобильный: </span> {{$contact->mobile}}--}}
{{--                        </h5>--}}
{{--                    @endif--}}
{{--                    @if($contact->work_number)--}}
{{--                        <h5 class="card-title"><span class="card-subtitle text-muted">Рабочий: </span> {{$contact->work_number}}--}}
{{--                        </h5>--}}
{{--                    @endif--}}

                    @include('specialist.organizations.partials.show.contact-edit-offcanvas',['id' => $contact->id])
                    @include('general.contacts.partials.destroy-modal',['id' => $contact->id])
                </div>
            @endforeach
                @include('specialist.organizations.partials.show.contacts-create-offcanvas')
        </div>
    </div>
</div>
