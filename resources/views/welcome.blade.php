@extends('layouts.main')

@section('title', 'COTI Eventos')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Pesquisar um Evento</h1>
    <form action="/" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">
    </form>
</div>
<div id="events-container" class="col-md-12">
    @if ($search)
    <h2> Procurando por: {{$search}}</h2>
    @else
    <h2> Próximos Eventos </h2>
    <p class="subtitle"> Confira os próximos eventos</p>
    @endif
    <h2>Próximos Eventos</h2>
    <p class="subtitle">Veja todos os dos próximos dias</p>
    <div id="cards-container" class="row">
        @foreach($events as $event)
        <div class="card col-md-3">
            <img src="/img/events/{{$event->image}}" alt="{{ $event->titulo }}">
            <div class="card-body">
                <p class="card-date">{{date('d/m/y',strtotime($event->data))}}</p>
                <h5 class="card-title">{{ $event->titulo }}</h5>
                <p class="card-participants">{{count($event->users)}} Participantes</p>
                <a href="/events/{{$event->id}}" class="btn btn-primary">+ Informações</a>
            </div>
        </div>
        @endforeach
        </div>
        @if(count($events)==0 && $search)
            <p> Não foi encontrado nenhum evento com: {{$search}} | <a href="/"> Todos os eventos </a></p>
        @elseif(count($events)==0)
            <p> Nenhum eventos cadastrado</p>
        @endif    
    </div>
</div>
@endsection
