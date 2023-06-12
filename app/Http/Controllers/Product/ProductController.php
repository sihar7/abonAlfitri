<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
class ProductController extends Controller
{
    

    function search(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $products= Product::where('name','LIKE','%'.$request->search."%")->get();
            
            if($products)
            {
                if($products->count() > 1)
                {
                    $output .= '
                    <div class="search-result-header">
                        <h6 class="title">'.$products->count().' Hasil Ditemukan</h6>                    
                        <a href="'.url('/cart').'" class="view-all">Lihat semua</a>
                    </div>';
                    foreach ($products as $key => $product) {
                        $output .= '
                        <div class="psearch-results">
                            <div class="axil-product-list">
                                <div class="thumbnail">
                                    <a href="#">
                                        <img src='.asset('product/'. $product->image).'
                                            alt="Yantiti Leather Bags" style="height:100px;">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h6 class="product-title"><a href="#">'.$product->name.'</a></h6>
                                    <div class="product-price-variant">
                                        <span class="price current-price">'."Rp " . number_format($product->priceDisc, 0, ",", ".") .'</span>
                                        <span class="price old-price">'."Rp" . number_format($product->price, 0, ",", ".").'</span>                    
                                            <input type="hidden" value="'.$product->id.'" name="id">
                                            <input type="hidden" value="'.$product->name.'" name="name">
                                            <input type="hidden" value="'.$product->priceDisc.'" name="priceDisc">
                                            <input type="hidden" value="'.$product->image.'"  name="image">
                                            <input type="hidden" value="1"  name="quantity">
                                            
                                    </div>';

                                    if(Auth::check())
                                    {
                                        $output .='
                                        <div class="product-cart">
                                            <button type="submit" id="buttonSearchAdd"><i class="fal fa-shopping-cart"></i></button>
                                        </div>';
                                    }

                                    $output .= '</div>
                                    </div>
                                </div>';
                                
                    }
                    return Response($output);
                } else {
                    $output .= '
                    <div class="search-result-header">
                        <h6 class="title">'.$products->count().' Hasil Tidak Ditemukan</h6>
                    </div>';
                    return Response($output);
                }
                
            }
        }
    }

    function getData($id)
    {
        $modal = Product::whereId(base64_decode($id))->first();
        
        $output="";
        $output .= '
        <div class="row">
            <div class="col-lg-7 mb--40">
                <div class="row">
                    <div class="col-lg-10 order-lg-2">
                        <div
                            class="single-product-thumbnail product-large-thumbnail axil-product thumbnail-badge zoom-gallery">
                            <div class="thumbnail thumbnail slick-slide slick-current slick-active">
                                <img src="'.asset('product/'. $modal->image).'"
                                    alt="Product Images" id="imageProduct">
                                <div class="product-quick-view position-view">
                                    <a href="'.asset('product/'. $modal->image).'"
                                        class="popup-zoom" id="aImageProduct">
                                        <i class="far fa-search-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 order-lg-1">
                        <div class="product-small-thumb small-thumb-wrapper slick-slider slick-vertical ">
                            <div class="small-thumb-img slick-slide slick-current slick-active">
                                <img src="'.asset('product/'. $modal->image).'" alt="thumb image" id="imageThumb">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mb--40">
                <div class="single-product-content">
                    <div class="inner">
                        <h3 class="product-title" id="productTitle">'.$modal->name.'</h3>
                        <span
                            class="price-amount" id="priceProduct">'."Rp " . number_format($modal->priceDisc, 0, ",", ".") .' - '."Rp " . number_format($modal->price, 0, ",", ".") .'</span>
                        <ul class="product-meta">
                            <li><i class="fal fa-check"></i>In stock</li>
                            <li><i class="fal fa-check"></i>Free delivery available</li>
                        </ul>
                        <p class="description" id="descriptionProduct">'.$modal->description.'</p>

                        <!-- Start Product Action Wrapper  -->
                        <div class="product-action-wrapper d-flex-center">
                            <!-- Start Quentity Action  -->
                            <div class="pro-qty" data-title="Qty">
                                <input type="number" min="1" value="1" class="quantity-input" name="quantity">
                            </div>

                            <input type="hidden" value="'.$modal->id.'" name="id">
                            <input type="hidden" value="'.$modal->name.'" name="name">
                            <input type="hidden" value="'.$modal->priceDisc.'" name="priceDisc">
                            <input type="hidden" value="'.$modal->image.'"  name="image">

                            <!-- Start Product Action  -->
                            <ul class="product-action d-flex-center mb--0">
                                <li class="add-to-cart">                                
                                    <input type="submit" id="createCart" class="axil-btn btn-bg-primary" value="Tambahkan Keranjang">
                                </li>
                            </ul>
                            <!-- End Product Action  -->

                        </div>
                        <!-- End Product Action Wrapper  -->
                    </div>
                </div>
            </div>
        </div>';
        
        return response()->json($output);
    }
    
}
