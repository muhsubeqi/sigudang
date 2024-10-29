import sweetAlert from "../helper/sweetalert"

let typeForm = $('#type-form')
const btnRefresh = $('#btn-refresh')

const dtTable =$('#type-table').DataTable({
    processing: false,
    serverSide: true,
    responsive: true,
    ajax: {
        url: `${BASE_URL}/type/list`,
    },
    columns: COLUMNS,
    drawCallback: function () {
        One.block('state_normal', '#block-type')
    }
})

$(document).ready(function () {
    One.helpers("jq-validation")
    $(typeForm).validate({
        rules: {
            name: { 
                required: true,
                minlength: 3
            },
            description: { 
                minlength: 5,
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

$(typeForm).on('submit', function (e) {
    e.preventDefault()

    if (!$(this).valid()) {
        return
    }

    const id = $(this).find('#id').val();
    const urlStore = `${BASE_URL}/type/store`
    const urlUpdate = `${BASE_URL}/type/update/${id}`

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
            $(this).find('#image-preview').attr('src', `${BASE_URL}/media/custom/no-image.png`)
        })
        .always(function() {
            dtTable.ajax.reload(null, false)
        });
});

dtTable.on('click', '.btn-edit', function () {
    const id = $(this).data('id')
    const name = $(this).data('name')
    const description = $(this).data('description')
    const image = $(this).data('image')
    
    if (image) {
        typeForm.find('#image-preview').attr('src', `${BASE_URL}/storage/images/type/${image}`)
        
    }else{
        typeForm.find('#image-preview').attr('src', `${BASE_URL}/media/custom/no-image.png`)
    }

    typeForm.find('#id').val(id)
    typeForm.find('#name').val(name)
    typeForm.find('#description').val(description)
})

dtTable.on('click', '.btn-delete', function () {
    const id = $(this).data('id')
    const url = `${BASE_URL}/type/destroy/${id}`
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
    One.block('state_loading', '#block-type')
})

$('#image').on('change', function () {
    const file = this.files[0]
    const reader = new FileReader()
    reader.readAsDataURL(file)
    reader.onload = function () {
        $('#image-preview').attr('src', reader.result)
    }
})