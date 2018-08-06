<!-- Nav header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Larapp</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="#" @click="search = null">Все</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" @click="search = {target: 'status', query: 3}">Сданы</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" @click="search = {target: 'status', query: 2}">Смонтированые</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" @click="search = {target: 'status', query: 1}">Не завершенные</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" @click="search = {target: 'status', query: 0}">Не смонтированые</a>
      </li>
    </ul>
      <search :list="apartments" v-model="search"></search>
<!--
    <form class="form-inline my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Найти.." aria-label="Search" v-model="inputSearch">
      <button class="btn btn-success my-2 my-sm-0" type="submit" @click.prevent="searchAll()">Поиск</button>
    </form>
-->
    <button type="button" class="btn btn-primary my-2 my-lg-0" onclick="event.preventDefault();
             document.getElementById('logout-form').submit();"> @{{ user.name }}, Выйти</button>
  </div>
  <!-- Logout form -->
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
  </form>
  <!-- Logout form -->
</nav>
<!-- Nav header -->
