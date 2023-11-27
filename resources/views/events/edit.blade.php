@extends('layouts.main')

@section('title','Editando o evento: '.$event->titulo)

@section('content')
<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Editando o evento:{{$event->titulo}}</h1>
  <form action="/events/update/{{$event->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="image">Imagem do Evento:</label>
      <input type="file" id="image" name="image" class="from-control-file">
      <img src="/img/events/{{$event->image}}" alt="{{$event->titulo}}" class="img-preview">
    </div>
    <div class="form-group">
      <label for="title">Evento:</label>
      <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Nome do evento" value="{{$event->titulo}}" >
    </div>
    <div class="form-group">
      <label for="data">Data:</label>
      <input type="text" class="form-control" id="data" name="data" value="{{date('d/m/y',strtotime($event->data))}}">
    </div> 
    <div class="form-group">
      <label for="title">Cidade:</label>
      <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Local do evento" value="{{$event->cidade}}">
    </div>
    <div class="form-group">
      <label for="title">O evento é privado?</label>
      <select name="privado" id="privado" class="form-control">
        <option value="0">Não</option>
        <option value="1" {{$event->privado==1? "selected='select'":""}}>Sim</option>
      </select>
    </div>
    <div class="form-group">
      <label for="title">Descrição:</label>
      <textarea name="descricao" id="descricao" class="form-control" placeholder="Descrição do evento">{{ $event->descricao }}</textarea>
    </div>
    <div class="form-group">
      <label for="title">O que teremos no evento:</label>
      <div class="form-group">	
        <input type="checkbox" name="items[]" value="Cadeiras" {{in_array("Cadeiras",$event->items)? "checked":""}}> Cadeiras
      </div>
      <div class="form-group">	
        <input type="checkbox" name="items[]" value="Palco" {{in_array("Palco",$event->items)? "checked":""}}> Palco
      </div>
      <div class="form-group">	
        <input type="checkbox" name="items[]" value="Open Bar" {{in_array("Open Bar",$event->items)? "checked":""}} > Open Bar
      </div>
      <div class="form-group">	
        <input type="checkbox" name="items[]" value="Open Food" {{in_array("Open Food",$event->items)? "checked":""}} > Open Food
      </div>
      <div class="form-group">	
        <input type="checkbox" name="items[]" value="Brindes" {{in_array("Brindes",$event->items)? "checked":""}}> Brindes
      </div>
    </div>
    <input type="submit" class="btn btn-primary" value="Atualizar">
  </form>
</div>

@endsection