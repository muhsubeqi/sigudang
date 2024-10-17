import sweetAlert from "../helper/sweetalert"

let unitForm = $('#unit-form')
const btnRefresh = $('#btn-refresh')

const dtTable =$('#unit-table').DataTable({
    processing: false,
    serverSide: true,
    responsive: true,
    ajax: {
        url: `${BASE_URL}/unit/list`,
    },
    columns: COLUMNS,
    drawCallback: function () {
        One.block('state_normal', '#block-unit')
    }
})

$(document).ready(function () {
    One.helpers("jq-validation")
    $(unitForm).validate({
        rules: {
            name: { 
                required: true,
                minlength: 3
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

$(unitForm).on('submit', function (e) {
    e.preventDefault()

    if (!$(this).valid()) {
        return
    }

    const id = $(this).find('#id').val();
    const urlStore = `${BASE_URL}/unit/store`
    const urlUpdate = `${BASE_URL}/unit/update/${id}`

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
            $(this)[0].reset()
            $('#id').val('')
        })
        .always(function() {
            dtTable.ajax.reload(null, false)
        });
});

dtTable.on('click', '.btn-edit', function () {
    const id = $(this).data('id')
    const name = $(this).data('name')

    unitForm.find('#id').val(id)
    unitForm.find('#name').val(name)
})

dtTable.on('click', '.btn-delete', function () {
    const id = $(this).data('id')
    const url = `${BASE_URL}/unit/destroy/${id}`
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
    One.block('state_loading', '#block-unit')
})