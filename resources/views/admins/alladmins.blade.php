@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Admins</h5>
         <a  href="{{ route('admins.create') }}" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">username</th>
                <th scope="col">email</th>
              </tr>
            </thead>
            <tbody>
                @foreach ( $admins as $item)
                
                
                <tr>
                  <th scope="row">{{ $item->id }}</th>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->email }}</td>
                @endforeach
              
               
              </tr>
            </tbody>
          </table> 
        </div>
      </div>
    </div>
  </div>

@endsection