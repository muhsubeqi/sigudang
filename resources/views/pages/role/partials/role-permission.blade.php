@php
$permissionGroups = Spatie\Permission\Models\Permission::select('group_name')->groupBy('group_name')->get();
@endphp
<form id="role-permission-form" method="post" action="" enctype="multipart/form-data">
    <div class="modal fade" id="role-permission-modal" tabindex="-1" data-bs-backdrop="static"
        aria-labelledby="rolePermissionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h5 class="block-title" id="rolePermissionModalLabel">Role Permission</h5>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <input type="hidden" name="id" id="id">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="permission-all">
                            <label class="form-check-label" for="permission-all">Permission All </label>
                        </div>

                        <hr>

                        <div class="row" id="permission-group">
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-alt-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-alt-success">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>