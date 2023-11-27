@extends('layouts.main')

@section('title','DashBoard')

@section('content')
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Eventos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-title-container">
    @if(count($events)>0)
        <p>Meus eventos </p>
    @else
        <p>Sem nenhum evento, <a href="/events/create">criar evento</a></p>
    @endif
</div>

@endsection('content')
