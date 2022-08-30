@extends('layouts.painel-admin')

@section('conteudo')
<div class="row">
    <div class="col-md-12">
        <form action="" method="POST">
            @csrf
            <div class="form-row">
                <div class="col-md-10">
                    <input type="search" class="form-control" placeholder="Buscar: Codigo, nome, login" name="busca" value="">
                </div>
                <div class="col-md-1 align-self-end">
                    <button type="submit" class="btn btn-info btn-block">
                        Ir!
                    </button>
                </div>
                <div class="col-md-1 align-self-end">
                    <a href="{{route('view.sistemas.cadastro')}}" class="btn btn-success btn-block">
                        Novo
                    </a>
                </div>
            </div>
        </form>
    </div>

</div>
<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card p-1">
            <div class="table-responsive" style="min-height: 300px" id="tabela-users">
                <table class="table table-striped">
                    <thead>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>PC(R$)</th>
                        <th>Custo adicional(R$)</th>
                        <th>Custo usuário(R$)</th>
                        <th>Usuario exigidos</th>
                        <th>Saldo</th>
                        <th>Opções</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="row mt-2">
                <div class="col-md-12 d-flex justify-content-end">
                    

                </div>
            </div>
        </div>
        
    </div>
</div>


@push('scripts')
    <script>
       
    </script>
@endpush
@endsection