@extends('layouts.app')


@section('titulo')
      Error 500
@endsection

@section('content')
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
            .details {
                font-size: 32px;
                margin-bottom: 40px;
            }
        </style>

        <div class="container">
            <div class="content">
                <div class="title">500</div>
                <div class="details">No se encontro el sitio que esta buscando.</div>
            </div>
        </div>
@endsection