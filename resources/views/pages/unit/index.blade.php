@extends('layouts.backend')

@section('js')

<!-- Page JS Plugins -->
<script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
<!-- Page JS Code -->
<script>
    const COLUMNS = @json($columns);
</script>
@vite(['resources/js/pages/unit.js'])
@endsection

@section('content')
<x-hero-section title="Satuan" :breadcrumbs="[
    ['label' => 'Master', 'url' => 'javascript:void(0)'],
    ['label' => 'Satuan'],
]" />
<!-- Page Content -->
<div class="content">
    <div class="row">
        <div class="col-md-4">
            @include('pages.unit.partials.form')
        </div>
        <div class="col-md-8">
            <!-- Dynamic Table Full -->
            <div class="block block-rounded" id="block-unit">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        Daftar Satuan
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
                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full fs-sm w-100"
                        id="unit-table">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 80px;">#</th>
                                <th class="text-start">Nama Satuan</th>
                                @if (Gate::allows('unit.edit') || Gate::allows('unit.delete'))
                                <th>Aksi</th>
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
    </div>
</div>
<!-- END Page Content -->
@endsection