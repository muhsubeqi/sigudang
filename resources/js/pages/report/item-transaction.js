One.helpers("js-flatpickr")

const formFilter = $('#form-filter')
const btnRefresh = $('#btn-refresh')
const btnExport = $('#btn-export')
const urlObj = new URL(window.location.href)
const urlStatus = urlObj.searchParams.get('status')
const statusName = urlStatus === 'in' ? 'Barang Masuk' : 'Barang Keluar'
let startDate = null
let endDate = null

$('#filter-status-name').text(`Filter ${statusName}`)

formFilter.on('submit', function (e) {
    e.preventDefault()
    startDate = $('#start-date').val()
    endDate = $('#end-date').val()

    btnExport.removeClass('d-none')
    One.block('state_loading', '#block-report-item-transaction')
    let content = `
        <div class="block-header block-header-default">
            <h3 class="block-title" id="report-status-name">
            </h3>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter fs-sm w-100" id="report-table">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>`
    $('#block-report-item-transaction').html(content)
    $('#report-status-name').text(`Laporan ${statusName} ${startDate} s/d ${endDate}`)
   
    $('#report-table').DataTable({
        responsive: true,
        processing: false,
        serverSide: true,
        button: [],
        ajax: {
            url: `${BASE_URL}/report/item-transaction/list/${urlStatus}`,
            data: function (d) {
                d.start_date = startDate
                d.end_date = endDate
            }
        },
        columns: COLUMNS,
        drawCallback: function () {
            One.block('state_normal', '#block-report-item-transaction')
        }
    })
})

btnExport.on('click', function () {
    window.open(`${BASE_URL}/report/item-transaction/export/${urlStatus}/?start_date=${startDate}&end_date=${endDate}`)
})