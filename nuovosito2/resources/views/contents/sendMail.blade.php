@extends('nuovoCV')
@section('sendMail')

<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <br><br><br><br>
            <form method="POST" action="{{ route('emailSend') }}">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Indirizzo email del destinatario:</font>
                        </font>
                    </label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="Email" required>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Oggetto:</font>
                        </font>
                    </label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="subject" placeholder="Oggetto" required>
                    @if ($errors->has('subject'))
                        <span class="text-danger">{{ $errors->first('subject') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Messaggio:</font>
                        </font>
                    </label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message" placeholder="Messaggio" required></textarea>
                    @if ($errors->has('message'))
                        <span class="text-danger">{{ $errors->first('message') }}</span>
                    @endif
                </div>
                <div class="d-flex justify-content-center pt-3 mt-3">
                    <button type="submit" class="btn btn-success btn-block btn-send">Invio</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
