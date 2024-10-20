@extends('layouts.backend')

@section('css')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('js')

<!-- Page JS Plugins -->
<script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
<script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Page JS Code -->
<script>
    const COLUMNS = @json($columns)
</script>
@vite(['resources/js/pages/report/stock.js'])
@endsection

@section('content')
<x-hero-section title="Laporan Stok" :breadcrumbs="[
    ['label' => 'Laporan', 'url' => 'javascript:void(0)'],
    ['label' => 'Laporan Stok'],
]" />
<!-- Page Content -->
<div class="content">
    <!-- Info -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Filter Laporan Stok</h3>
        </div>
        <div class="block-content fs-sm text-muted">
            <form action="" method="POST" id="form-filter">
                <div class="row mb-4 align-items-end">
                    <div class="col-md-6">
                        <label class="form-label" for="stock">Stok Barang <span class="text-danger">*</span></label>
                        <select class="form-select js-select2" id="stock" name="stock" style="width:100%"
                            data-placeholder="Choose one..">
                            <option></option>
                            <option value="all">Seluruh</option>
                            <option value="minimum">Minimum</option>
                        </select>
                    </div>
                    <div class="col-md-6 d-flex justify-content-start mt-2">
                        <button type="submit" class="btn btn-primary mx-1 px-lg-5" id="btn-filter">Tampilkan</button>
                        <button type="button" class="btn btn-success mx-1 px-lg-5 d-none" id="btn-export"><i
                                class="fa fa-file-excel me-2"></i> Export</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Info -->

    <!-- Dynamic Table Full -->
    <div class="block block-rounded" id="block-report-stock">

    </div>
    <!-- END Dynamic Table Full -->
</div>
<!-- END Page Content -->
@endsection