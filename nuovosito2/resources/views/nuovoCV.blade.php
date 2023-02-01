<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Laravel 9 CRUD LIST</title>
        <!-- Theme style  -->
        <script src="{{asset('js/bootstrap.bundle.js')}}" rel="stylesheet" ></script>
        <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <!-- Fonts  -------->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@800&display=swap" rel="stylesheet">
    </head>
<body>
    {{-- Header ----------------------------------------}}
    <div id="idHeader" class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="size5rem nav-link active" aria-current="page" href="/content0">Home</a>
                            <a class="size5rem nav-link" href="/content1">About me</a> {{-- href si aggancia alla route in routes --}}
                            <a class="size5rem nav-link" href="/content4">Messaggi</a>
                            <a class="size5rem nav-link" href="/content3">Skills</a>
                            <a class="size5rem nav-link" href="/sendMail">Mail</a>
                            <a class="size5rem nav-link" href="{{ route('logout') }}">Logout</a>
                            <a class="size5rem nav-link" href="{{ route('generatepdf') }}">DownloadCurriculumPDF</a>
                            <a class="size5rem nav-link" href="{{ route('generatepdf2') }}">VisualizzaCurriculumPDF</a>
                            <a class="size5rem nav-link" href="{{ route('generatepdf3') }}">VisualizzaQueryPDFMessaggi</a>
                        </div>
                    </div>
                    <span class="size5rem color210493">Benvenuto {{ session('userLoggato') }}</span>
                </nav>
            </div>
        </div>
    </div>
    {{-- Content ---------------------------------------}}
    <div id="idContent" class="container">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @yield('content1')
        @yield('content2')
        @yield('content3')
        @yield('content4')
        @yield('content5')
        @yield('content6')
        @yield('messages')
        @yield('sendMail')
        @yield('sendMailMessage')
    </div>
    {{-- Footer ----------------------------------------}}
    <div id="idFooter" class="container">
        @include('partials.piede')
    </div>
</body>
</html>
