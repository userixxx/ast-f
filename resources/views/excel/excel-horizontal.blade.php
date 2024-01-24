<table class="vertical-table">
    <thead>
    <tr>
        <td>Дата</td>
        @foreach($formFields as $formField)
            <td>{{$formField->name}}</td>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($reports as $report)
        <tr>
            <th class="text-dark align-top">
                <div class="d-flex flex-column align-items-start">
                    <span class="text-primary">{{$report->date}}</span>
                </div>
            </th>
            @foreach($formFields as $formField)
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
    </tbody>

</table>
