@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
            @else
            <!-- Logo -->
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                </a>
            @endif
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                        
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                          <!-- Menu Toggle Button -->
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            @if(Auth::user()->file)
                                <img src="{{ asset(Auth::user()->file) }}" class="img-circle" alt="User Image" width="17" height="17">
                            @else
                                <img src="{{url('imagedefeult/userdefault.png')}}" class="user-image" alt="User Image" >
                            @endif
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->username }}</span>
                          </a>
                          <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                            @if(Auth::user()->file)
                                <img src="{{  asset(Auth::user()->file) }}" class="img-circle" alt="User Image">
                            @else
                                <img src="{{url('imagedefeult/userdefault.png')}}" class="user-image" alt="User Image">
                            @endif

                              <p>
                                {{ Auth::user()->name }} 
                              </p>
                              <p>
                                {{ Auth::user()->perfil->perfil }} 
  
                              </p>

                            </li>

                            <!-- Menu Body -->
                            <li class="user-body">
                              
                              <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                              <div class="pull-left">
                                <a href="{{ route('showSetting', Auth::user()->id) }}" class="btn btn-default btn-flat">Ajustes</a>
                              </div>
                              <div class="pull-right">
                                <a href=""  class="btn btn-default btn-flat" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Cerrar Sesión
                                </a>
                                 <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                    @if(config('adminlte.logout_method'))
                                        {{ method_field(config('adminlte.logout_method')) }}
                                    @endif
                                    {{ csrf_field() }}
                                </form>
                                
                              </div>
                            </li>
                          </ul>
                        </li>

                    </ul>

                </div>
                @if(config('adminlte.layout') == 'top-nav')
                </div>
                @endif
            </nav>
        </header>


        @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree" id ="menutemp">
                    @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
        @endif


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
            <div class="container">
            @endif

            <!-- Content Header (Page header) -->
            <section class="content-header animated fadeIn">
                @yield('content_header')
            </section>

            <!-- confirm-delete -->

            @yield('include_delete')

            
            <!-- Main content -->

            <section class="content animated fadeIn">


            @if(session('danger'))
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="alert alert-danger">
                                {{ session('danger')}}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(count($errors))
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            
                @yield('content')

                <div class="go-up"><i class="glyphicon glyphicon-arrow-up"></i></div>

            </section>
            <!-- /.content -->
            @if(config('adminlte.layout') == 'top-nav')
            </div>
            <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->
         <footer class="main-footer">
            <div class="pull-right hidden-xs">
              <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2019 
          </footer>
    </div>
    <!-- ./wrapper -->


@stop



@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script type="text/javascript">

        $('.Modelo_Contratos').text('Modelo Contratos');
        /*$('.Remitos_Internos').text('Remitos Internos');
        $('.Manual_de_usuario').text('Manual de Usuario');*/


        $('div.alert').not('.alert-important').delay(3000).fadeOut(350) 

        $('input[type="checkbox"], input[type="radio"]').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        })

        $('.go-up').click(function(){
            $('body, html').animate({
                scrollTop: '0px'
            }, 300);
        });
     
        $(window).scroll(function(){
            if( $(this).scrollTop() > 0 ){
                $('.go-up').slideDown(300);
            } else {
                $('.go-up').slideUp(300);
            }
        });

        //desactivar click derecho y f12
        /*
        $(function(){
            $(document).bind("contextmenu",function(e){
                return false;
            });
        });

        $(document).keydown(function (event) {
            if (event.keyCode == 123) { // Prevent F12
                return false;
            } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
                return false;
            }
        });*/
        
        var user = {!! json_encode((array)auth()->user()->id) !!};
       
        var APP_URL = "{{ url('/') }}";

        $.ajax({
        url: APP_URL + '/habilitarmodulos/' + user,
        
        //url: "/habilitarmodulos/" + user
        }).done(function(resultado) {
            console.log(resultado);
            //alert(resultado);
            
            if (resultado == 0) {
                
                $("#menutemp").hide();
            } else {


                for(var i = 0; i < resultado.length; i++){
                    

                    if(resultado[i]['permiso'] == 0){

                        //$('#' + resultado[i]['descripcion']).hide();

                        if(resultado[i]['descripcion'] == 'Modelo Contratos')
                        {
                            $('#Modelo_Contratos').hide();
                        /*}if(resultado[i]['descripcion'] == 'Remitos Internos')
                        {
                            $('#Remitos_Internos').hide();

                        }if(resultado[i]['descripcion'] == 'Manual de usuario')
                        {
                            $('#Manual_de_usuario').hide();*/

                        }else  {
                            $('#' + resultado[i]['descripcion']).hide();
                        }
                        
                    }
                }
            }
            //alert(resultado);

        
        });
    </script>

    @stack('js')
    @yield('js')
@stop
