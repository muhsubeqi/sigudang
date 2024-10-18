<form id="item-form" method="post" action="" enctype="multipart/form-data">
    <div class="modal fade" id="form-modal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h5 class="block-title" id="formModalLabel">Create</h5>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <input type="hidden" name="id" id="id">
                        <div class="row mb-3">
                            <label for="code" class="col-sm-3 col-form-label">Code </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-alt code" id="code" name="code" placeholder="Enter Code" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="type-id" class="col-sm-3 col-form-label">Type</label>
                            <div class="col-sm-9">
                                <select class="form-select js-select2" name="type_id" id="type-id" style="width:100%">
                                    <option></option>
                                    @foreach ($types as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="unit-id" class="col-sm-3 col-form-label">Unit</label>
                            <div class="col-sm-9">
                                <select class="form-select js-select2" name="unit_id" id="unit-id" style="width:100%">
                                    <option></option>
                                    @foreach ($units as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="stock" class="col-sm-3 col-form-label">Stock</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="stock" name="stock"
                                    placeholder="Enter Stock">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="image" class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="image" id="image">
                                <small class="text-muted fs-sm">
                                    Keterangan : <br>
                                    - Tipe file yang bisa diunggah adalah *.jpg atau *.png. <br>
                                    - Ukuran file yang bisa diunggah maksimal 1 Mb.
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
