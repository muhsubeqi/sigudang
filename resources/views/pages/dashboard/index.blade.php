@extends('layouts.backend')
@section('js')
<script src="{{ asset('js/plugins/chart.js/chart.min.js') }}"></script>
@vite(['resources/js/pages/dashboard.js'])
@endsection
@section('content')
<!-- Hero -->
<div class="content">
    <div
        class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
        <div class="flex-grow-1 mb-1 mb-md-0">
            <h1 class="h3 fw-bold mb-2">
                Dashboard
            </h1>
            <h2 class="h6 fw-medium fw-medium text-muted mb-0">
                Selamat Datang <a class="fw-semibold" href="be_pages_generic_profile.html">{{ Auth::user()->name }}</a>,
                di Sistem Informasi Persediaan Barang Gudang
            </h2>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Overview -->
    <div class="row items-push">
        <div class="col-sm-6 col-xxl-3">
            <!-- Data Barang -->
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $items->count() }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Data Barang</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="fas fa-laptop fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                        href="{{ route('item.index') }}">
                        <span>Lihat Semua Barang</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
            <!-- END Data Barang -->
        </div>
        <div class="col-sm-6 col-xxl-3">
            <!-- Data Barang Masuk -->
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $inItemTransactions }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Data Barang Masuk</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="fas fa-file-arrow-down fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                        href="{{ route('item-transaction.index', ['status' => 'in']) }}">
                        <span>Lihat Barang Masuk</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
            <!-- END Data Barang Masuk -->
        </div>
        <div class="col-sm-6 col-xxl-3">
            <!-- Data Barang Keluar -->
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $outItemTransactions }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Data Barang Keluar</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="fas fa-file-arrow-up fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                        href="{{ route('item-transaction.index', ['status' => 'out']) }}">
                        <span>Lihat Barang Keluar</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
            <!-- END Data Barang Keluar -->
        </div>
        <div class="col-sm-6 col-xxl-3">
            <!-- Data Pengguna -->
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $users }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Data Pengguna</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="fa fa-users fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                        href="{{ route('user.index') }}">
                        <span>Lihat Pengguna</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
            <!-- END Data Pengguna-->
        </div>
    </div>
    <!-- END Overview -->

    <!-- Barang Stok Minimum -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title"><i class="fa fa-fw fa-exclamation-triangle me-1"></i> Stock barang telah mencapai
                batas
                minimum</h3>
        </div>
        <div class="block-content block-content-full">
            <!-- Barang Stok Minimum Table -->
            <div class="table-responsive">
                <table class="table table-hover table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Stock</th>
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody class="fs-sm">
                        @foreach ($minimumStock as $row)
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $row->code }}
                            </td>
                            <td>
                                <a class="fw-semibold" href="javascript:void(0)">{{ $row->name }}</a>
                            </td>
                            <td>
                                {{ $row->type->name }}
                            </td>
                            <td>
                                <span
                                    class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning text-white">{{
                                    $row->stock }}</span>
                            </td>
                            <td>
                                {{ $row->unit->name }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END Barang Stok Minimum Table -->
        </div>
    </div>
    <!-- END Recent Orders -->
</div>
<!-- END Page Content -->
@endsection