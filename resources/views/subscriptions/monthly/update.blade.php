@extends('layouts.admin')
@section('content')
    <div class="container-fluid col-md-10">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div style="overflow-x:auto !important">
                    <div class="card" style="margin-top:70px">
                        <div class="card-header">
                            <h5 class="card-title float-left">Update User</h5>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                @if($errors->any())
                                    <ul style="color:red">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                <div class="col-md-9" style="margin-top:50px;padding-left:30px;padding-right:30px;">
                                    <form class="form"  method="POST" role="form" action="{{route('dashboard.update',$userx->id)}}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control input" placeholder="Name" name="name" value="{{old('name', $userx->name)}}">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control input" placeholder="Email" name="email" value="{{ old('email', $userx->email)}}">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control input" placeholder="Phone" name="phone" value="{{ old('phone', $userx->phone)}}">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control input" placeholder="Password" name="password">
                                        </div>
                                        <div class="form-group">
                                            <input type="date" class="form-control input" placeholder="Expire Date" name="expire_date" value="{{ old('expire_date', $userx->expire_date)}}">
                                        </div>

                                        <div class=" text-center">
                                            <button type="submit" class="btn btn-primary my-4">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
