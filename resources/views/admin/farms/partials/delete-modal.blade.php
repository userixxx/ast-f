<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteFarmModal{{$farm->id}}">
    <nobr>
        <i class="fa fa-trash"></i> Удалить</nobr>
</button>

<!-- Modal -->
<div class="modal fade" id="deleteFarmModal{{$farm->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Удаление</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Ферма и связанные отчёты будут навсегда удалены!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <form action="{{route('admin.farms.destroy',['farm' => $farm?->id])}}"
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
