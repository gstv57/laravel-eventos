@extends('layouts.main')

@section('title', 'Criar Perfil de Contato')

@section('content')

    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <form action="/profile/save" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Nome completo</p>
                                        <input type="text" class="form-control form-control-sm" id="name"
                                            name="name" value="{{ $user->name }}">
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Email</p>
                                        <input type="email" class="form-control form-control-sm" id="email"
                                            name="email" value="{{ $user->email }}" disabled>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Telefone</p>
                                        <input type="tel" class="form-control form-control-sm" id="telefone"
                                            name="phone">
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">CEP</p>
                                        <input type="text" class="form-control form-control-sm" id="zip"
                                            name="zip" onblur="consultaCep(this.value)">
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Rua</p>
                                        <input type="text" class="form-control form-control-sm" id="endereco"
                                            name="address">
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Número</p>
                                        <input type="text" class="form-control form-control-sm" id="address_number"
                                            name="address_number">
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Bairro</p>
                                        <input type="text" class="form-control form-control-sm" id="neighborhood"
                                            name="neighborhood">
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Estado</p>
                                        <input type="text" class="form-control form-control-sm" id="state"
                                            name="state">
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Cidade</p>
                                        <input type="text" class="form-control form-control-sm" id="city"
                                            name="city">
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">País</p>
                                        <input type="text" class="form-control form-control-sm" id="country"
                                            name="country">
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-outline-primary ms-1">Atualizar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/scripts.js') }}"></script>
@endsection
