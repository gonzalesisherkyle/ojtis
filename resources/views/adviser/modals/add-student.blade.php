<!--Basic Modal -->
<div class="modal fade text-left" id="add-student" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
aria-hidden="true">
    <form action="{{ route('adviser-create') }}" method="post" enctype="multipart/form-data">
        @csrf
        
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Add New Student</h5>
                    <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="basicInput">Email</label>
                        {{-- <strong class="text" style="color:red">*</strong> --}}
                        <input type="email" class="form-control" id="basicInput" placeholder="Email" name="email">
                        <div class="divider">
                            <div class="divider-text">OR</div>
                        </div>
                        <h6>Upload Excel</h6>
                        <div class="form-group">
                            <input type="file" class="custom-file-input" id="files" aria-describedby="files" name="file">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Cancel</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Add</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
    
</div>