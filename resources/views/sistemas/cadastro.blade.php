@extends('layouts.painel-admin')

@section('conteudo')
<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card p-2">
            <form action="{{route('control.sistemas.cadastro')}}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="col-md-12">
                        <label for="">Nome</label>
                        <input type="text" class="form-control" name="nome" required onkeyup="apenasLetras(this)">
                    </div>
                </div>
                <div class="form-row mt-2">
                    <div class="col-md-12">
                        <label>Licença</label>
                        <div class="form-check form-check-primary">
                            <label class="form-check-label" for="licenca_pc">
                              <input type="checkbox" class="form-check-input " value="pc" id="licenca_pc" name="licenca[]"> Computador 
                            </label>
                        </div>
                        <div class="form-check form-check-info">
                            <label class="form-check-label" for="licenca_user">
                              <input type="checkbox" class="form-check-input" value="user" id="licenca_user" name="licenca[]" > Usuário 
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-row mt-3 campos-pc">
                    <div class="col-md-12">
                        <label for="">Custo principal(PC)</label>
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-success text-white">$</span>
                              </div>
                              <input type="text" class="form-control mask-money" name="custo_principal_pc" aria-label="Amount (to the nearest dollar)">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row mt-1 campos-pc">
                    <div class="col-md-12">
                        <label for="">Custo adicional(PC)</label>
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-success text-white">$</span>
                              </div>
                              <input type="text" class="form-control mask-money" name="custo_adicional_pc" aria-label="Amount (to the nearest dollar)">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row mt-3 campos-user">
                    <div class="col-md-12">
                        <label for="">Custo principal(Usuário)</label>
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-success text-white">$</span>
                              </div>
                              <input type="text" class="form-control mask-money" name="custo_principal_user" aria-label="Amount (to the nearest dollar)">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row mt-3 campos-user">
                    <div class="col-md-12">
                        <label for="">Minimo Usuário</label>
                        <input type="number" class="form-control" min="1" name="minimo_user">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-row mt-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-info" id="btn-addGasto">
                            Adicionar Gasto
                        </button>
                    </div>
                </div>
                <div id="gastos">
                    {{-- <div class="form-row">
                        <div class="col-md-5">
                            <label for="">Gasto(nome)</label>
                            <input type="text" class="form-control" required name="gastos[]">
                        </div>
                        <div class="col-md-5">
                            <label for="">Valor</label>
                            <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text bg-success text-white">$</span>
                                  </div>
                                  <input type="text" class="form-control mask-money" name="valores[]">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 align-self-center">
                            <label for=""></label>
                            <button  type="button" class="btn btn-danger mt-3" onclick="removerGasto(this)">
                                <i class="mdi mdi-delete"></i>
                            </button>
                        </div>
                    </div> --}}
                </div>
                

                <div class="form-row mt-3">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Cadastrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        /**
         * Mudar campos de acordo com a opção do tipo do sistema selecionado
         */
        function tooggleOpcaoSistema(){
            $(".campos-user").hide();
            $(".campos-pc").hide();
            $(".form-check-input").on('change', function(e){
                let value = $(this).val();
                if($("#licenca_pc").is(":checked")){
                    $(".campos-pc").show();
                    $(".campos-pc input").prop('required',true);
                }else{
                    $(".campos-pc").hide();
                    $(".campos-pc input").val("");
                    $(".campos-pc input").removeAttr('required');
                }
                if($("#licenca_user").is(":checked")){
                    $(".campos-user").show();
                    $(".campos-user input").removeAttr('required');
                }else{
                    $(".campos-user").hide();
                    $(".campos-user input").val("");
                    $(".campos-user input").removeAttr('required');
                }
            });
        }

        function addGasto(){
            $("#btn-addGasto").on('click', function(){
                let html = '<div class="form-row">'+
'                         <div class="col-md-5">'+
'                             <label for="">Gasto(nome)</label>'+
'                             <input type="text" class="form-control" required name="gastos[]">'+
'                         </div>'+
'                         <div class="col-md-5">'+
'                             <label for="">Valor</label>'+
'                             <div class="form-group">'+
'                                 <div class="input-group">'+
'                                   <div class="input-group-prepend">'+
'                                     <span class="input-group-text bg-success text-white">$</span>'+
'                                   </div>'+
'                                   <input type="text" class="form-control mask-money" name="valores[]">'+
'                                 </div>'+
'                             </div>'+
'                         </div>'+
'                         <div class="col-md-2 align-self-center">'+
'                             <label for=""></label>'+
'                              <button  type="button" class="btn btn-danger mt-3" onclick="removerGasto(this)">'+
'                                 <i class="mdi mdi-delete"></i>'+
'                             </button>'+
'                         </div>'+
'                     </div>';
                $("#gastos").append(html);
                $('.mask-money').mask('000.000.000,00', {reverse:true});
            });
        }
        function removerGasto(element){
            $(element).parents('.form-row').remove();

        }
       $(function(){
            tooggleOpcaoSistema();
            addGasto();
       });
    </script>
@endpush
@endsection