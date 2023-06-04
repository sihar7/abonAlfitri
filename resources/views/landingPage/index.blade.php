@extends('layouts.landingPage.master')
@push('title')
    Abon Alfitri | Beranda
@endpush

@push('customcss')
    
@endpush

@section('content-main')
    <div class="axil-main-slider-area main-slider-style-1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-sm-6">
                        <div class="main-slider-content">
                            <div class="slider-content-activation-one">
                                <div class="single-slide slick-slide" data-sal="slide-up" data-sal-delay="400" data-sal-duration="800">
                                    <span class="subtitle"><i class="fas fa-fire"></i> Promo Terbaik Di Minggu Ini</span>
                                    <h3 class="title">Abon 100 Gram</h3>
                                    <div class="slide-action">
                                        <div class="shop-btn">
                                            <a href="{{ url('/shop') }}" class="axil-btn btn-bg-white"><i class="fal fa-shopping-cart"></i>Beli Sekarang</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-slide slick-slide">
                                    <span class="subtitle"><i class="fas fa-fire"></i> Promo Terbaik Di Minggu Ini</span>
                                    <h1 class="title">Smart Digital Watch</h1>
                                    <div class="slide-action">
                                        <div class="shop-btn">
                                            <a href="{{ url('/shop') }}" class="axil-btn btn-bg-white"><i class="fal fa-shopping-cart"></i>Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-slide slick-slide">
                                    <span class="subtitle"><i class="fas fa-fire"></i> Promo Terbaik Di Minggu Ini</span>
                                    <h1 class="title">Roco Wireless Headphone</h1>
                                    <div class="slide-action">
                                        <div class="shop-btn">
                                            <a href="{{ url('/shop') }}" class="axil-btn btn-bg-white"><i class="fal fa-shopping-cart"></i>Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-6">
                        <div class="main-slider-large-thumb">
                            <div class="slider-thumb-activation-one axil-slick-dots">
                                <div class="single-slide slick-slide" data-sal="slide-up" data-sal-delay="600" data-sal-duration="1500">
                                    <img src="{{ asset('product/') }}" alt="Product">
                                        {{-- <div class="product-price">
                                            <span class="text">From</span>
                                            <span class="price-amount">Rp. 50.000</span>
                                        </div> --}}
                                </div>
                                <div class="single-slide slick-slide" data-sal="slide-up" data-sal-delay="600" data-sal-duration="1500">
                                    <img src="{{ asset('product/') }}" alt="Product">
                                    {{-- <div class="product-price">
                                        <span class="text">From</span>
                                        <span class="price-amount">Rp. 20.000</span>
                                    </div> --}}
                                </div>
                                <div class="single-slide slick-slide">
                                    <img src="{{ asset('product/') }}" alt="Product">
                                    {{-- <div class="product-price">
                                        <span class="text">From</span>
                                        <span class="price-amount">Rp. 7.000</span>
                                    </div> --}}
                                </div>
                                {{--  <div class="single-slide slick-slide">
                                    <img src="{{ asset('assets/images/product/product-39.png')}}" alt="Product">
                                    <div class="product-price">
                                        <span class="text">From</span>
                                        <span class="price-amount">$49.00</span>
                                    </div>
                                </div>  --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="shape-group">
               
            </ul>
        </div>
        <!-- Start Expolre Product Area  -->
        <div class="axil-product-area bg-color-white axil-section-gap">
            <div class="container">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-primary"> <i class="far fa-shopping-basket"></i> Products</span>
                    <h2 class="title">Products</h2>
                </div>
                <div class="explore-product-activation slick-layout-wrapper slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">
                    <!-- End .slick-single-layout -->
                    <div class="slick-single-layout">
                        <div class="row row--15">
                            @foreach ($product as $item)
                            <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb--30">
                                <div class="axil-product product-style-one">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <img src="{{ asset('product/'. $item->image)}}" alt="Product Images">
                                        </a>
                                        <div class="product-hover-action">
                                            <ul class="cart-action">
                                                    <li class="quickview"><a href="#" data-bs-toggle="modal" data-bs-target="#quick-view-modal-{{ $item->id }}"><i class="far fa-eye"></i></a></li>
                                                    {{-- <li class="select-option"><a href="single-product.html">Select Option</a></li> --}}
                                                    {{-- <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a></li> --}}
                                                </ul>
                                            </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="inner">
                                            <h5 class="title"><a href="single-product.html">{{ $item->name }}</a></h5>
                                            <div class="product-price-variant">
                                                <span class="price current-price">{{ "Rp " . number_format($item->priceDisc, 0, ",", ".") }}</span>
                                                <span class="price old-price">{{ "Rp" . number_format($item->price, 0, ",", ".") }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- End .slick-single-layout -->
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center mt--20 mt_sm--0">
                        <a href="{{ url('/shop') }}" class="axil-btn btn-bg-lighter btn-load-more">View All Products</a>
                    </div>
                </div>

            </div>
        </div>
        <!-- End Expolre Product Area  -->
        
@endsection

@push('customjs')
    
@endpush