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

    <div class="card dz-card" id="accordion-one">
        <div class="card-header flex-wrap">
            <div>
                <h4 class="card-title">Table Order</h4>
            </div>
        </div>
        <!--tab-content-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
                <div class="card-body pt-0">
                </div>

                <div class="table-responsive">
                    <table id="example4" class="display table" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Order Number</th>
                                <th>Pelanggan</th>
                                <th>Metode Pembayaran </th>
                                <th>Total Harga</th>
                                <th>Jumlah </th>
                                <th>Status </th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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


        var table = $('#example4').dataTable({
            autoWidth: true,
            processing: true,
            serverSide: true,
            destroy: true,
            responsive: true,
            dom: '<"top"<"pull-left"f><"pull-right"l>>rt<"bottom"<"pull-left"i><"pull-right"p>>',
            columnDefs: [{
                    responsivePriority: 1,
                    targets: 0
                },
                {
                    responsivePriority: 2,
                    targets: 4
                }
            ],
            language: {
                processing: '<span style="color:black;">Mohon Tunggu...</span><i class="fa-solid fa-refresh fa-spin fa-3x fa-fw" style="color:#2510A3;"></i>',
                sEmptyTable: "Tidak Ada Data Yang Tersedia Pada Tabel Ini",
                sLengthMenu: "Tampilkan _MENU_ Baris",
                sZeroRecords: "Tidak Ditemukan Data Yang Sesuai",
                sInfo: "Menampilkan _START_ Sampai _END_ Dari _TOTAL_ Baris",
                sInfoEmpty: "Menampilkan 0 Sampai 0 Dari 0 Baris",
                sInfoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
                sInfoPostFix: "",
                sSearch: "Cari:",
                sUrl: "",
            },
            stateSave: true,
            order: [],
            ajax: "{{url('admin/orders')}}",
            deferRender: true,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'order_number',
                    name: 'order_number'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'payment_method',
                    name: 'payment_method'
                },
                {
                    data: 'grand_total',
                    name: 'grand_total'
                },
                {
                    data: 'item_count',
                    name: 'item_count'
                },
                {
                    data: 'payment_status',
                    name: 'payment_status'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $(this).on('click', '#buttonUpdate', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                title: 'Peringatan',
                text: "Ubah Pesanan Menjadi Expired ?",
                icon: 'warning',
                showCancelButton: true,
                buttonsStyling: true,
                confirmButtonClass: 'btn btn-danger',
                cancelButtonClass: 'btn btn-primary',
                confirmButtonText: 'Expired <i class="fa-solid fa-calendar me-2"></i>',
                cancelButtonText: 'Batal <i class="fa-solid fa-close me-2"> </i>'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        url: `{{url('admin/orders/updateStatus')}}/${id}`,
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        dataType: "json",
                        beforeSend: function()
                        {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Mohon Tunggu !',
                                html: 'Memperbaharui...',// add html attribute if you want or remove
                                allowOutsideClick: false,
                                onBeforeOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                        },
                        success: function (response) {
                            swal.close();
                            let oTable = $('#example4').dataTable();
                            oTable.fnDraw(false);
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Pesanan Berhasil Diperbaharui !',
                            });
                        },
                        error: function () {
                            
                            swal.close();
                            Toast.fire({
                                icon: 'error',
                                text: 'Gagal memperbaharui data !'
                            })
                        }
                    });
                }
            })
        });
    });

</script>
@endpush
