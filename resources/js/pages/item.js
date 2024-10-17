import sweetAlert from "../helper/sweetalert"

let itemForm = $('#item-form')
let formModal = $('#form-modal')
const btnRefresh = $('#btn-refresh')

$('#unit-id').select2({
    placeholder: 'Select..',
    dropdownParent: document.querySelector($('#unit-id').data('container') || '#form-modal'),
})
$('#type-id').select2({
    placeholder: 'Select..',
    dropdownParent: document.querySelector($('#type-id').data('container') || '#form-modal'),
})

const dtTable =$('#item-table').DataTable({
    responsive: true,
    processing: false,
    serverSide: true,
    ajax: {
        url: `${BASE_URL}/item/list`,
    },
    columns: COLUMNS,
    drawCallback: function () {
        One.block('state_normal', '#block-item')
    }
})

$(formModal).on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget) 
    let id = button.data('id'); 
    let code = button.data('code')
    let name = button.data('name')
    let type = button.data('type_id')
    let unit = button.data('unit_id')
    
    let stock = button.data('stock')
    
    $(this).find('.block-title').text( id ? 'Edit' : 'Create' )
    $(this).find('#id').val(id ?? '')
    $(this).find('#code').val(code ?? '')
    $(this).find('#name').val(name ?? '')
    $(this).find('#type-id').val(type ?? '').change()
    $(this).find('#unit-id').val(unit ?? '').change()
    $(this).find('#stock').val(stock ?? '')
   
});

$(document).ready(function () {
    One.helpers("jq-validation")
    $(itemForm).validate({
        rules: {
            name: { 
                required: true,
                minlength: 3
            },
            role: { 
                required: true
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
    $(itemForm).validate().resetForm()
})

$(itemForm).on('submit', function (e) {
    e.preventDefault()

    if (!$(this).valid()) {
        return
    }

    const id = $(this).find('#id').val();
    const urlStore = `${BASE_URL}/item/store`
    const urlUpdate = `${BASE_URL}/item/update/${id}`

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
    const url = `${BASE_URL}/item/destroy/${id}`
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

dtTable.on('change', '.btn-status', function () {
    const id = $(this).data('id')
    const status = $(this).val()
    const url = `${BASE_URL}/item/status/${id}`
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN
        }
    })
    $.post({
            url: url,
            data: {
                status: status
            }
        })
        .done(result => {
            sweetAlert(result.status, result.message)
            dtTable.ajax.reload(null, false)
        })
})

btnRefresh.on('click', function () {
    dtTable.ajax.reload(null, false)
    One.block('state_loading', '#block-item')
})