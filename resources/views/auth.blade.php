<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register</title>
    {{--boostrap--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('admin/auth/register.css')}}">
</head>
<body>
<div class="container register">
    <div class="row">
        <div class="col-md-3 register-left">
            <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
            <h3>Welcome</h3>

            <input type="submit" name="" value="Login"/><br/>
        </div>
        <div class="col-md-9 register-right">
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Employee</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h3 class="register-heading">Register</h3>
                    <form class="row register-form" action="/dang-ky" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Full Name *" value="" />
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password *" value="" />
                            </div>
                            <div class="form-group">
                                <input type="password" name="password_confirmation" class="form-control"  placeholder="Confirm Password *" value="" />
                            </div>
                            <div class="form-group">
                                <div>
                                    <input class="form-control" name="date-of-birth" type="date" value="2021-03-08">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="profile-img">Ảnh đại diện</label>
                                <input type="file" name="avatar" id="profile-img">
                                <img src="" class="profile-img-tag mt-2" />
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Your Email *" value="" />
                            </div>
                            <div class="form-group">
                                <select class="form-control choose city" name="province">
                                    <option class="hidden"  selected disabled>Chọn thành phố</option>
                                    @foreach($provinces as $province)
                                        <option  data-id="{{$province->id}}" value="{{ $province->name }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control choose district" name="district">
                                    <option class="hidden"  selected disabled>Chọn huyện</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control choose ward" name="ward">
                                    <option class="hidden"  selected disabled>Chọn khu vực</option>

                                </select>
                            </div>
                            <input type="submit" class="btnRegister"  value="Register"/>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('admin/auth/register.js')}}"></script>
</html>
