@extends('admin.layouts.layout')

@section('content')
<div class="hold-transition register-page"> {{-- Центрирует форму на странице --}}
    <div class="register-box mx-auto" style="max-width: 400px; padding-top: 50px;"> {{-- Ограничивает ширину --}}
        
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <b class="h1">Register</b>
            </div>
            
            <div class="card-body">
                {{-- Вывод сообщений об успехе --}}
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Вывод общих ошибок, если они будут --}}
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('register.store') }}" method="post">
                    @csrf
                    
                    {{-- Имя --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Пароль --}}
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Подтверждение пароля --}}
                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-right"> 
                            <button type="submit" class="btn btn-primary px-4">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
