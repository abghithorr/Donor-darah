@extends('layout')
@section('content')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="position: absolute">
        <path fill="#cf1515" fill-opacity="1"
            d="M0,192L80,165.3C160,139,320,85,480,96C640,107,800,181,960,197.3C1120,213,1280,171,1360,149.3L1440,128L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z">
        </path>
    </svg>
    <div class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="container d-flex flex-row justify-content-evenly align-items-center">
                    <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <main class="form-login">
                            <form action="{{ route('auth')}}" method="POST">
                                @csrf
                                <h1 class="h3 mb-3 fw-normal text-center" style="z-index:auto">Login</h1>
                                <div class="form-floating">
                                    <input type="text" name="email" class="form-control mt-2" id="email"
                                        placeholder="Name" autofocus>
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-floating">
                                    <input type="password" name="password" class="form-control mt-2" id="password"
                                        placeholder="Password">
                                    <label for="password">Password</label>
                                </div>
                                <button class="w-100 btn btn-lg btn-secondary text-white mt-4" type="submit">Masuk</button>
                            </form>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    @endsection