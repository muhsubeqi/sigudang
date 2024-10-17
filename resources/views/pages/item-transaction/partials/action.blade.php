<td class="text-center fs-sm">
    @can('item.edit')
    <a class="btn btn-sm btn-alt-secondary" data-id="{{ $row->id }}" data-invoice="{{ $row->invoice }}"
        data-item_id="{{ $row->item_id }}" data-qty="{{ $row->qty }}"
        data-date="{{ Carbon\Carbon::parse($row->date)->format('Y-m-d') }}" data-bs-toggle="modal"
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