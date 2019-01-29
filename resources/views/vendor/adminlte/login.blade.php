@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
    <style>
        body {overflow-y:hidden!important;}
    </style>
@stop

@section('body_class', 'login-page')

@section('body')
    <div class="login-box">
        <div class="form-group"  align="center">
            <img src="{!! asset('imagedefeult/navegador.jpeg') !!}" height="150" width="150" class="img-circle profile_img" alt="Computer Hope">
        </div>
        <div class="login-logo">
            <!--<a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>-->
            <h1>
                Ingresar al Sistema
            </h1>
        </div>
        <!-- /.login-logo -->
        
        <div class="login-box-body">
            <p class="login-box-msg">{{ trans('adminlte::adminlte.login_message') }}</p>
            <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
                {!! csrf_field() !!}


    

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input id="login" type="login" class="form-control" name="login" value="{{ old('login') }}"
                          required autofocus placeholder="Introduce tu E-Mail o Nombre de Usuario">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('login'))
                        <span class="help-block">
                            <strong>{{ $errors->first('login') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row" >
                    
                    <!-- /.col -->
                    <div  style="text-align: center"  >
                        <button type="submit"
                                class="btn btn btn-success"> <i class="fa fa-sign-in"></i>  {{ trans('adminlte::adminlte.sign_in') }} </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    @yield('js')
@stop
