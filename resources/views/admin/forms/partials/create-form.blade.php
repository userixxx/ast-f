<div class="mb-3">
    <label for="name" class="form-label">Название</label>
    <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" required>
    <div id="nameHelp" class="form-text">Название формы сделайте уникальным</div>
</div>
<div class="mb-3">
    <label for="categoryId" class="form-label">Категория</label>
    <select class="form-select" aria-label="Default select example" id="categoryId" name="category_id" aria-describedby="categoryIdHelp" required>
        @foreach($formCategories as $formCategory)
            <option value="{{$formCategory->id}}">{{$formCategory->name}}</option>
        @endforeach
    </select>
    <div id="categoryIdHelp" class="form-text">Категория формы</div>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Описание</label>
    <input type="text" class="form-control" id="description" name="description" aria-describedby="descriptionHelp">
    <div id="descriptionHelp" class="form-text">Описание сделайте коротким и ясным</div>
</div>
