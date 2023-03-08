@extends('user.component.main')
@section('content')
    <section class="bg0 p-t-140 p-b-140" style="padding:200px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 offset-lg-3">
                    <form action="{{ route('login') }}" method="POST" class="">
                        @csrf
                        <h3>User Login</h3>
                        @if (Session::has('msg'))
                            <p class="text-success">
                                {{ Session::get('msg') }}
                            </p>
                        @endif
                        @if (Session::has('error'))
                            <p class="text-danger">
                                {{ Session::get('error') }}
                            </p>
                        @endif
                        <div class="fs-2">
                            <a href="{{ route('oauth', 'facebook') }}">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a href="{{ route('oauth', 'google') }}">
                                <i class="fa fa-google"></i>
                            </a>
                            <a href="{{ route('oauth', 'github') }}">
                                <i class="fa fa-github"></i>
                            </a>
                        </div>
                        <div>
                            <label for=""></label>
                            <input type="email" placeholder="Enter email" name="email" class="form-control">
                        </div>

                        @if ($errors->has('email'))
                            <p class="text-danger">
                                {{ $errors->first('email') }}
                            </p>
                        @endif
                        <div>
                            <label for=""></label>
                            <input type="password" placeholder="Enter password" name="password" class="form-control">
                        </div>

                        @if ($errors->has('password'))
                            <p class="text-danger">
                                {{ $errors->first('password') }}
                            </p>
                        @endif
                        <a href="{{ route('forgetView') }}">Forget Password?</a> <br>
                        <button type="submit" class="mt-2 btn btn-primary px-3">Login</button>
                    </form>
                    <p>
                        Don't have an account <a href="{{ route('registerView') }}">register here</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection