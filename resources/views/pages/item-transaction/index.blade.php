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
@vite(['resources/js/pages/item-transaction.js'])
@endsection

@section('content')
<x-hero-section title="Item Transaction"
    subtitle="List of all item transactions, you can add, edit and delete item transaction" :breadcrumbs="[
    ['label' => 'Management', 'url' => 'javascript:void(0)'],
    ['label' => 'Item Transaction'],
]" />
<!-- Page Content -->
<div class="content">
    <!-- Info -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Plugin Example</h3>
        </div>
        <div class="block-content fs-sm text-muted">
            <p>
                This page showcases how easily you can add a plugin’s JS/CSS assets and init it using custom JS code.
            </p>
        </div>
    </div>
    <!-- END Info -->

    <!-- Dynamic Table Full -->
    <div class="block block-rounded" id="block-item-transaction">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                Item transaction <small>List</small>
            </h3>
            <div class="block-options">
                @can('item-transaction.create')
                <button type="button" class="btn-block-option" data-bs-toggle="modal" data-bs-target="#form-modal">
                    <i class="si si-plus"></i>
                </button>
                @endcan
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
                id="item-transaction-table">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Invoice</th>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Date</th>
                        <th>User</th>
                        @if (Gate::allows('item-transaction.edit') || Gate::allows('item-transaction.delete'))
                        <th style="width: 10%;">Action</th>
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
@include('pages.item-transaction.partials.form')
<!-- END Page Content -->
@endsection