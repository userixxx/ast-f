<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#destroyOrganization">
    @if(request()->route()->getActionMethod() == 'show')
        <i class="fa fa-trash"></i> Удалить
    @elseif(request()->route()->getActionMethod() == 'index')
        <i class="fa fa-trash"></i>
    @endif
</button>

<!-- Modal -->
<div class="modal fade" id="destroyOrganization" tabindex="-1" aria-labelledby="destroyOrganizationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('specialist.organizations.destroy', ['organization' => $organization])}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Удаление фермы</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Организация {{$organization->name}} будет <span class="text-danger">Полностью</span> удалена!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="fa fa-trash text-danger"></i> Удалить</button>
                </div>
            </form>
        </div>
    </div>
</div>
