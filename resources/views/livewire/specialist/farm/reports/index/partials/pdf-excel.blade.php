<table class="table table-striped">
    <thead>
    <tr>
        <th>№</th>
        @foreach($formFields as $formField)
            <th class="text-dark align-top">
                <div class="d-flex flex-column align-items-start">
                    <span class="text-primary">{{$formField->category->name}}</span>
                    <p>{{$formField->name}}</p>
                </div>
            </th>
        @endforeach
        <th>Дата</th>
        <th>Податель</th>
        <th>Создано</th>
        <th>-</th>
    </tr>
    </thead>
    <tbody>
    @foreach($reports as $report)
        <tr>
            <td>{{$loop->iteration}}</td>

            @foreach($formFields as $formField)
                <td >
                    @if($formField->class === 'computed')
                        @if(isset($report->data))
                            {{\App\Services\Specialist\FormFieldService::compute($formField,$report) ?? '-'}}
                        @endif
                    @else
                        @isset($report?->data["field_$formField?->id"])
                            @if($formField->type != 'checkbox' && !is_array($report->data["field_$formField->id"]))
                                {{$report->data["field_$formField->id"] ?? '-'}}
                            @elseif($formField->type == 'checkbox' && is_array($report->data["field_$formField->id"]))
                                {{implode(',', $report->data["field_$formField->id"] ?? '-')}}
                            @else
                                __exp
                            @endif
                        @endisset
                    @endif
                </td>
            @endforeach
            <td>{{$report?->date}}</td>
            <td>{{$report?->creator->fullName}}</td>

            <td>{{$report?->created_at}}</td>
            <td>
                -
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
