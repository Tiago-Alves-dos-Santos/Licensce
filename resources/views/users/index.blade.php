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
            <div class="table-responsive" style="min-height: 300px" id="tabela-users">
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
                                @if (!empty($value->logo))
                                <img src="{{Configuracao::getPath('perfil').'/'.$value->logo}}" class="img-fluid"/>
                                @else
                                <img src="{{asset('img/user-default.png')}}" class="img-fluid"/>
                                @endif
                            </td>
                            <td>{{$value->id}}</td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->login}}</td>
                            <td>{{$value->email}}</td>
                            <td>
                                @switch($value->tipo)
                                    @case('dev_admin')
                                        <span class="badge badge-info">ADMIN (DEV)</span>
                                        @break
                                    @case('dev_empregado')
                                        <span class="badge badge-success">EMPREGADO (DEV)</span>
                                        @break
                                    @case('user_admin')
                                        <span class="badge badge-warning">ADMIN (USER)</span>
                                        @break
                                    @case('user_empregado')
                                        <span class="badge badge-primary">EMPREGADO (USER)</span>
                                        @break
                                
                                    @default
                                        
                                @endswitch
                            </td>
                            <td>
                                @switch($value->ativo)
                                    @case('Y')
                                    <span class="badge badge-success">Ativo</span>
                                        @break
                                    @case('N')
                                    <span class="badge badge-danger">Desativo</span>
                                        @break
                                
                                    @default
                                        
                                @endswitch
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="mdi mdi-power-settings"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                      <h6 class="dropdown-header">Configurações</h6>
                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editarUser-{{$value->id}}">Editar</a>
                                        @switch($value->ativo)
                                            @case('Y')
                                            <a class="dropdown-item toogle-ativacao" href="{{route('control.user.toogleAtivacao', [
                                                'id' => $value->id,
                                                'value' => 'desativar'
                                            ])}}" >Desativar</a>
                                                @break
                                            @case('N')
                                            <a class="dropdown-item toogle-ativacao" href="{{route('control.user.toogleAtivacao', [
                                                'id' => $value->id,
                                                'value' => 'ativar'
                                            ])}}">Ativar</a>
                                                @break
                                        
                                            @default
                                                
                                        @endswitch
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item" href="#">Excluir</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <x-modal titulo='Editar usuário' id="editarUser-{{$value->id}}">
                            @include('users.editar', ['user' => $value])
                        </x-modal>
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