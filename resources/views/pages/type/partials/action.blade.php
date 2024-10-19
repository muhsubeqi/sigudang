<td class="text-center fs-sm">
    @can('unit.edit')
    <a class="btn btn-sm btn-alt-secondary btn-edit" data-id="{{ $row->id }}" data-name="{{ $row->name }}"
        data-description="{{ $row->description }}" data-bs-toggle="tooltip" aria-label="Edit"
        data-bs-original-title="Edit">
        <i class="fa fa-fw fa-pen"></i>
    </a>
    @endcan
    @can('unit.delete')
    <a class="btn btn-sm btn-alt-danger btn-delete" data-bs-toggle="tooltip" aria-label="Delete"
        data-id="{{ $row->id }}" data-bs-original-title="Delete">
        <i class="fa fa-fw fa-trash text-danger"></i>
    </a>
    @endcan
</td>