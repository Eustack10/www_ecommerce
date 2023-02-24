@extends('user.component.main')
@section('content')
    <section class="bg0 p-t-140 p-b-140" style="padding:200px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <form action="{{ route('register') }}" method="POST" class="">
                        @csrf
                        <h3>User Registeration</h3>
                        <div>
                            <a href="">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a href="">
                                <i class="fa fa-google"></i>
                            </a>
                            <a href="">
                                <i class="fa fa-github"></i>
                            </a>
                        </div>
                        <div class="mt-2">
                            <label for="">Username</label>
                            <input name="name" value="{{ old('name') }}" type="text" placeholder="Enter name" class="form-control">
                        </div>
                        @if ($errors->has('name'))
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        @endif
                        <div class="mt-2">
                            <label for="">Email</label>
                            <input name="email" value="{{ old('email') }}" type="email" placeholder="Enter email" class="form-control">
                        </div>
                        @if ($errors->has('email'))
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        @endif
                        <div class="mt-2">
                            <label for="">Password</label>
                            <input name="password" value="{{ old('password') }}" type="password" placeholder="Enter password" class="form-control">
                        </div>

                        @if ($errors->has('password'))
                            <p class="text-danger">{{ $errors->first('password') }}</p>
                        @endif
                        <div class="mt-2">
                            <label for="">Confirm Password</label>
                            <input name="repassword" value="{{ old('repassword') }}" type="password" placeholder="Re-Enter password" class="form-control">
                        </div>

                        @if ($errors->has('repassword'))
                            <p class="text-danger">{{ $errors->first('repassword') }}</p>
                        @endif
                        <div class="mt-2">
                            <label for="">Phone Number</label>
                            <input name="phone" value="{{ old('phone') }}" type="phone" placeholder="Enter phone number" class="form-control">
                        </div>
                        @if ($errors->has('phone'))
                            <p class="text-danger">{{ $errors->first('phone') }}</p>
                        @endif
                        <div class="mt-2">
                            <label for="">Date Of Birth</label>
                            <input name="dob" value="{{ old('dob') }}" type="date" placeholder="Enter email" class="form-control">
                        </div>
                        @if ($errors->has('dob'))
                            <p class="text-danger">{{ $errors->first('dob') }}</p>
                        @endif
                        <div class="mt-2">
                            <label for="">Gender</label>
                            <select name="gender" id="" class="form-control">
                                <option disabled selected>--Select Gender--</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        @if ($errors->has('gender'))
                            <p class="text-danger">{{ $errors->first('gender') }}</p>
                        @endif
                        <div class="mt-2">
                            <label for="">Address(optional)</label>
                            <textarea name="address" placeholder="Enter Address" class="form-control">{{ old('address') }}</textarea>
                        </div>
                        @if ($errors->has('address'))
                            <p class="text-danger">{{ $errors->first('address') }}</p>
                        @endif

                        <button type="submit" class="mt-2 btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection