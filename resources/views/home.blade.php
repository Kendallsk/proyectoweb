@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>CRUD - GAMER FEST</h1>
@stop

@section('content')
    
	<ul class="navbar-nav mr-auto">
						<!--Nav Bar Hooks - Do not delete!!-->
						<li class="nav-item">
                            <a href="{{ url('/empleados') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Empleados</a> 
                        </li>
                    </ul>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop