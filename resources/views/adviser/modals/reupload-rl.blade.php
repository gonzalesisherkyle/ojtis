<!--Basic Modal -->
<div class="modal fade text-left" id="reupload-rl{{ $letter->file_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
aria-hidden="true">
    <form action="{{ route('adviser-reupload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Reupload Approved Recommendation Letter</h5>
                    <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="{{ $letter->file_id }}">
                        <div class="form-file">
                            <input type="file" class="custom-file-input" id="file" aria-describedby="file" name="file" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Cancel</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reupload</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
</div>