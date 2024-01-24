<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admin.users.*') ? ' border-start border-5 border-primary active' : ''}} " href="{{route('admin.users.index')}}" >
                    <i class="fa-solid fa-user-group"></i>
                    Пользователи
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admin.units.*') ? ' border-start border-5 border-primary active' : ''}} " href="{{route('admin.units.index')}}" >
                    <i class="fa-solid fa-list"></i>
                    Единицы измерения
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admin.field-categories.*') ? ' border-start border-5 border-primary active' : ''}} " href="{{route('admin.field-categories.index')}}" >
                    <i class="fa-solid fa-clone"></i>
                    Категории
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admin.form-fields.*') ? ' border-start border-5 border-primary active' : ''}}" href="{{route('admin.form-fields.index')}}" >
                    <i class="fa-solid fa-align-justify"></i>
                    Поля
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admin.forms.*') ? ' border-start border-5 border-primary active' : ''}} " aria-current="page" href="{{route('admin.forms.index')}}">
                    <i class="fa-solid fa-book-journal-whills"></i>
                    Формы
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admin.organisations.*') ? ' border-start border-5 border-primary active' : ''}} " href="{{route('admin.organisations.index')}}" >
                    <i class="fas fa-building"></i>
                    Организации
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admin.farms.*') ? ' border-start border-5 border-primary active' : ''}} " href="{{route('admin.farms.index')}}" >
                    <i class="fa-solid fa-tent"></i>
                    Фермы
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admin.reports.*') ? ' border-start border-5 border-primary active' : ''}} " href="{{route('admin.reports.index')}}" >
                    <i class="fa-solid fa-file-excel"></i>
                    Отчёты
                </a>
            </li>
        </ul>


    </div>
</nav>
