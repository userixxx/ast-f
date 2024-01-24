<div class="mb-3">
    <label for="name" class="form-label">Имя</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Анатолий" value="{{old('name') ?? $user->name}}" autocomplete="name" required>
</div>

<div class="mb-3">
    <label for="surname" class="form-label">Фамилия</label>
    <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname"  name="surname" placeholder="Витгенштейн" value="{{old('surname') ?? $user->surname}}" autocomplete="surname" required>
</div>

<div class="mb-3">
    <label for="phone" class="form-label">Телефон</label>
    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"  name="phone" placeholder="+79012345678" value="{{old('phone') ?? $user->phone}}" autocomplete="phone" required pattern="^\+79[0-9]{9}$">
</div>

<div class="mb-3">
    <label for="job_title" class="form-label">Должность</label>
    <input type="text" class="form-control @error('job_title') is-invalid @enderror" id="job_title"  name="job_title" placeholder="Директор" value="{{old('job_title') ?? $user->job_title}}" autocomplete="job_title" required>
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"  name="email" placeholder="trueemail@domain.ru" value="{{old('email') ?? $user->email}}" autocomplete="email" required>
    @error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<button type="submit" class="btn btn-primary">Сохранить</button>
