@extends('layout.layout');
@section('content')
<a href="{{route('add_customers')}}"></a>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Full Name</th>
        <th scope="col">Avatar</th>
        <th scope="col">Birthday</th>
        <th scope="col">Address</th>
        <th scope="col">Email</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
        @foreach ($customers as $customer)
        @php
            $hinhpath="assets/img/".$customer->avatar;
        @endphp
        <tr>
            <th scope="row">{{$customer->id}}</th>
            <td>{{$customer->fullname}}</td>
            <td>
              <img src="{{route($hinhpath)}}" alt="" width="150px" height="150px">
            </td>
            <td>{{$customer->birthday}}</td>
            <td>{{$customer->address}}</td>
            <td>{{$customer->email}}</td>
            <td>
                <a href="{{ route("customers/detail_customers/$customer->id") }}"><input type="button" value="Sửa" class="submit-btn"></a>
                <a href="{{ route("customers/detail_customers/$customer->id") }}"><input type="button" value="Xóa" class="submit-btn"></a>
            </td>
          </tr>
        @endforeach
    </tbody>
  </table>
@endsection