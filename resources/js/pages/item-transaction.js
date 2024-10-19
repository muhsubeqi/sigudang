import sweetAlert from "../helper/sweetalert"

let itemTransactionForm = $('#item-transaction-form')
let formModal = $('#form-modal')
const btnRefresh = $('#btn-refresh')
const urlObj = new URL(window.location.href)
const urlStatus = urlObj.searchParams.get('status')

$('#item-id').select2({
    placeholder: 'Select..',
    dropdownParent: document.querySelector($('#item-id').data('container') || '#form-modal'),
})

const dtTable =$('#item-transaction-table').DataTable({
    responsive: true,
    processing: false,
    serverSide: true,
    ajax: {
        url: `${BASE_URL}/item-transaction/list/${urlStatus}`,
    },
    columns: COLUMNS,
    drawCallback: function () {
        One.block('state_normal', '#block-item-transaction')
    }
})

$(formModal).on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget)
    let id = button.data('id');
    let invoice = button.data('invoice')
    let item = button.data('item_id')
    let stock = button.data('stock')
    let qty = button.data('qty')
    let date = button.data('date')

    const format = $('#item-transaction-table').DataTable().ajax.json().codeFormat

    $(this).find('.block-title').text( id ? 'Edit' : 'Tambah' )
    $(this).find('#id').val(id ?? '')
    $(this).find('#invoice').val(invoice ?? format)
    $(this).find('#item-id').val(item ?? '').change()
    $(this).find('#qty').val(qty ?? '')
    $(this).find('#stock').val(stock ?? '')
    $(this).find('#date').val(date ?? '')

    $('#item-id').on('change', function () {
      let item = $(this).val()
      $.get({
        url: `${BASE_URL}/item/select/${item}`
      })
        .done(result => {
          $('#stock').val(result.stock)
        })
    })

    $('#qty').on('keyup', function () {
      let qty = $(this).val()
      let stock = parseInt($('#stock').val())

      let stockTotal
      if (urlStatus == 'in') {
        stockTotal = parseInt(stock) + parseInt(qty)
      }else{
        stockTotal = parseInt(stock) - parseInt(qty)
      }
      $('#stock-total').val(stockTotal)
    })
});

$(document).ready(function () {
    One.helpers("jq-validation")
    $(itemTransactionForm).validate({
        rules: {
            invoice: {
                required: true,
            },
            item_id: {
                required: true
            },
            qty: {
                required: true
            },
            date: {
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
});

$(formModal).on('hidden.bs.modal', function () {
    $(itemTransactionForm).validate().resetForm()
})

$(itemTransactionForm).on('submit', function (e) {
    e.preventDefault()
    console.log('asd');

    if (!$(this).valid()) {
        return
    }

    const id = $(this).find('#id').val();
    const urlStore = `${BASE_URL}/item-transaction/store/${urlStatus}`
    const urlUpdate = `${BASE_URL}/item-transaction/update/${id}/${urlStatus}`

    const url = id ? urlUpdate : urlStore
    const fd = new FormData($(this)[0]);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN
        }
    })
    $.post({
            url: url,
            data: fd,
            processData: false,
            contentType: false
        })
        .done(result => {
            sweetAlert(result.status, result.message)
            $(formModal).modal('hide')
            $(this)[0].reset()
        })
        .always(function() {
            dtTable.ajax.reload(null, false)
        });
});

dtTable.on('click', '.btn-delete', function () {
    const id = $(this).data('id')
    const url = `${BASE_URL}/item-transaction/destroy/${id}/${urlStatus}`
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
            })
            $.post({
                    url: url
                })
                .done(result => {
                    sweetAlert(result.status, result.message)
                    dtTable.ajax.reload(null, false)
                })
        }
    })
})

btnRefresh.on('click', function () {
    dtTable.ajax.reload(null, false)
    One.block('state_loading', '#block-item-transaction')
})
