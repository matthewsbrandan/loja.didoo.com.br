@extends('layouts.app', ['title' => __('Restaurant Management')])

@section('content')
    @include('restorants.partials.header', ['title' => __('Adicionar Franquia')])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Gestão de Franquias') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('franquias.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-4">{{ __('Informações da Franquia') }}</h6>
                        <div class="pl-lg-4">
                            <form method="post" action="{{ route('admin.restaurants.store') }}" autocomplete="off">
                                @csrf
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="name">{{ __('Nome da franquia') }}</label>
                                        <input type="text" name="name" id="name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nome da franquia aqui...') }} ..." value="" required autofocus>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="comissao">{{ __('Comissão por assinaturas') }}</label>
                                        <input type="number" name="comissao" id="comissao" class="form-control form-control-alternative" placeholder="{{ __('Comissão por assinaturas') }} ..." value="" required autofocus>
                                         
                                    </div>
                                    
                                    <input name="users" id="users" value="0" type="hidden">
                                
                                    <div class="form-group d-none">
                                        <label class="form-control-label" for="loja">{{ __('Loja') }}</label>
                                        <input type="number" name="loja" id="loja" class="form-control form-control-alternative" value="1">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="endereco">{{ __('Endereço') }}</label>
                                        <input type="text" name="endereco" id="endereco" class="form-control form-control-alternative" placeholder="{{ __('Endereço') }} ..." value="" required autofocus>
                                         
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="cep">{{ __('Cep') }}</label>
                                        <input type="text" name="cep" id="cep" class="form-control form-control-alternative" placeholder="{{ __('CEP') }} ..." value="" required autofocus>
                                         
                                    </div> 
                                    <div class="form-group">
                                        <label class="form-control-label" for="cidade">{{ __('Cidade') }}</label>
                                        <input type="text" name="cidade" id="cidade" class="form-control form-control-alternative" placeholder="{{ __('Cidade') }} ..." value="" required autofocus>
                                         
                                    </div> 
                                    <div class="form-group">
                                        <label class="form-control-label" for="estado">{{ __('Estado') }}</label>
                                        <input type="text" name="estado" id="estado" class="form-control form-control-alternative" placeholder="{{ __('Estado') }} ..." value="" required autofocus>
                                         
                                    </div>
                                </div>
                                <hr />
                                <h6 class="heading-small text-muted mb-4">{{ __('Owner information') }}</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('name_owner') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="name_owner">{{ __('Owner Name') }}</label>
                                        <input type="text" name="name_owner" id="name_owner" class="form-control form-control-alternative{{ $errors->has('name_owner') ? ' is-invalid' : '' }}"  placeholder="{{ __('Owner Name here') }} ..." value="" required autofocus>
                                        @if ($errors->has('name_owner'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name_owner') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="estado">{{ __('CPF') }}</label>
                                        <input type="text" name="cpf" id="cpf" class="form-control form-control-alternative" placeholder="{{ __('CPF') }} ..." value="" required autofocus>
                                         
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="estado">{{ __('RG') }}</label>
                                        <input type="text" name="rg" id="rg" class="form-control form-control-alternative" placeholder="{{ __('RG') }} ..." value="" required autofocus>
                                         
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="email_owner">{{ __('Owner Email') }}</label>
                                        <input type="email" name="email_owner" id="email_owner" class="form-control form-control-alternative" placeholder="{{ __('Owner Email here') }} ..." value="" required autofocus>
                                     
                                    </div>
                                    <div class="form-group{{ $errors->has('phone_owner') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="phone_owner">{{ __('Owner Phone') }}</label>
                                        <input type="text" name="phone_owner" id="phone_owner" class="form-control form-control-alternative{{ $errors->has('phone_owner') ? ' is-invalid' : '' }}"  placeholder="{{ __('Owner Phone here') }} ..." value="" required autofocus>
                                        @if ($errors->has('phone_owner'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone_owner') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
