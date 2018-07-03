<!-- Nav header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Larapp</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/">Все</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Сданы</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="#">Смонтированые</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Не завершенные</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Не смонтированые</a>
      </li>
    </ul>
    <form class="form-inline my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Найти.." aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Поиск</button>
    </form>
    <button type="button" class="btn btn-primary my-2 my-lg-0" onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">Выйти</button>
  </div>
  <!-- Logout form -->
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
  </form>
  <!-- Logout form -->
</nav>
<!-- Nav header -->
