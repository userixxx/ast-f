<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;

class TestController extends Controller
{
    public function index()
    {

        $pdf = Pdf::loadView('test.index', ['$data',"asas"]);
        return $pdf->download('invoice.pdf');
        return view('test.index');
    }
}
