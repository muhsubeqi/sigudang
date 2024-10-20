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
    const COLUMNS = @json($columns);
</script>
@vite(['resources/js/pages/item.js'])
@endsection

@section('content')
<x-hero-section title="Data Barang" :breadcrumbs="[
    ['label' => 'Master', 'url' => 'javascript:void(0)'],
    ['label' => 'Data Barang'],
]" />
<!-- Page Content -->
<div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded" id="block-item">
        <div class="block-header block-header-default">
            @can('item.create')
            <button type="button" class="btn btn-sm btn-alt-primary" data-bs-toggle="modal"
                data-bs-target="#form-modal">
                <i class="si si-plus me-1"></i> Tambah
            </button>
            @endcan
            <div class="block-options">
                <button type="button" class="btn-block-option" data-toggle="block-option" id="btn-refresh">
                    <i class="si si-refresh"></i>
                </button>
                <button type="button" class="btn-block-option" data-toggle="block-option"
                    data-action="content_toggle"></button>
            </div>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons fs-sm w-100"
                id="item-table">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th class="text-start">ID Barang</th>
                        <th class="text-start">Nama Barang</th>
                        <th class="text-start">Satuan</th>
                        <th class="text-start">Jenis</th>
                        <th class="text-start">Stok</th>
                        <th class="text-start">Foto</th>
                        @if (Gate::allows('item.edit') || Gate::allows('item.delete'))
                        <th style="width: 10%;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
@include('pages.item.partials.form')
<!-- END Page Content -->
@endsection