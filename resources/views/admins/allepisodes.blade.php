@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Episodes</h5>
          <a  href="{{ route('episodes.create') }}" class="btn btn-primary mb-4 text-center float-right">Create Episodes</a>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">video</th>
                <th scope="col">thumbnail</th>
                <th scope="col">name</th>
                
                <th scope="col">delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($episode as $item )
                
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td><video class="border border-black" id="player" width="50" height="50" >
                        <source src="{{ asset('assets/videos/'.$item->video) }}" type="video/mp4" />
                        <!-- Captions are optional -->
                        <track kind="captions" label="English captions" src="#" srclang="en" default />
                    </video></td>
                    <td><img width="60" height="60" src="{{ asset('assets/img/thumbnails/'.  $item->thumbnail ) }}" class="border border-black" ></td>
                    <td>{{ $item->episode_name }}</td>
                    
                    <td><a href="{{ route('episodes.delete',$item->id) }}" class="btn btn-danger  text-center ">delete</a></td>
                </tr>
                @endforeach
            </tbody>
          </table> 
        </div>
      </div>
    </div>
  </div>

@endsection