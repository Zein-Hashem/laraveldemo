
@extends("layouts.default")
@section("title","Login")
@section("content")
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
            @if (session()->has("success"))
                <div class="alert alert-sucess">
                    {{ session()->get('success') }}
                </div>
                
                @endif

                @if (session()->has("error"))
                <div class="alert alert-error">
                    {{ session()->get('error') }}
                </div>
                
                @endif
                <div class="card">
                    <br>
                    <div class="card-header">{{ __('Login') }}</div>
                    <div class="card-body">
                        <!-- Start the login form -->
                        <form method="POST" action="{{ route("login.post") }}">
                            @csrf
<br>
                            <!-- Email -->
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
<br>
                            <!-- Password -->
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br><br>
                            <!-- Submit Button -->
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
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