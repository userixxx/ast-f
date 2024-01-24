<div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseFarms" aria-expanded="true"
                aria-controls="collapseFarms">
            Фермы
        </button>
    </h2>
    <div id="collapseFarms" class="accordion-collapse collapse hide"
         aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body p-0">
            @foreach($organization->farms as $farm)
                <div class="p-2 mb-2 bg-secondary    bg-opacity-10">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th scope="row" class="col-2">Имя</th>
                            <td><a href="{{route('specialist.farms.show', ['farm' => $farm->id])}}">{{$farm->name}}</a></td>
                        </tr>
                        <tr>
                            <th scope="row">Регион</th>
                            <td>{{$farm?->region?->name}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Район</th>
                            <td>{{$farm?->district?->name}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Адрес</th>
                            <td>{{$farm->address}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Контакт</th>
                            <td>{{$farm->contact_name}}: {{$farm->contact_value}} ({{$farm->contact_job_title}})</td>
                        </tr>
                        </tbody>
                    </table>
                    <a href="{{route('specialist.farms.edit', ['farm' => $farm])}}"> <i class="fa-solid fa-file-signature"></i> Изменить</a>
                    @include('specialist.farms.partials.destroy-modal')
                </div>
            @endforeach

            @include('specialist.organizations.partials.show.farm-create-offcanvas')

        </div>
    </div>
</div>
