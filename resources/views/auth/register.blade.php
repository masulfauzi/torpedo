@extends('auth.master-auth')
@section('main')
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    <a href="index.html"><img src="assets/images/logo/logo.svg" alt="Logo"></a>
                </div>
                <h1 class="auth-title">Sign Up</h1>
                <p class="auth-subtitle mb-5">Input your data to register to our website.</p>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" placeholder="Name" name="name"
                            value="{{ old('name') }}">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" placeholder="Username" name="username"
                            value="{{ old('username') }}">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="email" class="form-control form-control-xl" placeholder="Email" name="email"
                            autofocus value="{{ old('email') }}">
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="number" class="form-control form-control-xl" placeholder="Contoh 628123456789" name="no_hp"
                            autofocus value="{{ old('no_hp') }}">
                        <div class="form-control-icon">
                            <i class="fa fa-phone"></i>
                        </div>
                    </div>

                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="npsn" class="form-control form-control-xl" placeholder="NPSN" name="npsn"
                            autofocus value="{{ old('npsn') }}">
                        <div class="form-control-icon">
                            <i class="bi bi-123"></i>
                        </div>
                    </div>

                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="nama_sekolah" class="form-control form-control-xl" placeholder="Nama Sekolah"
                            name="nama_sekolah" autofocus value="{{ old('nama_sekolah') }}">
                        <div class="form-control-icon">
                            <i class="fa fa-school"></i>
                        </div>
                    </div>

                    <div class="form-group position-relative has-icon-left mb-4">
                        {!! Form::select('id_jenis_sekolah', $jenis_sekolah, old('id_jenis_sekolah'), [
                            'class' => 'form-select form-control select2',
                        ]) !!}
                        <div class="form-control-icon">
                            <i class="bi bi-123"></i>
                        </div>
                    </div>

                    <div class="form-group position-relative has-icon-left mb-4">
                        {!! Form::select('id_status_sekolah', $status_sekolah, old('id_status_sekolah'), [
                            'class' => 'form-select form-control select2',
                        ]) !!}
                        <div class="form-control-icon">
                            <i class="bi bi-123"></i>
                        </div>
                    </div>

                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" placeholder="Password" name="password"
                            required autocomplete="new-password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" placeholder="Confirm Password"
                            name="password_confirmation" required>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
                </form>
                <div class="text-center mt-5 text-lg fs-4">
                    <p class='text-gray-600'>Already have an account? <a href="{{ route('login') }}" class="font-bold">Log
                            in</a>.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">

            </div>
        </div>
    </div>
@endsection
