@extends('user.component.main')
@section('content')
    <section class="bg0 p-t-140 p-b-140" style="padding:200px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 offset-lg-3">
                    
                    <form action="{{ route('confirmResetPassword') }}" class="" method="POST">
                        @csrf
                        <h3>Reset Your Password</h3>
                        <input type="hidden" name="email" value="{{ $cus->email }}">
                        <div>
                            <label for=""></label>
                            <input type="password" name="password" placeholder="Enter new password" class="form-control">
                        </div>
                        @if ($errors->has('password'))
                            <p class="text-danger">
                                {{ $errors->first('password') }}
                            </p>
                        @endif
                        <div>
                            <label for=""></label>
                            <input type="password" name="repassword" placeholder="Confirm new password" class="form-control">
                        </div>

                        @if ($errors->has('repassword'))
                            <p class="text-danger">
                                {{ $errors->first('repassword') }}
                            </p>
                        @endif
                        <button type="submit" class="mt-2 btn btn-primary px-3">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection