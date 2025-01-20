@extends('layouts.app')

@section('content')

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option" style="background-color: #0b0c2a ; margin-top: -25px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="./categories.html">Categories</a>
                        <a href="#">{{ $show->type }}</a>
                        <span>{{ $show->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
    <section class="anime-details spad" style="background-color: #0b0c2a">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="anime__video__player">
                        <video id="player" playsinline controls data-poster="{{ asset('assets/thumbnail/'.$episode->thumbnail) }}">
                            <source src="{{ asset('assets/videos/'.$episode->video) }}" type="video/mp4" />
                            <!-- Captions are optional -->
                            <track kind="captions" label="English captions" src="#" srclang="en" default />
                        </video>
                    </div>
                    <div class="anime__details__episodes">
                        <div class="section-title">
                            <h5>List Name</h5>
                        </div>
                        @foreach ($episodes as $item)
                            
                        <a href="{{ route('anime.watch',['show_id'=>$show->id,'episode_name' => $item->episode_name]) }}">{{ $item->episode_name }}</a>
                        @endforeach
                      
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="anime__details__review">
                        <div class="section-title">
                            <h5>Reviews</h5>
                        </div>
                        @foreach ($comments as $item)
                            
                        <div class="anime__review__item">
                            <div class="anime__review__item__pic">
                                <img src="{{ asset('assets/img/anime/'. $item->image) }}" alt="">
                            </div>
                            <div class="anime__review__item__text">
                                <h6>{{ $item->user_name }} - <span>{{ $item->updated_at }}</span></h6>
                                <p>{{$item->comment}}</p>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                    <div class="anime__details__form">
                        <div class="section-title">
                            <h5>Your Comment</h5>
                        </div>
                        <form method="post" action="{{ route('anime.insert.comments', $show->id)  }}">
                            @csrf
                            <textarea name="comment" placeholder="Your Comment"></textarea>
                            <button type="submit"><i class="fa fa-location-arrow"></i> Review</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Anime Section End -->

@endsection