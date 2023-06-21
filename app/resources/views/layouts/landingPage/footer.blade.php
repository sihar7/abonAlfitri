<!-- Start Footer Area  -->
<footer class="axil-footer-area footer-style-2">
    <!-- Start Footer Top Area  -->
    <div class="footer-top separator-top">
        <div class="container">
            <div class="row">
                <!-- Start Single Widget  -->
                <div class="col-lg-3 col-sm-6">
                    @foreach ($about_us as $item)
                        
                    <div class="axil-footer-widget">
                        <h2 class="widget-title" style="color: white;">Tentang Kami</h2>
                        <div class="logo mb--30">
                            <a href="{{ url('/') }}">
                                <img class="light-logo" src="{{ asset('logo/logoAlfitri.png')}}" alt="Logo Images" style="height:100px;">
                            </a>
                        </div>
                        <p>{{ Illuminate\Support\Str::limit(html_entity_decode($item->description), 150) }}</p>
                            
                        <div class="inner">
                            <p>{!! html_entity_decode($item->address) !!}
                            </p>
                            <ul class="support-list-item">
                                <li><a href="mailto:{{ $item->email }}"><i class="fal fa-envelope-open"></i>
                                        {{ $item->email }}</a></li>
                                <li><a href="tel:{{ $item->phone_number }}"><i class="fal fa-phone-alt"></i> {{ $item->phone_number }}</a>
                                </li>
                                <!-- <li><i class="fal fa-map-marker-alt"></i> 685 Market Street,  <br> Las Vegas, LA 95820, <br> United States.</li> -->
                            </ul>
                        </div>

                    </div>
                    @endforeach
                </div>
                <!-- End Single Widget  -->
                <!-- Start Single Widget  -->
                <div class="col-lg-3 col-sm-6">
                    <div class="axil-footer-widget">
                        <h5 class="widget-title" style="color: white;">Mendukung</h5>
                        <div class="inner">
                            <ul>
                                <li><a href="{{ url('/login') }}">Login / Register</a></li>
                                <li><a href="{{ url('/cart') }}">Cart</a></li>
                                <li><a href="{{ url('/shop') }}">Shop</a></li>
                                <li><a href="{{ url('/story') }}">About</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Single Widget  -->
                <!-- Start Single Widget  -->
                <div class="col-lg-3 col-sm-6">
                    <div class="axil-footer-widget">
                        <h5 class="widget-title" style="color: white;">Menu</h5>
                        <div class="inner">
                            <ul>
                                <li><a href="{{ url('/login') }}">Login / Register</a></li>
                                <li><a href="{{ url('/cart') }}">Cart</a></li>
                                <li><a href="{{ url('/shop') }}">Shop</a></li>
                                <li><a href="{{ url('/story') }}">About</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Single Widget  -->
                <!-- Start Single Widget  -->
                <div class="col-lg-3 col-sm-6">
                    <div class="axil-footer-widget">
                        <h5 class="widget-title" style="color: white;">Help</h5>
                        <div class="inner">
                            <ul>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Terms Of Use</a></li>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Single Widget  -->

            </div>
        </div>
    </div>
    <!-- End Footer Top Area  -->
    <!-- Start Copyright Area  -->
    <div class="copyright-area copyright-default separator-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="copyright-left d-flex flex-wrap justify-content-center">
                        <ul class="quick-link">
                            <li style="color: white;">© 2023. All rights reserved by <a target="_blank" href="#" style="color: white;">Abon Alfitri</a>.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Copyright Area  -->
</footer>
<!-- End Footer Area  -->
