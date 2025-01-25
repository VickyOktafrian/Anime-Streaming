@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Genres</h5>
          <a  href="{{ route('genre.create') }}" class="btn btn-primary mb-4 text-center float-right">Create Genres</a>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
                @foreach($genre as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th> 
                    <td>{{ $item->name }}</td>
                    <td>
                        <a href="{{ route('genre.delete', $item->id) }}" class="btn btn-danger text-center">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            
             
            </tbody>
          </table> 
        </div>
      </div>
    </div>
  </div>

  @endsection