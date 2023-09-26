<!--Basic Modal -->
<div class="modal fade text-left" id="accept-students" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
        <form action="{{ route('adviser-creates') }}" method="post">
            @csrf
            
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">New Accounts</h5>
                        <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4>Do you want to approve these student?</h4>
                        
                        <input type="hidden" class="form-control" id="basicInput" name="email" value="{{ $students->reg_id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">No</span>
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