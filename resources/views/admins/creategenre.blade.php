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
          <h5 class="card-title mb-5 d-inline">Create Genres</h5>
      <form method="POST" action="{{ route('genre.store') }}" enctype="multipart/form-data">
        @csrf
            <div class="form-outline mb-4 mt-4">
                @if($errors->has('name'))
                <p class="alert alert-danger">{{ $errors->first('name') }}</p>
            @endif
              <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
             
            </div>
          
          

  
            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

      
          </form>

        </div>
      </div>
    </div>
  </div>

@endsection