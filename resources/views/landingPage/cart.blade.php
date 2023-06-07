@extends('layouts.landingPage.master')
@push('title')
Abon Alfitri | Cart
@endpush

@push('customcss')
@endpush

@section('content-main')
<!-- Start Cart Area  -->
<div class="axil-product-cart-area axil-section-gap">
    <div class="container">
        <div class="axil-product-cart-wrap">
            <form method="post" id="data-master">
                @csrf
                <div class="product-table-heading">
                    <h4 class="title">Your Cart</h4>
                    <a href="#" class="cart-clear">Clear Shoping Cart</a>
                </div>
                <div class="table-responsive">
                    <table class="table axil-product-table axil-cart-table mb--40" id="tableCart">
                        <thead>
                            <tr>
                                <th scope="col" class="product-remove"></th>
                                <th scope="col" class="product-thumbnail">Product</th>
                                <th scope="col" class="product-title"></th>
                                <th scope="col" class="product-price">Price</th>
                                <th scope="col" class="product-quantity">Quantity</th>
                                <th scope="col" class="product-subtotal">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach($cart as $item)
                            @php $total += $item['product']->priceDisc * $item['quantity']; @endphp
                            <tr>
                                <td class="product-remove"><a
                                        href="#"
                                        class="remove-wishlist" data-id="{{ base64_encode($item['product']->id) }}"  id="buton_delete"><i class="fal fa-times"></i></a></td>
                                <td class="product-thumbnail"><img src="{{ asset('product/'. $item['product']->image)}}"
                                        alt="Digital Product"></td>
                                <td class="product-title"><a href="#">{{$item['product']->name}}</a>
                                </td>
                                <td class="product-price" data-title="Price">
                                    {{ "Rp " . number_format($item['product']->priceDisc, 0, ",", ".") }}</td>
                                <td class="product-quantity" data-title="Qty">
                                    <div class="pro-qty">
                                        <input type="number" class="quantity-input" min="1"
                                            value="{{$item['quantity']}}" name="quantity[]">
                                    </div>
                                </td>
                                <td class="product-subtotal" data-title="Subtotal"><span
                                        class="currency-symbol">{{ "Rp. " . number_format($item['product']->priceDisc * $item['quantity'], 0, ",", ".") }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="cart-update-btn-area">
                    {{-- <div class="input-group product-cupon">
                        <input placeholder="Enter coupon code" type="text">
                        <div class="product-cupon-btn">
                            <button type="submit" class="axil-btn btn-outline">Apply</button>
                        </div>
                    </div> --}}
                    <div class="update-btn">
                        <input type="submit" id="updateCart" class="axil-btn btn-outline" value="Update Cart">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-5 col-lg-7 offset-xl-7 offset-lg-5">
                        <div class="axil-order-summery mt--80">
                            <h5 class="title mb--20">Order Summary</h5>
                            <div class="summery-table-wrap">
                                <table class="table summery-table mb--30">
                                    <tbody>
                                        <tr class="order-subtotal">
                                            <td>Subtotal</td>
                                            <td>{{ "Rp. " . number_format($total, 0, ",", ".") }}</td>
                                        </tr>
                                        <tr class="order-total">
                                            <td>Total</td>
                                            <td class="order-total-amount">{{ "Rp. " . number_format($total, 0, ",", ".") }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="checkout.html" class="axil-btn btn-bg-primary checkout-btn">Process to Checkout</a>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- End Cart Area  -->


@endsection

@push('customjs')
<script>
    
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });



        $('#data-master').on('submit', function (e) {
            e.preventDefault();
            $('#updateCart').val("Update...");
            $('#updateCart').attr('disabled', true);
            let data = $("#data-master").serialize();
            let datax = new FormData(this);
            // console.log(data[0].jenis_menu);
            console.log(data);
            $.ajax({
                type: "post",
                url: "{{url('/cart/update')}}",
                data: datax,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#jenis_menuHelp").html("");
                    $('#simpan-data').val("Update Cart");
                    $('#simpan-data').removeAttr('disabled');
                    if (response.status == 1) {
                        $('#updateCart').val(`Update Cart`);
                        $('#updateCart').removeAttr('disabled');
                        window.location.reload();
                    }
                },
                error: function (e) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Gagal !'
                    });
                    $('#updateCart').val(`Update Cart`);
                    $('#updateCart').removeAttr('disabled');

                }
            });
        });

        $(this).on('click', '#buton_delete', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                title: 'Peringatan',
                text: "Apakah anda yakin akan menghapus pesanan ?",
                icon: 'warning',
                showCancelButton: true,
                buttonsStyling: true,
                confirmButtonClass: 'btn btn-danger btn-lg mr-2',
                cancelButtonClass: 'btn btn-primary btn-lg',
                confirmButtonText: 'Hapus <i class="fas fa-trash"></i>',
                cancelButtonText: 'Batal <i class="fas fa-close"> </i>'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        url: `{{url('cart/remove')}}/${id}`,
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        dataType: "json",
                        success: function (response) {         
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Pesanan Berhasil Dihapus !',
                            });
                            
                            window.location.reload();
                        },
                        error: function () {
                            Toast.fire({
                                icon: 'error',
                                title: 'Gagal Menghapus Pesanan!'
                            })
                        }
                    });
                }
            })
        });
    });
</script>
@endpush
