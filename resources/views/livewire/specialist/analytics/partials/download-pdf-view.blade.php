<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.cdnfonts.com/css/dejavu-sans" rel="stylesheet">

    <title>Document</title>
    <style>
        body {
            font-size: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .vertical-table {
            border-collapse: collapse;
        }

        .vertical-table td, .vertical-table th {
            border: 1px solid black;
        }

        .vertical-table td {
            width: 100px
        }

        * {
            /*font-family: Helvetica, sans-serif;*/
            font-family: 'DejaVu Sans', sans-serif;
        }

        .apexcharts-legend {
            display: flex;
            overflow: auto;
            padding: 0 10px;
        }
        .apexcharts-legend.apx-legend-position-bottom, .apexcharts-legend.apx-legend-position-top {
            flex-wrap: wrap
        }
        .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
            flex-direction: column;
            /*bottom: 0;*/
        }
        .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left, .apexcharts-legend.apx-legend-position-top.apexcharts-align-left, .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
            justify-content: flex-start;
        }
        .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center, .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
            justify-content: center;
        }
        .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right, .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
            /*justify-content: flex-end;*/
        }
        .apexcharts-legend-series {
            cursor: pointer;
            line-height: normal;
        }
        .apexcharts-legend.apx-legend-position-bottom .apexcharts-legend-series, .apexcharts-legend.apx-legend-position-top .apexcharts-legend-series{
            display: flex;
            align-items: center;
        }
        .apexcharts-legend-text {
            position: relative;
            font-size: 14px;
        }
        .apexcharts-legend-text *, .apexcharts-legend-marker * {
            pointer-events: none;
        }
        .apexcharts-legend-marker {
            position: relative;
            display: inline-block;
            cursor: pointer;
            margin-right: 3px;
            border-style: solid;
        }

        .apexcharts-legend.apexcharts-align-right .apexcharts-legend-series, .apexcharts-legend.apexcharts-align-left .apexcharts-legend-series{
            display: inline-block;
        }
        .apexcharts-legend-series.apexcharts-no-click {
            cursor: auto;
        }
        .apexcharts-legend .apexcharts-hidden-zero-series, .apexcharts-legend .apexcharts-hidden-null-series {
            /*display: none !important;*/
        }
        .apexcharts-inactive-legend {
            opacity: 0.45;
        }
    </style>
</head>
<body>
<table class="table table-dark" style="border-bottom:2px solid black;">
    <tbody>
    <tr class="">
        <td>АгроСтар-Трейд+</td>
        <td style="width:100%"></td>
        <td style="white-space: nowrap">Консультант-технолог: {{auth()->user()->surname}} {{auth()->user()->name}}</td>
    </tr>
    <tr class="">
        <td style="white-space: nowrap">тел: 8 800 600-90-55</td>
        <td style="width:100%"></td>
        <td>тел: {{auth()->user()->phone}}</td>
    </tr>
    <tr class="">
        <td style="padding-bottom: 10px;">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/ast-pdf.png'))) }}"
                 width="100px" height="100px"/>
        </td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>
<p style="width:100%">
    {{$farm?->region?->name}} - {{$farm?->organization?->name}} -{{$farm?->name}} <span
        style="position: absolute; right:0">{{date("Y-m-d")}}</span>
</p>
<hr>
<div style="position: relative;page-break-after: always;">
    @include('livewire.specialist.analytics.partials.pdf-excel-horizontal')
{{--    @include('livewire.specialist.analytics.partials.download-pdf-view')--}}
</div>
<div style="position: relative;">

    <img src="{{$file}}" style="width:100%; object-fit: contain"/>
    @foreach($legend as $item)
        <span style="vertical-align: center"><span style="display:inline-block;height:15px; width:15px; background-color: {{$item->bgColor}}; border-radius:50%"></span>{{$item->text}}</span>
        @endforeach
</div>


</body>
</html>

{{--<img src="data:image/svg+xml;base64,'.base64_encode({{$svg}}).'"  width="100" height="100" />--}}
