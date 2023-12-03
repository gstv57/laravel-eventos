@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')

    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h1>Crie seu evento</h1>
        <form action="/events" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Imagem do evento:</label>
                <input type="file" id="image" name="image" class="form-control-file" required>
            </div>

            <div class="form-group">
                <label for="title">Evento:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento"
                    value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="title">Data do Evento:</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}">
            </div>
            <div class="form-group">
                <label for="title">Cidade:</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Local do evento"
                    value="{{ old('city') }}">
            </div>
            <div class="form-group">
                <label for="title">O evento é privado?</label>
                <select name="private" id="private" class="form-control">
                    <option value="0" {{ old('private') == 0 ? 'selected' : '' }}>Não</option>
                    <option value="1" {{ old('private') == 1 ? 'selected' : '' }}>Sim</option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Descrição:</label>
                <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer no evento">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="title">Preço:</label>
                <input type="number" class="form-control" id="price" name="price"
                    placeholder="Quanto o evento custa? EX: 10.00" value="{{ old('price') }}">
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
            <input type="submit" class="btn btn-primary" value="Criar Evento">
        </form>
    </div>
@endsection
