<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">
            Type <small>Form</small>
        </h3>
        <div class="block-options">
            <button type="button" class="btn-block-option" data-toggle="block-option"
                data-action="content_toggle"></button>
        </div>
    </div>
    <div class="block-content block-content-full">
        <form id="type-form" method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id">
            <div class="row mb-3">
                <label for="name" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                </div>
            </div>
            <div class="row mb-3">
                <label for="status" class="col-sm-3 col-form-label">Desc</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="description" id="description"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="image" class="col-sm-3 col-form-label">Image</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control" name="image" id="image">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary" id="btn-save">
                        <i class="fa fa-save"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>