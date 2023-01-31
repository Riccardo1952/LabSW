@extends('nuovoCV')
@section('content2')
<div id="idHeader" class="container">
    <div class="row justify-content-center pt-5 pb-5">
        <div class="col-md-7">
            <h1 class="display-4">Contact us</h1>
            <hr class="bg-success">
            <p class="pb-0 mb-0">Just get in contact with us. We are happy to answer your questions.</p>
            <p class="text-danger small pt-0 mt-0">* All fields are required</p>
            <form method="POST" action="{{ route('messages.store') }}">
                 @csrf
            <div class="row form-group">
                <label for="name" class="col-form-label col-md-4">Name</label>
                <div class="col-md-8">
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                </div>
            <div class="row form-group">
                <label for="email" class="col-form-label col-md-4">E-mail</label>
                <div class="col-md-8">
                    <input type="text" name="email" id="email" class="form-control" required>
                </div>
            </div>
            <div class="row form-group">
                <label for="options" class="col-form-label col-md-4">Subject</label>
                <div class="col-md-8">
                    <input type="text" name="Subject" id="Subject" class="form-control" required>
                </div>
            </div>
            <div class="row form-group">
                <label for="message" class="col-form-label col-md-4">Message</label>
                <div class="col-md-8">
                <textarea name="message" id="message" class="form-control" rows="3" required></textarea>
                </div>
            </div>
            <div class="d-flex justify-content-center pt-3 mt-3">
                <button type="submit" class="btn btn-success btn-block btn-send">Invio</button>
            </div>
            </form>
        </div>
    </div>
</div>
<p id="demo"></p>
@endsection

