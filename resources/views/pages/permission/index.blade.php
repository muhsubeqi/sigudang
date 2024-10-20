@extends('layouts.backend')
@section('js')

<!-- Page JS Code -->
<script>
    const COLUMNS = @json($columns)
</script>
@vite(['resources/js/pages/permission.js'])
@endsection
@section('content')
<x-hero-section title="Permission" :breadcrumbs="[
        ['label' => 'Pengaturan', 'url' => 'javascript:void(0)'],
        ['label' => 'Permission'],
    ]" />
<!-- Page Content -->
<div class="content">
    <div class="block block-rounded" id="block-permission">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                Daftar Permission
            </h3>
            <div class="block-options">
                <button type="button" class="btn-block-option" data-toggle="block-option" id="btn-refresh">
                    <i class="si si-refresh"></i>
                </button>
                <button type="button" class="btn-block-option" data-toggle="block-option"
                    data-action="content_toggle"></button>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter fs-sm w-100" id="permission-table">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 20px;">#</th>
                        <th>Nama</th>
                        <th>Group</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection