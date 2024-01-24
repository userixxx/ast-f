<div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#templateModal">
    Сохранить коллекцию полей в шаблон
</button>

<!-- Modal -->
<div class="modal fade" id="templateModal" tabindex="-1" aria-labelledby="templateModalLabel" aria-hidden="true"  wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="templateModalLabel">Сохранить коллекцию полей в шаблон</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{$resultMessage}}</p>
                <div class="mb-3">
                    <label for="name" class="form-label">Название</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Разгар - молоко" wire:model="templateName">
                </div>
                Всего полей: {{$this->checkedFieldsCollection?->count()}} <br>
                @foreach($this->checkedFieldsCollection?->sortBy('category') as $item)
                    <span><b>{{$item->name}}</b>({{$item->category->name}})</span>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
                <button type="button" class="btn btn-primary" wire:click="saveTemplate">Сохранить</button>
            </div>
        </div>
    </div>
</div>
</div>
