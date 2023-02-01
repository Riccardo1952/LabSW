<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messaggi;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SitoController extends Controller
{
    public function index(){

        $messaggis = Messaggi::orderBy('id','desc')->paginate(5);
        return view('contents.content4', compact('messaggis'));
    }
    public function show0() {
        return view('contents/content0');
    }
    public function show1() {
        return view('contents/content1');
    }
    public function show3() {
        return view('contents/content3');
    }
    public function show4() {
        $messaggis = Messaggi::where('user_id', '=', session('idLoggato'))->orderBy('id', 'desc')->paginate(5);
        return view('contents/content4', compact('messaggis'));
    }
    public function sendMail() {
        return view('contents/sendMail');
    }
    public function create(){
        return view('contents.content5');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'messaggio' => 'required',

        ]);
        $formFields['user_id'] = session('idLoggato');
        Messaggi::create($formFields);
        return redirect()->route('messaggis.index')->with('success','Nota creata con successo.');
    }
    public function edit(Messaggi $messaggi)
    {
        return view('contents.content6',compact('messaggi'));
    }
    public function update(Request $request, Messaggi $messaggi)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'messaggio' => 'required'
        ]);
        $messaggi->fill($request->post())->save();
        return redirect()->route('show4')->with('success','Messaggio aggiornato con successo');
    }
    public function destroy(Messaggi $messaggi)
    {
        $messaggi->delete();
        return redirect()->route('show4')->with('success','Messaggio cancellato con successo');
    }
    public function emailSend(Request $request)
    {
        $data = $request->all();
        $to = $data['email'];
        $subject = $data['subject'];
        $message = $data['message'];
        $from = session('emailLoggato');

        Mail::raw($message, function ($message) use ($to, $subject, $from) {
            $message->from($from)
                    ->to($to)
                    ->subject($subject);
        });
        return view('contents/sendMailMessage');
    }
}
