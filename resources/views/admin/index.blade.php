@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="titulo-principal">Sistema de Inventario de la I.E.S. "Inca Garcilaso de la Vega"</h1>
    <div class="my-4"></div>

    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5><b>Bienvenido : </b>{{ Auth::user()->name }}</h5>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><b>Rol:
                                {{ Auth::user()->roles->pluck('name')->implode(',') }}</b></a></li>
                </ol>
            </div>
        </div>
    </div>
    <hr>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info">
                        <a href="{{ url('/admin/bienes') }}">
                            <img src="{{ url('/images/cajas.gif') }} " width="100%" alt="">
                        </a>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total de bienes</span>
                        <span class="info-box-number">{{ $total_bienes }} bienes</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info">
                        <a href="{{ url('/admin/bienes') }}">
                            <img src="{{ url('/images/tasa.gif') }} " width="100%" alt="">
                        </a>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total de bienes en buen estado</span>
                        <span class="info-box-number">{{ $total_estado_bueno }} bienes</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info">
                        <a href="{{ url('/admin/bienes') }}">
                            <img src="{{ url('/images/eficiencia.gif') }} " width="100%" alt="">
                        </a>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total de bienes en estado regular</span>
                        <span class="info-box-number">{{ $total_estado_regular }} bienes</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info">
                        <a href="{{ url('/admin/bajas') }}">
                            <img src="{{ url('/images/mala-resena.gif') }} " width="100%" alt="">
                        </a>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total de bienes en mal estado</span>
                        <span class="info-box-number">{{ $total_estado_malo }} bienes</span>
                    </div>
                </div>
            </div>



        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info">
                        <a href="{{ url('/admin/bienes') }}">
                            <img src="{{ url('/images/no-hay-datos.gif') }} " width="100%" alt="">
                        </a>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total de bienes no habidos</span>
                        <span class="info-box-number">{{ $total_estado_no_habido }} bienes</span>
                    </div>
                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Estado de Bienes</h3>
                    </div>

                    <div class="card-body">
                        <canvas id="estados" width="300" height="300"></canvas>
                    </div>

                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Estado de Bienes grafico pastel</h3>
                    </div>

                    <div class="card-body">
                        <canvas id="grafico_pie" width="300" height="300"></canvas>
                    </div>

                </div>
            </div>

        </div>


    </div>
@stop

@section('css')
    <style>
        .titulo-principal {
            text-align: center;
            font-weight: bold;
            color: #1460a8;
        }
    </style>
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>

    <script>
        const ctxBar = document.getElementById('estados').getContext('2d');
        const barChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Bueno', 'Regular', 'Malo', 'No habido'],
                datasets: [{
                    label: '# Bienes',
                    data: [
                        {{ $total_estado_bueno }},
                        {{ $total_estado_regular }},
                        {{ $total_estado_malo }},
                        {{ $total_estado_no_habido }}
                    ],
                    backgroundColor: [
                        'rgb(102, 205, 170)',
                        'rgb(255, 206, 86)',
                        'rgb(255, 99, 132)',
                        'rgb(0, 0, 0)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(0, 0, 0, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        const ctxPie = document.getElementById('grafico_pie').getContext('2d');
        const pieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Bueno', 'Regular', 'Malo', 'No habido'],
                datasets: [{
                    label: '# Bienes',
                    data: [
                        {{ $total_estado_bueno }},
                        {{ $total_estado_regular }},
                        {{ $total_estado_malo }},
                        {{ $total_estado_no_habido }}
                    ],
                    backgroundColor: [
                        'rgb(102, 205, 170)',
                        'rgb(255, 206, 86)',
                        'rgb(255, 99, 132)',
                        'rgb(0, 0, 0)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(0, 0, 0, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

@stop
