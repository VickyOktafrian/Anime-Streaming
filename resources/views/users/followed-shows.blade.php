@extends('layouts.app')

@section('content')

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option" style="margin-top:-25px; background-color: #0b0c2a;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                        <span>Your Followed Shows</span>  <!-- Fixed this to show category name -->
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
                                            <h4>Your Followed Shows</h4>  <!-- Fixed this to show category name -->
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <div class="row">
                            @foreach ($followedShows as $item)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item border border-white">
                                        <div class="product__item__pic set-bg" data-setbg="{{ asset('assets/img/popular/'.$item->show_image) }}">
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                <li>Active</li>
                                                {{-- <li>{{ $item->type }}</li> --}}
                                            </ul>
                                            <h5><a href="{{ route('anime.details', $item->show_id) }}">{{ $item->show_name }}</a></h5>
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
