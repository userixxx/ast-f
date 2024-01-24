<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteorganisationModal{{$organisation->id}}">
    <nobr>
        <i class="fa fa-trash"></i> Удалить</nobr>
</button>

<!-- Modal -->
<div class="modal fade" id="deleteorganisationModal{{$organisation->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Удаление</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Организация, связанные фермы и отчёты будут навсегда удалены!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <form action="{{route('admin.organisations.destroy',['organisation' => $organisation?->id])}}"
                      method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <nobr>
                            <i class="fa fa-trash"></i> Удалить</nobr>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
