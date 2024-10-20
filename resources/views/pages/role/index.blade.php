@extends('layouts.backend')
@section('js')
<!-- Page JS Plugins -->
<script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>

<script>
    const PERMISSIONS = @json($permissions);
        const COLUMNS = @json($columns);
</script>
<!-- Page JS Code -->
@vite(['resources/js/pages/role.js'])
@endsection
@section('content')
<x-hero-section title="Role" subtitle="Daftar semua role sistem" :breadcrumbs="[
        ['label' => 'Pengaturan', 'url' => 'javascript:void(0)'],
        ['label' => 'Role'],
    ]" />
<!-- Page Content -->
<div class="content">
    <div class="block block-rounded" id="block-role">
        <div class="block-header block-header-default">
            @can('role.create')
            <button type="button" class="btn btn-sm btn-alt-primary" data-bs-toggle="modal"
                data-bs-target="#form-modal">
                <i class="si si-plus me-1"></i> Entri Data
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
            <table class="table table-bordered table-striped table-vcenter fs-sm w-100" id="role-table">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 20px;">#</th>
                        <th>Nama</th>
                        @if (Gate::allows('role.edit') || Gate::allows('role.delete'))
                        <th style="width: 15%;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('pages.role.partials.form')
@include('pages.role.partials.role-permission')
<!-- END Page Content -->
@endsection