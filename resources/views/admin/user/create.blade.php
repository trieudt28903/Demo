@extends('admin.layout.master')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>Add</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="{{route('admin.user.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" name="name" placeholder="Please Enter Username" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="pass" placeholder="Please Enter Password" />
                        </div>
                        <div class="form-group">
                            <label>RePassword</label>
                            <input type="password" class="form-control" name="repasss" placeholder="Please Enter RePassword" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Please Enter Email" />
                        </div>
                        <div class="form-group">
                            <label>Is Admin</label>
                            <label class="radio-inline">
                                <input name="is_admin" value="0" checked  type="radio">User
                            </label>
                            <label class="radio-inline">
                                <input name="is_admin" value="1" type="radio">Admin
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">User Add</button>

                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
