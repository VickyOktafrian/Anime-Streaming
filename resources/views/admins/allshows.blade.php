@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
            <div class="container">
                @if(session()->has('delete'))
                <div class="alert alert-success">
                    {{ session()->get('delete') }}
                </div>
                @endif

            </div>
          <h5 class="card-title mb-4 d-inline">Shows</h5>
          <a  href="{{ route('shows.create') }}" class="btn btn-primary mb-4 text-center float-right">Create Shows</a>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">title</th>
                <th scope="col">image</th>
                <th scope="col">type</th>
                <th scope="col">date_aired</th>
                <th scope="col">status</th>
                <th scope="col">genre</th>
                <th scope="col">created_at</th>
                <th scope="col">delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach($shows as $item)
              <tr>
                <th scope="row">{{ $item->id }}</th>
                <td>{{ $item->name }}</td>
                <td><img width="60" height="60" src="{{ asset('assets/img/anime/'.  $item->image ) }}" class="border border-black" ></td>
                <td>{{ $item->type }} </td>
                <td>{{ $item->date_aired }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->genre }}</td>
                <td>{{ $item->created_at }}</td>
                 <td><a href="{{ route('shows.delete',$item->id) }}" class="btn btn-danger  text-center ">delete</a></td>

                </tr>
                @endforeach
              
            </tbody>
          </table> 
        </div>
      </div>
    </div>
  </div>

@endsection