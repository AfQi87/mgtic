@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('User Profile')])

@section('content')
<div class="content">
  <div class="container-fluid">
    @if (session('status'))
    <div class="row">
      <div class="col-sm-12">
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="material-icons">close</i>
          </button>
          <span>{{ session('status') }}</span>
        </div>
      </div>
    </div>
    @endif
    <form method="post" action="{{ route('profile.update') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="row">
        <div class="col-sm-8">
          <div class="card ">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('Edit Profile') }}</h4>
              <p class="card-category">{{ __('User information') }}</p>
            </div>
            <div class="card-body ">
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required="true" aria-required="true" />
                    @if ($errors->has('name'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Telefono') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('telefono') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" id="input-telefono" type="number" placeholder="{{ __('Telefono') }}" value="{{ old('telefono', auth()->user()->telefono) }}" required />
                    @if ($errors->has('email'))
                    <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required />
                    @if ($errors->has('email'))
                    <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer ml-auto mr-auto">
              <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card ">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('Edit Image') }}</h4>
            </div>
            <div class="card-body" style="height: 233px; text-align:center">
              <img src="{{auth()->user()->foto != '' && auth()->user()->foto != null ? 'images/'.auth()->user()->foto : 'avatar/avatar.png'}}" alt="..." id="imagenSeleccionada" height="190px" width="150px">
            </div>
            <div class="mb-1 p-1">
              <input type="file" class="form-control" id="foto" name="foto">
            </div>
          </div>
        </div>
      </div>
    </form>

    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{ route('profile.password') }}" class="form-horizontal">
          @csrf
          @method('put')

          <div class="card ">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('Change password') }}</h4>
              <p class="card-category">{{ __('Password') }}</p>
            </div>
            <div class="card-body ">
              @if (session('status_password'))
              <div class="row">
                <div class="col-sm-12">
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>{{ session('status_password') }}</span>
                  </div>
                </div>
              </div>
              @endif
              <div class="row">
                <label class="col-sm-2 col-form-label" for="input-current-password">{{ __('Current Password') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" input type="password" name="old_password" id="input-current-password" placeholder="{{ __('Current Password') }}" value="" required />
                    @if ($errors->has('old_password'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('old_password') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label" for="input-password">{{ __('New Password') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('contraseña') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('contraseña') ? ' is-invalid' : '' }}" name="contraseña" id="input-password" type="password" placeholder="{{ __('New Password') }}" value="" required />
                    @if ($errors->has('contraseña'))
                    <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('contraseña') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <input class="form-control" name="contraseña_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('Confirm New Password') }}" value="" required />
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer ml-auto mr-auto">
              <button type="submit" class="btn btn-primary">{{ __('Change password') }}</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection