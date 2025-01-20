@extends('layouts.app')

@section('content')

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option" style="background-color: #0b0c2a; margin-top: -25px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="./categories.html">Categories</a>
                        <span>{{ $show->type }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
    <section class="anime-details spad" style="background-color: #0b0c2a">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" data-setbg="{{ asset('assets/img/anime/'.$show->image) }}">
                            <div class="comment"><i class="fa fa-comments"></i> {{ $totalComments }}</div>
                            <div class="view"><i class="fa fa-eye"></i> {{ $views }}</div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{ $show->name }}</h3>
                            </div>
                           
                            <p>{{ $show->description }}</p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Type:</span> {{ $show->type }}</li>
                                            <li><span>Studios:</span>{{$show->studios}}</li>
                                            <li><span>Date aired:</span>{{ $show->date_aired}}</li>
                                            <li><span>Status:</span> {{ $show->status }}</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Genre:</span> {{ $show->genre }}</li>

                                            <li><span>Duration:</span> {{ $show->duration }} min/ep</li>
                                            <li><span>Quality:</span> {{ $show->quality }}</li>
                                            <li><span>Views:</span> {{ $views }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                @if ($validateFollowing >0)
                                <button  disabled class="follow-btn"><i class="fa fa-heart-o"></i> Already Followed</button>

                                
                                @else
                                <form action="{{ route('anime.follow',$show->id) }}" method="post">
                                @csrf
                                <button  type='submit' class="follow-btn"><i class="fa fa-heart-o"></i> Follow</button>
                            </form>
                            @endif
                            <form action="{{ route('anime.view',$show->id) }}" method="post">
                                @csrf
                                <a  class="watch-btn" href="{{ route('anime.watch', ['show_id' => $show->id, 'episode_name' => $firstEpisode->episode_name]) }}"><span>Watch Now</span> <i
                                    class="fa fa-angle-right"></i></a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div class="anime__details__review">
                            <div class="section-title">
                                <h5>Reviews</h5>
                            </div>
                            @foreach ($comments as $item)
                                
                            <div class="anime__review__item">
                                <div class="anime__review__item__pic">
                                    <img src="{{ asset("assets/img/anime/".$item->image) }}" alt="">
                                </div>
                                <div class="anime__review__item__text">
                                    <h6>{{ $item->user_name }} - <span>{{ $item->updated_at }}</span></h6>
                                    <p>{{ $item->comment }}</p>
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
                    <div class="col-lg-4 col-md-4">
                        <div class="anime__details__sidebar">
                            <div class="section-title">
                                <h5>you might like...</h5>
                            </div>
                            @foreach ($randomShows as $show)
                                
                            <div class="product__sidebar__view__item set-bg border border-white" data-setbg="{{ asset('assets/img/sidebar/'.$show->image) }}">
                                <div class="ep">18 / ?</div>
                                <div class="view"><i class="fa fa-eye"></i> {{ $views }}</div>
                                <h5><a href="{{ route('anime.details',$show->id) }}">{{ $show->name }}</a></h5>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Anime Section End -->

@endsection