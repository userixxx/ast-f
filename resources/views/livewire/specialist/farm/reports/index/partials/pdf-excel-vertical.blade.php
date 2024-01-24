<table class="vertical-table">
    <thead>
    <tr>
        <td>ID</td>
        @foreach($reports->sortBy('id') as $report)
            <td>{{$loop->iteration}}</td>
        @endforeach

    </tr>
    @foreach($formFields as $formField)
        <tr>
            <th class="text-dark align-top">
                <div class="d-flex flex-column align-items-start">
                    <span class="text-primary">{{$formField->category->name}}</span>
                    <p>{{$formField->name}}</p>
                </div>
            </th>
            @foreach($reports->sortBy('id') as $report)
                <td>
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
                                err
                            @endif
                        @endisset
                    @endif
                </td>
            @endforeach
        </tr>
    @endforeach
    <tr>
        <td>Дата</td>
        @foreach($reports->sortBy('id') as $report)
            <td>
                {{$report->date}}</td>
        @endforeach

    </tr>
    </thead>

</table>
