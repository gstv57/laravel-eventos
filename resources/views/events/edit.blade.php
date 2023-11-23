@extends('layouts.main')

@section('title', 'Editando: ' . $event->title)

@section('content')

    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h1>Editando: {{ $event->title }}</h1>
        <form action="/events/update/{{ $event->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="image">Imagem do evento:</label>
                <input type="file" id="image" name="image" class="form-control-file">
                <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="img-preview">
            </div>
            <div class="form-group">
                <label for="title">Evento:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento"
                    value="{{ $event->title }}">
            </div>
            <div class="form-group">
                <label for="title">Data do Evento:</label>
                <input type="date" class="form-control" id="date" name="date"
                    value="{{ date('Y-m-d', strtotime($event->date)) }}">
            </div>
            <div class="form-group">
                <label for="title">Cidade:</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Local do evento"
                    value="{{ $event->city }}">
            </div>
            <div class="form-group">
                <label for="title">O evento é privado?</label>
                <select name="private" id="private" class="form-control">
                    <option value="0">Não</option>
                    <option value="1" {{ $event->private == 1 ? "selected='selected'" : '' }}>Sim</option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Descrição:</label>
                <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer no evento">{{ $event->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="title">Adicione itens de infraestrutura:</label>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Cadeiras">Cadeiras
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Open Comida">Open Comida
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Palanque">Palanque
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Palco">Palco
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Ponto de Energia">Ponto de Energia
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Extenção/Tomadas">Extensão/Tomadas
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="LEDs/Iluminação">LEDs/Iluminação
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Banners">Banners
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Equipamentos de Som">Equipamentos de Som
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Câmeras">Câmeras
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Sofás para palestrantes">Sofás para palestrantes
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Banheiros">Banheiros
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Brigada de Incendio">Brigada de Incêndio
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Coleta de lixo">Coleta de lixo
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Ventilação">Ventilação
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Segurança">Segurança
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Atualizar Evento">
        </form>
    </div>
@endsection
