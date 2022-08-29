<div class="row">
    <div class="col-md-12">
        <form action="{{route('control.user.editar', ['id' => base64_encode($user->id)])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="col-md-12 d-flex justify-content-center">
                    @if (!empty($user->logo))
                    <img src="{{asset(Configuracao::getPath('perfil',true).'/'.$user->logo)}}" alt="" id="preview-editar-{{$user->id}}" class="img-fluid" style="width: 90px; height: 90px">
                    @else
                    <img src="{{asset('img/user-default.png')}}" alt="" id="preview-editar-{{$user->id}}" class="img-fluid" style="width: 90px; height: 90px">
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12">
                    <label for="">Logo</label>
                    <input type="file" name="logo" class="file" id="arquivo_editar_{{$user->id}}" accept="image/*" style="visibility: hidden; position: absolute;">

                    <div class="input-group my-3" id="btn-up-editar-{{$user->id}}">
                        <input type="text" class="form-control" style="background-color: #2A3038; color: white;" disabled placeholder="Selecionar Arquivo" id="file-texto-editar-{{$user->id}}">
                        <div class="input-group-append">
                            <button type="button" class="browse btn bg-primary">Buscar</button>
                        </div>
                    </div>
                    @error('logo')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12">
                    <label for="">Nome</label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{$user->name}}">
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
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}">
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
                    <input type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{$user->login}}">
                    @error('login')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12">
                    <label for="">Nova Senha</label>
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
                    <select name="tipo" id="" class="form-control @error('tipo') is-invalid @enderror" >
                        <option value="">Selecione</option>
                        @switch(Auth::user()->tipo)
                            @case('dev_admin')
                                <option value="dev_admin" @if($user->tipo == 'dev_admin') selected @endif>Dev Admin</option>
                                <option value="dev_empregado" @if($user->tipo == 'dev_empregado') selected @endif>Dev Empregado</option>
                                <option value="user_admin" @if($user->tipo == 'user_admin') selected @endif>Ususário Admin</option>
                                <option value="user_empregado" @if($user->tipo == 'user_empregado') selected @endif>Ususário Empregado</option>
                                @break
                            @case('dev_empregado')
                                <option value="dev_empregado" @if($user->tipo == 'dev_empregado') selected @endif>Dev Empregado</option>
                                <option value="user_admin" @if($user->tipo == 'user_admin') selected @endif>Ususário Admin</option>
                                <option value="user_empregado" @if($user->tipo == 'user_empregado') selected @endif>Ususário Empregado</option>
                                @break
                            @case('user_admin')
                                <option value="user_admin" @if($user->tipo == 'user_admin') selected @endif>Ususário Admin</option>
                                <option value="user_empregado" @if($user->tipo == 'user_empregado') selected @endif>Ususário Empregado</option>
                                @break
                            @case('user_empregado')
                                <option value="user_empregado" @if($user->tipo == 'user_empregado') selected @endif>Ususário Empregado</option>
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
                        Salvar
                    </button>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            $("#btn-up-editar-{{$user->id}}").click(function() {
                var file = $(this).parents().find("#arquivo_editar_{{$user->id}}");
                file.trigger("click");
            });

            $("input#arquivo_editar_{{$user->id}}").change(function(e) {
                var fileName = e.target.files[0].name;
                //seleciona o input texto
                $("#file-texto-editar-{{$user->id}}").val(fileName);

                var reader = new FileReader();
                reader.onload = function(e) {
                    // seleciona a div com img com id preview e atribui a img
                    document.getElementById("preview-editar-{{$user->id}}").src = e.target.result;
                };
                // read the image file as a data URL.
                reader.readAsDataURL(this.files[0]);
            });

            


        </script>
    @endpush
</div>