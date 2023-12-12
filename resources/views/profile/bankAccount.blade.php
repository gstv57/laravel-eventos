@extends('layouts.main')

@section('title', 'Criar Perfil Bancário')

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
                        <form action="/profile/bank/save" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Agência</p>
                                        <input type="number" class="form-control form-control-sm" id="agency"
                                            name="agency" value="">
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Conta</p>
                                        <input type="number" class="form-control form-control-sm" id="account"
                                            name="account" value="">
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Nome do Banco</p>
                                        <select class="js-example-basic-single" name="bank">
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->id }} - {{ $bank->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-outline-primary ms-1">Registrar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
@endsection
