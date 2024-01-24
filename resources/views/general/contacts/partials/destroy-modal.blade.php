<!-- Button trigger modal -->
<button type="button" class="btn btn-link text-danger" data-bs-toggle="modal" data-bs-target="#contactDelete_{{$contact->id}}">
    <i class="fa fa-trash text-danger"></i> Удалить
</button>

<!-- Modal -->
<div class="modal fade" id="contactDelete_{{$contact->id}}" tabindex="-1" aria-labelledby="contactDelete_{{$contact->id}}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('general.contacts.destroy', ['contact' => $contact])}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Удаление контакта</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Контакт {{$contact->name}} будет удалён
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
