<form id="item-transaction-form" method="post" action="" enctype="multipart/form-data">
    <div class="modal fade" id="form-modal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
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
                            <label for="invoice" class="col-sm-3 col-form-label">ID Transaksi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-alt" id="invoice" name="invoice"
                                    placeholder="Masukkan ID Transaksi" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date" class="col-sm-3 col-form-label">Tanggal</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control js-flatpickr" id="date" name="date"
                                    placeholder="d-m-Y" data-date-format="d-m-Y">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="item-id" class="col-sm-3 col-form-label">Barang</label>
                            <div class="col-sm-9">
                                <select class="form-select js-select2" name="item_id" id="item-id" style="width:100%">
                                    <option></option>
                                    @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->code }} - {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="qty" class="col-sm-3 col-form-label">Jumlah</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="qty" name="qty"
                                    placeholder="Masukkan Jumlah">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="stock" class="col-sm-3 col-form-label">Stok Barang</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control form-control-alt" id="stock" name="stock"
                                    placeholder="0" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="stock-total" class="col-sm-3 col-form-label">Total Stok Barang</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control form-control-alt" id="stock-total"
                                    name="stock_total" placeholder="0" readonly>
                            </div>
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