<!DOCTYPE html>
<html>
<head>
  <title>Laravel 9 Generate PDF</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-12" style="margin-top: 15px ">
        <div class="pull-left">
          <h2>{{$title}}</h2>
          <h4>{{$date}}</h4>
        </div>
      </div>
    </div><br>
    <table class="table table-bordered">
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Messaggio</th>
      </tr>
      @foreach ($messaggi as $messaggio)
      <tr>
        <td>{{ $messaggio->nome }}</td>
        <td>{{ $messaggio->email }}</td>
        <td>{{ $messaggio->messaggio }}</td>
      </tr>
      @endforeach
    </table>
  </div>
</body>
</html>
