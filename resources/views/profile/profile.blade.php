@extends('layouts.main')

@section('title', 'Eventos')


@section('content')

    <section style="background-color: #eee;">
        @if (isset($contactInfo))
            <div class="container py-5">
                <div class="row">
                    <div class="col">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                    alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                <h5 class="my-3">{{ $user->name }} <ion-icon name="checkmark-circle-outline"></ion-icon>
                                </h5>
                                <p class="text-muted mb-1">Full Stack Developer</p>
                                <p class="text-muted mb-4">{{ $contactInfo->country }}, {{ $contactInfo->state }}</p>
                            </div>
                        </div>
                        <div class="card mb-4 mb-lg-0">
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush rounded-3">
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                        <p class="mb-0"><ion-icon name="wallet-outline"></ion-icon>Saldo Disponível: R$
                                            {{ $user->wallet->balance }}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card mb-4 mb-lg-0">
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush rounded-3">
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                        <p class="mb-0"><ion-icon name="card-outline"></ion-icon>Transações</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="card mb-4 mb-lg-0">
                                @foreach ($transactions as $transaction)
                                    @if ($transaction->type == 'credito')
                                        <ul class="list-group list-group-flush rounded-3">
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                <p class="mb-0">Crédito: + R${{ $transaction->amount }} |
                                                    {{ $transaction->event->title }} |
                                                    {{ $transaction->created_at->format('d/m/Y H:i:s') }}

                                                </p>
                                            </li>
                                        </ul>
                                    @elseif($transaction->type == 'debito')
                                        <ul class="list-group list-group-flush rounded-3">
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                <p class="mb-0">Débito: - R${{ $transaction->amount }} |
                                                    {{ $transaction->event->title }} |
                                                    {{ $transaction->created_at->format('d/m/Y H:i:s') }}

                                                </p>
                                            </li>
                                        </ul>
                                    @elseif($transaction->type == 'estorno')
                                        <ul class="list-group list-group-flush rounded-3">
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                <p class="mb-0">Chargeback: - R${{ $transaction->amount }} |
                                                    {{ $transaction->event->title }} |
                                                    {{ $transaction->created_at->format('d/m/Y H:i:s') }}

                                                </p>
                                            </li>
                                        </ul>
                                    @elseif($transaction->type == 'credito_estorno')
                                        <ul class="list-group list-group-flush rounded-3">
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                <p class="mb-0">Crédito Estorno: + R${{ $transaction->amount }} |
                                                    {{ $transaction->event->title }} |
                                                    {{ $transaction->created_at->format('d/m/Y H:i:s') }}

                                                </p>
                                            </li>
                                        </ul>
                                    @endif
                                @endforeach
                            </div>
                            <p>{{ $transactions->links() }}</p>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Nome completo</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $user->name }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Email</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Telefone</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $contactInfo->phone }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Rua</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $contactInfo->address }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Número</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $contactInfo->address_number }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Bairro</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $contactInfo->neighborhood }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Cidade</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $contactInfo->city }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Estado</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $contactInfo->state }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">CEP</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $contactInfo->zip }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">País</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $contactInfo->country }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <a href="/profile/edit" type="button"
                                            class="btn btn-outline-primary ms-3 col-6">Editar</a>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="card mb-4 mb-lg-0">
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush rounded-3">
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                        <p class="mb-0"><ion-icon name="cash-outline"></ion-icon>Dados Bancários</p>
                                    </li>
                                    @if(isset($account))
                                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <p class="mb-0">Banco: {{$account->banks->first()->name}} | Agência: {{$account->agency}} | Conta: {{$account->account}}</p>
                                        </li>
                                    @else
                                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <a href="/profile/bank/create" type="button" class="btn btn-outline-primary ms-3 col-6">Cadastro</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <hr>
                <div class="row">
                    <div class="col-sm-9">
                        <a href="/profile/create" type="button" class="btn btn-outline-primary ms-3 col-6">Completar
                            Perfil</a>
                    </div>
                </div>
                <hr>
        @endif
    </section>
@endsection
