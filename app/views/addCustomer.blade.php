@extends('layout.layout');
@section('content')
    <div class="text-center mt-4">
        <h3>Add Customer</h3>
    </div>
    <form method="post" enctype="multipart/form-data">
        <div class="input-group flex-nowrap mt-5">
            <span class="input-group-text" >Full Name:</span>
            <input type="text" class="form-control" name="fullName" placeholder="Username">
        </div>
        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text" >Avatar:</span>
            <input type="file" class="form-control" name="avatar">
        </div>
        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text" >Birthday:</span>
            <input type="date" class="form-control" name="birthday" placeholder="Birthday">
        </div>
        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text" >Address:</span>
            <input type="text" class="form-control" name="address" placeholder="Address">
        </div>
        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text" >Email:</span>
            <input type="text" class="form-control" name="email" placeholder="Email">
        </div>
        <button type="submit" class="btn btn-dark mt-4">Add Customer</button>
    </form>
@endsection
