@extends('layouts.app')

@section('content')
<div style="width: 100%; height: 100%;">
    <div class="row justify-content-center align-items-center" style="height: 100%;">
            <div class="panel rounded">
                <h3>Авторизация</h3>

                <div class="panel-body">
                    <form class="form-horizontal needs-validation" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="bmd-label-floating">Эл. Почта</label>

                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                <div class="invalid-feedback show">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="bmd-label-floating">Пароль</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback show">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Запомнить меня
                                    </label>
                        </div>

                        <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Войти
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
</div>
@endsection
