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
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm mb-0">
                    <thead class="text-white bg-primary">
                        <tr>
                            <th class="align-middle">Order</th>
                            <th class="align-middle">Produk</th>
                            <th class="align-middle">Harga Satuan</th>
                            <th class="align-middle">Qty</th>
                            <th class="align-middle pe-7">Tanggal</th>
                            <th class="align-middle" style="min-width: 12.5rem;">Dikirim ke</th>
                            <th class="align-middle text-end">No. Telp</th>
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
                           <td class="py-2">{{ \Carbon\Carbon::parse($orders->created_at)->isoFormat('dddd, D MMMM Y') }}</td>
                            <td class="py-2">
                                @if (!empty($orders->address2))
                                    {{ $orders->name_province }}, {{ $orders->name_regencies }}, {{ $orders->name_districts }}, {{ $orders->name_villages }}, {{ $orders->address2 }}
                                @else 
                                {{ $orders->name_province }}, {{ $orders->name_regencies }}, {{ $orders->name_districts }}, {{ $orders->name_villages }}, {{ $orders->address }}
                                @endif
                            </td>
                            <td class="py-2 text-end">{{ $orders->phone_number }}
                            </td>
                            <td class="py-2 text-end font-w600">{{ "Rp " . number_format($orders->price, 2, ',', '.') }}
                            </td>
                            <td class="py-2 text-end font-w600"{{ $orders->notes }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
