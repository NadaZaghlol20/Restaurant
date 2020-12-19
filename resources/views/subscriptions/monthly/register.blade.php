@extends('layouts.admin')
@section('content')
    <div class="container-fluid col-md-10">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div style="overflow-x:auto !important">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title float-left">Users</h3>

                            <div class="card-tools float-right">
                                <button class="btn btn-success">Add New &nbsp;&nbsp;<i class="fa fa-plus" ></i></button>
                            </div>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Expire Date</th>
                                        <th>Modify</th>
                                    </tr>
                                    @foreach($users as $usr)
                                        <tr>
                                            <td>{{ $usr->id }}</td>
                                            <td>{{ $usr->name }}</td>
                                            <td>{{ $usr->email }}</td>
                                            <td>{{ $usr->phone }}</td>
                                            <td>{{ $usr->expire_date }}</td>
                                            <td>
                                                <a href="{{ route('dashboard.accept',$usr->id) }}" class="btn btn-success">Accept</a>
                                                <a href="{{ route('dashboard.refuse',$usr->id) }}" class="btn btn-danger">Refuse</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
