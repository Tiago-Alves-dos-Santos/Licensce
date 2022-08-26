<div class="row">
    <div class="col-md-12">
        <form action="{{route('control.user.cadastrar')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="col-md-12">
                    <label for="">Nome</label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome">
                    @error('nome')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12">
                    <label for="">Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email">
                    @error('email')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12">
                    <label for="">Login</label>
                    <input type="text" class="form-control @error('login') is-invalid @enderror" name="login">
                    @error('login')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12">
                    <label for="">Senha</label>
                    <input type="text" class="form-control @error('senha') is-invalid @enderror" name="senha">
                    @error('senha')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12">
                    <label for="">Confirmar Senha</label>
                    <input type="text" class="form-control @error('confirmar_senha') is-invalid @enderror" name="confirmar_senha">
                    @error('confirmar_senha')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12">
                    <label for="">Tipo</label>
                    <select name="tipo" id="" class="form-control @error('tipo') is-invalid @enderror">
                        <option value="">Selecione</option>
                        @switch(Auth::user()->tipo)
                            @case('dev_admin')
                                <option value="dev_admin">Dev Admin</option>
                                <option value="dev_empregado">Dev Empregado</option>
                                <option value="user_admin">Ususário Admin</option>
                                <option value="user_empregado">Ususário Empregado</option>
                                @break
                            @case('dev_empregado')
                                <option value="dev_empregado">Dev Empregado</option>
                                <option value="user_admin">Ususário Admin</option>
                                <option value="user_empregado">Ususário Empregado</option>
                                @break
                            @case('user_admin')
                                <option value="user_admin">Ususário Admin</option>
                                <option value="user_empregado">Ususário Empregado</option>
                                @break
                            @case('user_empregado')
                                <option value="user_empregado">Ususário Empregado</option>
                                @break
                        
                            @default
                                
                        @endswitch
                    </select>
                    @error('tipo')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-row mt-2">
                <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Cadastrar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>