@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">You are logged in!</p>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
<link rel="stylesheet" href="https://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.css">
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery.min.js'></script>
<script src="http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js"></script>
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>
<script>

    var clientes = JSON.parse('{!! $clientes !!}');
    var eventos = [];

    $.map(clientes, function(item, index){
        eventos.push({
            title : item.nome,
            start: item.updated_at,
            url: 'admin/clientes/' + item.id
        });
    });
    
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            editable: true,
            eventLimit: true,
            events: eventos
        });
    });
</script>
@stop