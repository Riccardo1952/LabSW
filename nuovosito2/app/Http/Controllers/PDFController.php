<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messaggi;
use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
        $pdf = PDF::loadView('myPDF', $data);
        return $pdf->download('CVRiccardoRibuttini.pdf');
    }
    public function generatePDF2()
    {
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
        $pdf = PDF::loadView('myPDF', $data);
        return $pdf->stream('CVRiccardoRibuttini.pdf');
    }
    public function generatePDF3()
    {
        $messaggi = Messaggi::get();
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'messaggi' => $messaggi
        ];
        $pdf = PDF::loadView('myPDF2', $data);
        return $pdf->stream('CVRiccardoRibuttini.pdf');
    }
}
