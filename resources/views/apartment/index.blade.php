@extends('layouts.app')

@section('content')
<ul class="nav nav-tabs bg-dark">
  <li class="nav-item">
    <a class="nav-link active" href="#">Все</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Готовы к сдаче</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Не завершенные</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#">Сданы</a>
  </li>
  <li class="nav-item">
      <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
  </li>
</ul>
<a href="{{ route('logout') }}"
    onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
    Logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>

    <table class="table table-bordered">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>

@endsection
