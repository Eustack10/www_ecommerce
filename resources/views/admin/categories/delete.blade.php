<div class="modal fade" id="deleteModal">
    <div class="modal-body">
        <div class="modal-dialog">
            <div class="modal-content">
                <button class="btn-close position-absolute end-0 me-1 mt-1" data-bs-dismiss="modal"></button>
                <div class="mt-3 text-center">
                    <lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 pb-4">
                        <h4>Are You Sure To Delete!</h4>
                        <p class="text-muted mx-4 mb-0">This will deleted all relation with product</p>
                        <form id="delForm" action="" method="POST">@csrf
                            {{ method_field('delete') }}
                            <button type="submit" class="mt-2 btn px-5 btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>