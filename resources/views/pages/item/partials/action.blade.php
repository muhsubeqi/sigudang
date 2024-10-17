<td class="text-center fs-sm">
    @can('item.edit')
    <a class="btn btn-sm btn-alt-secondary" data-id="{{ $row->id }}" data-code="{{ $row->code }}"
        data-name="{{ $row->name }}" data-unit_id="{{ $row->unit_id }}" data-type_id="{{ $row->type_id }}"
        data-stock="{{ $row->stock }}" data-image="{{ $row->image }}" data-bs-toggle="modal"
        data-bs-target="#form-modal" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit">
        <i class="fa fa-fw fa-pen"></i>
    </a>
    @endcan
    @can('item.delete')
    <a class="btn btn-sm btn-alt-danger btn-delete" data-bs-toggle="tooltip" aria-label="Delete"
        data-id="{{ $row->id }}" data-bs-original-title="Delete">
        <i class="fa fa-fw fa-times text-danger"></i>
    </a>
    @endcan
</td>