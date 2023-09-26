 <!--Basic Modal -->
<div class="modal fade text-left" id="disapproved-moa{{ $moa->file_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
aria-hidden="true">
    <form action="{{ route('adviser-rejectMoa', $moa->file_id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Memorandum of Agreement</h5>
                    <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Do you want to deny this MOA?</h6>
                    <label for="basicInput">Remarks</label>
                    <strong class="text" style="color:red">*</strong>
                    <input type="text" class="form-control" id="remarks" name="remarks" autofocus required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Cancel</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Yes</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>