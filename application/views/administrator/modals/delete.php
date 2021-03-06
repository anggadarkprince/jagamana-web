<!-- Delete Modal -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="jm-form-delete" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel"><i class="fa fa-trash"></i> Delete <span  id="jm-delete-title"></span></h3>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="jm-delete-id" id="jm-delete-id">
                    <p id="jm-delete-message"></p>
                    <span class="text-muted">All related record will be deleted</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" id="submitDelete">Delete Now</button>
                </div>
            </form>
        </div>
    </div>
</div>