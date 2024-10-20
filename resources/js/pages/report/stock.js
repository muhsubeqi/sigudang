One.helpers(["jq-select2", "jq-validation"])

const formFilter = $('#form-filter')
const btnRefresh = $('#btn-refresh')
const btnExport = $('#btn-export')
let stock = null

$(formFilter).validate({
    rules: {
        stock: {
            required: true,
        },
    },
    highlightElement: function(element) {
        $(element).addClass('is-invalid');
    },
    unhighlightElement: function(element) {
        $(element).removeClass('is-invalid');
    }
})

formFilter.on('submit', function (e) {
    e.preventDefault()

    if (!$(this).valid()) {
        return
    }
    
    stock = $('#stock').val()
    btnExport.removeClass('d-none')
    One.block('state_loading', '#block-report-stock')
    let content = `
        <div class="block-header block-header-default">
            <h3 class="block-title">
                Report <span id="stock-status"></span> stock <small>List</small>
            </h3>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter fs-sm w-100" id="report-stock-table">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Jenis Barang</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>`
    $('#block-report-stock').html(content)
   
    $('#report-stock-table').DataTable({
        responsive: true,
        processing: false,
        serverSide: true,
        button: [],
        ajax: {
            url: `${BASE_URL}/report/stock/list`,
            data: function (d) {
                d.stock = stock
            }
        },
        columns: COLUMNS,
        drawCallback: function () {
            One.block('state_normal', '#block-report-stock')
        }
    })
})

btnExport.on('click', function () {
    window.open(`${BASE_URL}/report/stock/export?stock=${stock}`)
})