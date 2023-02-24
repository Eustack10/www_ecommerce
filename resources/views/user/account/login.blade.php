@extends('user.component.main')
@section('content')
    <section class="bg0 p-t-140 p-b-140" style="padding:200px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <form action="" class="">
                        <h3>User Login</h3>
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
                        <div>
                            <label for=""></label>
                            <input type="email" placeholder="Enter email" class="form-control">
                        </div>
                        <div>
                            <label for=""></label>
                            <input type="password" placeholder="Enter password" class="form-control">
                        </div>

                        <button type="submit" class="mt-2 btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection