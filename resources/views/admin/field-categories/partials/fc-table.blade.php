<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Название</th>
            {{--            <th>Управление</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($field_categories as $field_category)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <a href="{{route('admin.field-categories.edit',['field_category' => $field_category->id])}}">
                    {{$field_category->name}}
                    </a>
                </td>
                {{--                <td>--}}
                {{--                    <div class="d-flex justify-content-start">--}}
                {{--                        <div class="p-1">--}}
                {{--                            <form action="{{route('admin.units.destroy',['unit' => $field_category->id])}}"--}}
                {{--                                  method="POST">--}}
                {{--                                @csrf--}}
                {{--                                @method('DELETE')--}}
                {{--                                <button type="submit" class="btn btn-danger">--}}
                {{--                                    Удалить--}}
                {{--                                </button>--}}
                {{--                            </form>--}}

                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
