@extends('layouts.app')

@section('content')

<!-- Hero Section Begin -->
<section class="hero"  style="background-color: #0b0c2a; margin-top: -25px;">
    <div class="container">
        <div class="hero__slider owl-carousel border border-white">
            @foreach ($shows as $show)
                <div class="hero__items set-bg" data-setbg="{{ asset('assets/img/hero/' . $show->image) }}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div class="label">{{ $show->genre }}</div>
                                <h2>{{ $show->name }}</h2>
                                <p>{{ Str::limit($show->description, 20) }}</p>
                                <a href="{{route('anime.details', $show->id) }}"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Product Section Begin -->
<section class="product spad"  style="background-color: #0b0c2a; ">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="trending__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Trending Now</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="btn__all">
                                <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="row">
                            @foreach ($trendingShow as $trending)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item border border-white">
                                        <div class="product__item__pic set-bg " data-setbg="{{ asset('assets/img/trending/' . $trending->image) }}">
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                <li>Active</li>
                                                <li>{{ $trending->type }}</li>
                                            </ul>
                                            <h5><a href="{{route('anime.details', $trending->id) }}">{{ $trending->name }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Now, let's make the "For You" sidebar move to the right of the trending section -->
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="product__sidebar">
                    <div class="product__sidebar__comment">
                        <div class="section-title">
                            <h5>For You</h5>
                        </div>
                        @foreach ($foryouShow as $foryou)
                            <div class="product__sidebar__comment__item border border-white">
                                <div class="product__sidebar__comment__item__pic">
                                    <img width="70" height="100" src="{{ asset('assets/img/sidebar/' . $foryou->image) }}" alt="">
                                </div>
                                <div class="product__sidebar__comment__item__text">
                                    <ul>
                                        <li>Active</li>
                                        <li>{{ $foryou->type }}</li>
                                    </ul>
                                    <h5><a href="{{route('anime.details', $foryou->id) }}">{{ $foryou->name }}</a></h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        
        <!-- Let’s proceed with the rest of the sections. Gotta keep it moving! -->
        <div class="popular__product">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="section-title">
                        <h4>Adventure Shows</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="btn__all">
                        <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($adventureShow as $adventure)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item border border-white">
                            <div class="product__item__pic set-bg" data-setbg="{{ asset('assets/img/popular/' . $adventure->image) }}">
                            </div>
                            <div class="product__item__text">
                                <ul>
                                    <li>Active</li>
                                    <li>{{ $adventure->type }}</li>
                                </ul>
                                <h5><a href="{{route('anime.details', $adventure->id) }}">{{ $adventure->name }}</a></h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="recent__product">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="section-title">
                        <h4>Recently Added Shows</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="btn__all">
                        <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($recentShow as $recent)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item border border-white">
                            <div class="product__item__pic set-bg" data-setbg="{{ asset('assets/img/recent/' . $recent->image) }}">
                            </div>
                            <div class="product__item__text">
                                <ul>
                                    <li>Active</li>
                                    <li>{{ $recent->type }}</li>
                                </ul>
                                <h5><a href="{{route('anime.details', $recent->id) }}">{{ $recent->name }}</a></h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="live__product">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="section-title">
                        <h4>Live Action</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="btn__all">
                        <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($liveShow as $live)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item border border-white">
                            <div class="product__item__pic set-bg" data-setbg="{{ asset('assets/img/live/' . $live->image) }}">
                            </div>
                            <div class="product__item__text">
                                <ul>
                                    <li>Active</li>
                                    <li>{{ $live->type }}</li>
                                </ul>
                                <h5><a href="{{route('anime.details', $live->id) }}">{{ $live->name }}</a></h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
<!-- Product Section End -->

@endsection
