@extends('layouts.admin.master')
@push('title')
Admin Abon Alfitri | Beranda
@endpush

@push('css')

<link href="{{ asset('admin/') }}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="{{ asset('alert/css/sweetalert2.css')}} " rel="stylesheet" />
@endpush

@push('breadcrumb')
ORDER
@endpush

@section('content')
<div class="row">
    <!-- Column  -->
    <div class="col-lg-12">
        <div class="card dz-card">
            <div class="card-header flex-wrap border-0" id="default-tab">
                <h4 class="card-title">Detail Order</h4>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="DefaultTab" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card-body pt-0">
                        <!-- Nav tabs -->
                        <div class="default-tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home"><i
                                            class="la la-table me-2"></i>Detail Order</a>
                                </li>
                                @if ($orderGet->payment_status == 2)
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#profile"><i
                                                class="la la-book me-2"></i>Resi</a>
                                    </li>
                                @endif
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="home" role="tabpanel">
                                    <div class="pt-4">
                                        <div class="table-responsive">
                                            <table class="table table-sm mb-0">
                                                <thead class="text-white bg-primary">
                                                    <tr>
                                                        <th class="align-middle">Order</th>
                                                        <th class="align-middle">Produk</th>
                                                        <th class="align-middle">Harga Satuan</th>
                                                        <th class="align-middle">Qty</th>
                                                        <th class="align-middle">Jasa Pengiriman</th>                                                       
                                                        <th class="align-middle pe-7">Tanggal</th>
                                                        <th class="align-middle" style="min-width: 12.5rem;">Dikirim ke</th>
                                                        <th class="align-middle text-end">No. Telp</th>
                                                        <th class="align-middle text-end">Ongkos Kirim</th>
                                                        <th class="align-middle text-end">Total Harga</th>
                                                        <th class="align-middle text-end">Notes</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody id="orders">
                                                    
                                                    @foreach ($order as $orders)
                            
                                                    <tr class="btn-reveal-trigger">
                                                        <td class="py-2">
                                                            <a href="#">
                                                                <span class="order">{{ $orders->order_number }}</span></a> by <span class="">{{ $orders->name_user }}</span><br><a href="{{ $orders->email_user }}">{{ $orders->email_user }}</a></td>
                                                        <td class="py-2 text-end">{{ $orders->name_product }}
                                                        </td>
                                                        <td class="py-2 text-end">{{ "Rp " . number_format($orders->price_products, 2, ',', '.') }}
                                                        </td>
                                                        
                                                        <td class="py-2 text-end">{{ $orders->quantity_item }}
                                                        </td>
                                                        <td class="py-2 text-end">{{ $orders->expedisi }}
                                                        </td>
                                                       <td class="py-2">{{ \Carbon\Carbon::parse($orders->created_at)->isoFormat('dddd, D MMMM Y') }}</td>
                                                        <td class="py-2">
                                                            @if (!empty($orders->address2))
                                                                {{ $orders->name_province }}, {{ $orders->name_regencies }}, {{ $orders->address2 }}
                                                            @else 
                                                            {{ $orders->name_province }}, {{ $orders->name_regencies }}, {{ $orders->address }}
                                                            @endif
                                                        </td>
                                                        <td class="py-2 text-end">{{ $orders->phone_number }}
                                                        </td>
                                                        <td class="py-2 text-end font-w600">{{ "Rp " . number_format($orders->ongkir, 2, ',', '.') }}
                                                        </td>
                                                        <td class="py-2 text-end font-w600">{{ "Rp " . number_format($orders->grand_total, 2, ',', '.') }}
                                                        </td>
                                                        <td class="py-2 text-end font-w600">{{ $orders->notes }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile">
                                    <div class="pt-4">
                                        <div class="basic-form">
                                            
                                            @if ($orderGet->payment_status == 2)
                                            <form class="form-valide-with-icon needs-validation"
                                                enctype="multipart/form-data" novalidate id="data-master">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{ $orderGet->id }}">
                                                <div class="mb-3">
                                                    <label class="text-label form-label"
                                                        for="validationCustomUsername">Tracking Number</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"> <i class="fa fa-list-alt"></i>
                                                        </span>
                                                        <input type="text" name="tracking_number" class="form-control"
                                                            id="validationCustomUsername"
                                                            placeholder="Enter a tracking number.." required>
                                                        <div class="invalid-feedback">
                                                            Please Enter a Product Name.
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <button type="submit" class="btn me-2 btn-primary"
                                                    id="simpan-data">Kirim</button>
                                            </form>
                                            @else
                                            {{ $orderGet->tracking_number }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<!-- Datatable -->
<script src="{{ asset('admin/') }}/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('admin/') }}/js/plugins-init/datatables.init.js"></script>
<script src="{{ asset('alert/js/sweetalert.js') }}"></script>
@endpush
