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
        <button class="btn btn-success btn-block">
            Novo
        </button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <th>Nome</th>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Tipo</th>
                </thead>
                <tbody>
                    <tr>
                        <td>teste</td>
                        <td>teste</td>
                        <td>teste</td>
                        <td>teste</td>
                    </tr>
                    <tr>
                        <td>teste</td>
                        <td>teste</td>
                        <td>teste</td>
                        <td>teste</td>
                    </tr>
                    <tr>
                        <td>teste</td>
                        <td>teste</td>
                        <td>teste</td>
                        <td>teste</td>
                    </tr>
                    <tr>
                        <td>teste</td>
                        <td>teste</td>
                        <td>teste</td>
                        <td>teste</td>
                    </tr>
                    <tr>
                        <td>teste</td>
                        <td>teste</td>
                        <td>teste</td>
                        <td>teste</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection