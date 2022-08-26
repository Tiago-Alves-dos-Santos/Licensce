@extends('layouts.painel-admin')

@section('conteudo')
<div class="row">
    <div class="col-md-10">
        <input type="search" class="form-control" placeholder="Buscar:">
    </div>
    <div class="col-md-1 align-self-end">
        <button class="btn btn-info btn-block">
            Ir!
        </button>
    </div>
    <div class="col-md-1 align-self-end">
        <button class="btn btn-success btn-block" data-toggle="modal" data-target="#cadastrarUser">
            Novo
        </button>
    </div>
</div>
<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card p-1">
            <div class="table-responsive" style="min-height: 300px">
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Login</th>
                        <th>Email</th>
                        <th>Tipo</th>
                        <th>Ativo</th>
                        <th>Opções</th>
                    </thead>
                    <tbody>
                        @forelse ($users as $value)
                        <tr>
                            <td>
                                <img src="https://source.unsplash.com/random/50x50" class="img-fluid"/>
                            </td>
                            <td>{{$value->id}}</td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->login}}</td>
                            <td>{{$value->email}}</td>
                            <td>
                                <span class="badge badge-primary">{{$value->tipo}}</span>
                            </td>
                            <td>
                                <span class="badge badge-success">{{$value->ativo}}</span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="mdi mdi-power-settings"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                      <h6 class="dropdown-header">Configurações</h6>
                                      <a class="dropdown-item" href="#">Editar</a>
                                      <a class="dropdown-item" href="#">Desativar</a>
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item" href="#">Excluir</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="8">N/A</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>

<x-modal titulo='Novo usuário' id="cadastrarUser">
    @include('users.cadastrar')
</x-modal>
@endsection