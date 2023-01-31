@extends('nuovoCV')
@section('content4')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Elenco messaggi di {{ session('userLoggato') }}</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('messaggis.create') }}"> Crea Messaggio</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width:5%">Nr</th>
                            <th style="width:5%">Name</th>
                            <th style="width:15%">Email</th>
                            <th style="width:62%">Messaggio</th>
                            <th style="width:13%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messaggis as $messaggio)
                            <tr>
                                <td>{{ $messaggio->id }}</td>
                                <td>{{ $messaggio->nome }}</td>
                                <td>{{ $messaggio->email }}</td>
                                <td>{{ $messaggio->messaggio }}</td>
                                <td>
                                    <form action="{{ route('messaggis.destroy',$messaggio->id) }}" method="Post">
                                        <a class="btn btn-primary" href="{{ route('messaggis.edit',$messaggio->id) }}">Edt</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Del</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
                {!! $messaggis
                ->withQueryString()->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
@endsection
