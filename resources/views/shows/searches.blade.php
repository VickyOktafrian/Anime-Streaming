@extends('layouts.app')

@section('content')

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option" style="margin-top:-25px; background-color: #0b0c2a;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                        <span>Searches</span>  <!-- Fixed this to show category name -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Section Begin -->
    <section class="product-page spad" style="background-color: #0b0c2a;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-6">
                                        <div class="section-title">
                                            <h4>Searches</h4> 
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <div class="row">
                            @foreach ($searches as $item)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item border border-white">
                                        <div class="product__item__pic set-bg" data-setbg="{{ asset('assets/img/popular/'.$item->image) }}">
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                <li>Active</li>
                                                <li>{{ $item->type }}</li>
                                            </ul>
                                            <h5><a href="{{ route('anime.details', $item->id) }}">{{ $item->name }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

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
                                        <h5><a href="{{ route('anime.details', $foryou->id) }}">{{ $foryou->name }}</a></h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Product Section End -->

@endsection
