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
                        <li class="axil-breadcrumb-item active" aria-current="page">About Us</li>
                    </ul>
                    <h1 class="title">About Our Store</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-4">
                <div class="inner">
                    <div class="bradcrumb-thumb">
                        <img src="assets/images/product/product-45.png" alt="Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb Area  -->

<!-- Start About Area  -->
<div class="axil-about-area about-style-1 axil-section-gap ">
    <div class="container">
        <div class="row align-items-center">
        @foreach ($about_us as $item)
            <div class="col-xl-4 col-lg-6">
                <div class="about-thumbnail">
                    <div class="thumbnail">
                        <img src="{{ asset('about/'. $item->image)}}" alt="About Us">
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-6">
                <div class="about-content content-right">
                    <span class="title-highlighter highlighter-primary2"> <i class="far fa-shopping-basket"></i>About Store</span>
                    <h3 class="title">{{ $item->name }}</h3>
                    <div class="row">
                        <div class="col-xl-12">
                            <p>{{ $item->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- End About Area  -->

<!-- Start About Area  -->
<div class="about-info-area">
    <div class="container">
        <div class="row row--20">
            <div class="col-lg-4">
                <div class="about-info-box">
                    <div class="thumb">
                        <img src="assets/images/about/shape-01.png" alt="Shape">
                    </div>
                    <div class="content">
                        <h6 class="title">40,000+ Happy Customer</h6>
                        <p>Empower your sales teams with industry
                            tailored solutions that support.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="about-info-box">
                    <div class="thumb">
                        <img src="assets/images/about/shape-02.png" alt="Shape">
                    </div>
                    <div class="content">
                        <h6 class="title">16 Years of Experiences</h6>
                        <p>Empower your sales teams with industry
                            tailored solutions that support.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="about-info-box">
                    <div class="thumb">
                        <img src="assets/images/about/shape-03.png" alt="Shape">
                    </div>
                    <div class="content">
                        <h6 class="title">12 Awards Won</h6>
                        <p>Empower your sales teams with industry
                            tailored solutions that support.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End About Area  -->
<br>
<br>
<br>
@endsection

@push('customjs')

@endpush
