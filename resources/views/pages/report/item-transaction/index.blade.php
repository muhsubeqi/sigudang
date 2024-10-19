@php
$status = request()->query('status');
@endphp
@extends('layouts.backend')
@section('css')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css') }}">
@endsection

@section('js')

<!-- Page JS Plugins -->
<script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/plugins/flatpickr/flatpickr.min.js') }}"></script>
<!-- Page JS Code -->
<script>
    const COLUMNS = @json($columns)
</script>
@vite(['resources/js/pages/report/item-transaction.js'])
@endsection

@section('content')
<x-hero-section title="Laporan Barang {{ $status === 'in' ? 'Masuk' : 'Keluar' }}" :breadcrumbs="[
    ['label' => 'Laporan', 'url' => 'javascript:void(0)'],
    ['label' => 'Transaksi Barang'],
]" />
<!-- Page Content -->
<div class="content">
    <!-- Info -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title" id="filter-status-name"></h3>
        </div>
        <div class="block-content fs-sm text-muted">
            <form action="" method="POST" id="form-filter">
                <div class="row mb-4 align-items-end">
                    <div class="col-md-4 mb-2">
                        <label class="form-label" for="start-date">Tanggal Awal <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control js-flatpickr" id="start-date" name="start_date"
                            placeholder="d-m-Y" data-date-format="d-m-Y">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label" for="end-date">Tanggal Akhir <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control js-flatpickr" id="end-date" name="end_date"
                            placeholder="d-m-Y" data-date-format="d-m-Y">
                    </div>
                    <div class="col-md-4 d-flex justify-content-start mb-2">
                        <button type="submit" class="btn btn-primary mx-1 px-lg-2" id="btn-filter">Tampilkan</button>
                        <button type="button" class="btn btn-success mx-1 px-lg-2 d-none" id="btn-export"><i
                                class="fa fa-file-excel me-2"></i> Export</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Info -->

    <!-- Dynamic Table Full -->
    <div class="block block-rounded" id="block-report-item-transaction">

    </div>
    <!-- END Dynamic Table Full -->
</div>
<!-- END Page Content -->
@endsection