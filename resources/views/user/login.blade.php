@extends('admin.layouts.layout')

@section('content')
<div class="hold-transition login-page"> {{-- Центрирует форму на странице --}}
    <div class="login-box mx-auto" style="max-width: 400px; padding-top: 50px;"> {{-- Задает фиксированную ширину --}}
        
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <b class="h1">Login</b>
            </div>
            
            <div class="card-body">
                {{-- Вывод сообщений --}}
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Форма --}}
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-right"> {{-- Кнопка справа, как на скрине --}}
                            <button type="submit" class="btn btn-primary px-4">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>
@endsection
