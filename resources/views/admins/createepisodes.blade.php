@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-5 d-inline">Create Episodes</h5>
          <form method="POST" action="{{ route('episodes.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-outline mb-4 mt-4">
              <label>Episode Name</label>
              <input type="text" name="episode_name" id="form2Example1" class="form-control" placeholder="Name" required />
            </div>

            <div class="form-outline mb-4 mt-4">
                <label>Thumbnail</label>
                <input type="file" name="thumbnail" id="form2Example1" class="form-control"/>
            </div>

            <div class="form-outline mb-4 mt-4">
                <label>Video</label>
                <input type="file" name="video" id="form2Example1" class="form-control">
            </div>

            <div class="form-outline mb-4 mt-4">
                <label>Shows</label>
                <select name="show" class="form-select form-control" required>
                    <option value="" disabled selected>Choose Shows</option>
                    @foreach ($show as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            

            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary mb-4 text-center">Create</button>
          </form>

        </div>
      </div>
    </div>
</div>

@endsection
