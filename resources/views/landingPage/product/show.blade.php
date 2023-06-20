@extends('layouts.landingPage.master')
@push('title')
Abon Alfitri | Beranda
@endpush

@push('customcss')

@endpush


@section('content-main')
<!-- Start Breadcrumb Area  -->
<div class="axil-breadcrumb-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-8">
                <div class="inner">
                    <ul class="axil-breadcrumb">
                        <li class="axil-breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="separator"></li>
                        <li class="axil-breadcrumb-item active" aria-current="page">Product Details</li>
                    </ul>
                    <h1 class="title">Product Details</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-4">
                <div class="inner">
                    <div class="bradcrumb-thumb">
                        <img src="{{ asset('logo/logoAlfitri.png') }}" alt="Image" style="height:100px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb Area  -->
<div class="axil-single-product-area bg-color-white">
    <div class="single-product-thumb axil-section-gap pb--20 pb_sm--0">
        <div class="container">
            <div class="row row--25">
                <div class="col-lg-6 mb--40">
                    <div class="h-100">
                        <div class="position-sticky sticky-top">
                            <div class="row row--10">
                                <!-- End .col -->
                                <div class="col-6 mb--20">
                                    <div class="single-product-thumbnail axil-product thumbnail-grid">
                                        <div class="thumbnail">
                                            <img class="img-fluid" src="{{ asset('product/'. $productDetail->image)}}"
                                                alt="Product Images">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb--40">
                    <div class="h-100">

                        <form id="data-cart-add" enctype="multipart/form-data">
                            @csrf
                            <div class="position-sticky sticky-top">
                                <div class="single-product-content">
                                    <div class="inner">
                                        <h2 class="product-title">{{ $productDetail->name }}</h2>
                                        <span
                                            class="price-amount">{{ "Rp " . number_format($productDetail->priceDisc, 0, ",", ".")  }}
                                            - {{ "Rp " . number_format($productDetail->price, 0, ",", ".")  }}</span>

                                        <ul class="product-meta">
                                            @if ($productDetail->quantity > 0)
                                            <li><i class="fal fa-check"></i>In stock</li>
                                            @else
                                            <li><i class="fal fa-window-close"></i>Sold Out</li>
                                            @endif
                                        </ul>
                                        <p class="description">{!! html_entity_decode($productDetail->description) !!}
                                        </p>

                                        <!-- Start Product Action Wrapper  -->
                                        <div class="product-action-wrapper d-flex-center">
                                            <!-- Start Quentity Action  -->
                                            <div class="pro-qty mr--20"><input type="number" value="1" min="1"
                                                    name="quantity"></div>
                                            <!-- End Quentity Action  -->

                                            <input type="hidden" value="{{ $productDetail->id }}" name="id">
                                            <input type="hidden" value="{{ $productDetail->name }}" name="name">
                                            <input type="hidden" value="{{ $productDetail->priceDisc }}"
                                                name="priceDisc">
                                            <input type="hidden" value="{{ $productDetail->image }}" name="image">
                                            <!-- Start Product Action  -->
                                            <ul class="product-action d-flex-center mb--0">
                                                <li class="add-to-cart"><input type="submit" id="button_create_troli"
                                                        class="axil-btn btn-bg-primary" value="Tambahkan Keranjang">
                                                </li>
                                            </ul>
                                            <!-- End Product Action  -->

                                        </div>
                                        <!-- End Product Action Wrapper  -->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="axil-product-area bg-color-white axil-section-gap pb--50 pb_sm--30">
                <div class="container">
                    <div class="section-title-wrapper">
                        <span class="title-highlighter highlighter-primary"><i class="far fa-shopping-basket"></i> Your
                            Recently</span>
                        <h2 class="title">RELATED PRODUCTS</h2>
                    </div>
                    <div class="recent-product-activation slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">
                        @foreach ($product as $item)
                        @if ($productDetail->id != $item->id)
                        <form id="data-cart-add-detail" enctype="multipart/form-data">
                            @csrf
                            <div class="slick-single-layout">
                                <div class="axil-product">
                                    <div class="thumbnail">
                                        <a href="{{ url('product/getProduct/details', base64_encode($item->id)) }}">
                                            <img src="{{ asset('product/'. $item->image)}}" alt="Product Images">
                                            
                                        </a>
                                        <div class="product-hover-action">
                                            <ul class="cart-action">
                                                <li class="select-option"><a href="#" data-id="{{ base64_encode($item->id) }}" id="button_create_troli_detail">Add To Cart</a></li>
                                                <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#quick-view-modal"
                                                        data-id="{{ base64_encode($item->id) }}" id="button_add"><i
                                                            class="far fa-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="inner">
                                            <h5 class="title"><a
                                                    href="{{ url('product/getProduct/details', base64_encode($item->id)) }}">{{ $item->name }}</a>
                                            </h5>
                                            <div class="product-price-variant">
                                                <span
                                                    class="price old-price">{{ "Rp " . number_format($item->price, 0, ",", ".")  }}</span>
                                                <span
                                                    class="price current-price">{{ "Rp " . number_format($item->priceDisc, 0, ",", ".")  }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                        @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- End .slick-single-layout -->

@endsection

@push('customjs')

@endpush
