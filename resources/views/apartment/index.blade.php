@extends('layouts.app')

@section('content')

@include('layouts.header')

<!-- Content -->
<!-- <table class="table table-bordered table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Подъезд</th>
      <th scope="col">Этаж</th>
      <th scope="col">Владельцы</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>2</td>
      <td>1</td>
      <td>3</td>
    </tr>
    <tr class="table-success">
      <th scope="row">52</th>
      <td>3</td>
      <td>2</td>
      <td>
          <span>Name Surname Familia</span>
          <a href="tel:+380668536081">+380668536081</a>
      </td>
    </tr>
    <tr class="table-primary">
      <th scope="row">34</th>
      <td>3</td>
      <td>3</td>
      <td>
          <div class="dropdown">
              <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Показать</a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <div class="dropdown-item">
                      <div class="owner-item">
                          <span>Name Surname Familia</span>
                          <a href="tel:+380668536081">+380668536081</a>
                      </div>
                  </div>
                  <div class="dropdown-item">
                      <div class="owner-item">
                          <span>Name Surname Familia</span>
                          <a href="tel:+380668536081">+380668536081</a>
                      </div>
                  </div>
              </div>
          </div>
      </td>

    </tr>
    <tr class="table-warning">
      <th scope="row">34</th>
      <td>3</td>
      <td>3</td>
      <td>
          <div class="dropdown">
              <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Показать</a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <div class="dropdown-item">
                      <div class="owner-item">
                          <span>Name Surname Familia</span>
                          <a href="tel:+380668536081">+380668536081</a>
                      </div>
                  </div>
                  <div class="dropdown-item">
                      <div class="owner-item">
                          <span>Name Surname Familia</span>
                          <a href="tel:+380668536081">+380668536081</a>
                      </div>
                  </div>
              </div>
          </div>
      </td>

    </tr>
  </tbody>
</table> -->
<!-- Content -->

<button type="button" class="btn btn-primary bmd-btn-fab position-fixed" data-toggle="modal" data-target="#exampleModalCenter" style="right: 20px; bottom: 20px;">
  <i class="material-icons">add</i>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Добавление объекта</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="/" type="POST">
              <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">Квартира</span>
                  </div>
                  <input required type="number" class="form-control" aria-label="# Квартиры" aria-describedby="inputGroup-sizing-sm">
              </div>

              <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">Этаж</span>
                  </div>
                  <input required type="number" class="form-control" aria-label="# Квартиры" aria-describedby="inputGroup-sizing-sm">
              </div>

              <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">Подъезд</span>
                  </div>
                  <input required type="number" class="form-control" aria-label="# Квартиры" aria-describedby="inputGroup-sizing-sm">
              </div>

              <span class="input-group-text" id="inputGroup-sizing-sm">Владельцы</span>
              <ul class="list-group">
                  <li class="list-group-item">
                      <div class="owner-item">
                          <span>Name Surname Familia</span>
                          <a href="tel:+380668536081">+380668536081</a>
                          <button type="button" class="btn btn-primary bmd-btn-icon">
                  <i class="material-icons">remove</i>
                </button>
                      </div>
                  </li>
                  <li class="list-group-item">
                      <div class="owner-item">
                          <span style="line-height: 35px;">Name Surname Familia</span>
                          <a href="tel:+380668536081" style="line-height: 35px;">+380668536081</a>
                          <button type="button" class="btn btn-danger bmd-btn-icon">
                  <i class="material-icons">remove</i>
                      </div>
                  </li>
              </ul>

              <button type="button" class="btn btn-success bmd-btn-icon">
                  <i class="material-icons">add</i>
              </button>
              <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">Комплект</span>
                  </div>
                  <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
              </div>
              <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">Заметка</span>
                  </div>
                  <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
              </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary">Сохранить</button>
      </div>
    </div>
  </div>
</div>
<apartments-list :list="list">
@endsection
