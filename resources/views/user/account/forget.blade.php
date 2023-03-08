@extends('user.component.main')
@section('content')
    <section class="bg0 p-t-140 p-b-140" style="padding:200px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 offset-lg-3">
                    
                    <form action="{{ route('checkUser') }}" class="" method="POST">
                        @csrf
                        <h3>Enter your email to reset password</h3>
                        @if (Session::has('error'))
                           <p class="text-danger">{{ Session::get('error') }}</p> 
                        @endif

                        @if (Session::has('msg'))
                           <p class="text-success">{{ Session::get('msg') }}</p> 
                        @endif
                        @if ($errors->has('email'))
                            <p class="text-danger">
                                {{ $errors->first('email') }}
                            </p>
                        @endif
                        <div>
                            <label for=""></label>
                            <input type="email" name="email" placeholder="Enter email" class="form-control">
                        </div>
                        <button type="submit" class="mt-2 btn btn-primary px-3">Continue</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection