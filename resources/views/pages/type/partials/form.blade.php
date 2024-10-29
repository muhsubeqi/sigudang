<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">
            Form Jenis Barang
        </h3>
        <div class="block-options">
            <button type="button" class="btn-block-option" data-toggle="block-option"
                data-action="content_toggle"></button>
        </div>
    </div>
    <div class="block-content block-content-full">
        <form id="type-form" method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id">
            <div class="row mb-3">
                <label for="name" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                </div>
            </div>
            <div class="row mb-3">
                <label for="status" class="col-sm-3 col-form-label">Ket.</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="description" id="description"
                        placeholder="Masukkan Keterangan"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="image" class="col-sm-3 col-form-label">Foto</label>
                <div class="col-sm-9">
                    <div class="mb-4">
                        <img class="img-fluid" src="{{ asset('media/custom/no-image.png') }}" alt="" id="image-preview"
                            style="width: 150px; height: 100px">
                    </div>
                    <input type="file" class="form-control" name="image" id="image">
                    <small class="text-muted" style="font-size: 12px;">
                        Keterangan : <br>
                        - Tipe file *.jpg atau *.png. <br>
                        - Maks 1 Mb.
                    </small>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-alt-success" id="btn-save">
                        <i class="fa fa-save me-1"></i>
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>