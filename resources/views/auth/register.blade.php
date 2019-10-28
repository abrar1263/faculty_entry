@extends('layout.adminapp')

@section('body')

@include('sweet::alert')

             <div class="container">
    <div class="col-md-10 " >
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="container">
                <h2>Register Faculty</h2>
        </div>
      </div><br>
      <div class="panel-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="designation" class="col-md-4 col-form-label text-md-right">{{ __('designation') }}</label>

                            <div class="col-md-6">
                                 <select id="designation" type="text" class="form-control {{ $errors->has('designation') ? ' is-invalid' : '' }}" name="designation" value="{{ old('designation') }}" required >
                                         <option value="HOD">HOD</option>
                                         <option value="AP">Asst Professor</option>
                                         <option value="LEC">Lecturer</option>
                                         <option value="LASS">Lab. Assistant</option>
                                        <option value="ATT">Attendant</option>
                                </select>
                                

                                @if ($errors->has('designation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('designation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right">{{ __('department') }}</label>

                            <div class="col-md-6">

                                  <select id="department" type="text" class="form-control{{ $errors->has('department') ? ' is-invalid' : '' }}" name="department" value="{{ old('department') }}" required>

                                 <option value="AUTO">Automobile</option>
                                <opion value="CIV">Civil</option>
                                 <option value="COMP">Computer</option>
                                <option value="ETRX">Electronics</option>
                                 <option value="ELECT">Electrical</option>
                                 <option value="EXTC">Electonics & Telecom</option>
                                 <option value="IT">Infomation Technology</option>
                                 <option value="MECH">Mechanical</option>
                                 <option value="APPS">Humanities & Sciencs</option>


                                </select>
                                

                                @if ($errors->has('department'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
