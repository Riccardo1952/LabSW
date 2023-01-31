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

        // Mail::send(['text'=>'email'], ['name' => $message], function($message) use($to, $subject, $from){
        //     $message->to($to)->subject($subject);
        //     $message->from($from);
        // });
        Mail::raw($message, function ($message) use ($to, $subject, $from) {
            $message->from($from)
                    ->to($to)
                    ->subject($subject)
                    ->attach('prova.pdf');
        });
        return view('contents/sendMailMessage');
    }
    public function SendCV(Request $request){
        $mail = new PHPMailer(true);
        try {
            $to = session('emailLoggato');
            $subject = "Curriculum Riccardo Ributtini";
            $txt = "Le invio il mio curriculum che mi ha gentilmente richiesto." . "\r\n";
            $headers = "From: riccardoributtini@gmail.com" . "\r\n";
            $mail = new PHPMailer;
        /*     Nel codice che ho fornito, la proprietà "SMTPDebug" è impostata su 0, il che significa
               che non verranno visualizzati messaggi di debug. Se si desidera visualizzare i messaggi di debug, è possibile
               impostare il valore di "SMTPDebug" su 1 o 2.
               Impostando "SMTPDebug" su 1, verranno visualizzati solo i messaggi di errore.
               Impostando "SMTPDebug" su 2, verranno visualizzati sia i messaggi di errore che quelli di informazione. */
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.sendgrid.net';
            $mail->SMTPAuth = true;
            $mail->Username = 'apikey';
            $mail->Password = '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';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            $mail->setFrom('riccardoributtini@gmail.com', 'riccardo ributtini');
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $txt;
            $mail->addAttachment('prova.pdf');
            $mail->send();
            return view('contents/sendCVMessage');
        } catch (Exception $e) {
            return view('contents/sendCVMessageErr');
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
