 <!--Basic Modal -->
 <div class="modal fade text-left" id="remove-file{{ $file->file_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
       <form action="{{ route('student-remove-file', $file->file_id) }}" method="post">
           @csrf
           <div class="modal-dialog modal-dialog-scrollable" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h1 class="modal-title" id="myModalLabel1">Warning</h1>
                       <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                           <i data-feather="x"></i>
                       </button>
                   </div>
                   <div class="modal-body">
                        <h5>Remove this file?</h5>
                   </div>   
                   <div class="modal-footer">
                       <button type="button" class="btn" data-dismiss="modal">
                           <i class="bx bx-x d-block d-sm-none"></i>
                           <span class="d-none d-sm-block">Cancel</span>
                       </button>
                       <button type="submit" class="btn btn-danger ml-1">
                           <i class="bx bx-check d-block d-sm-none"></i>
                           <span class="d-none d-sm-block">Remove</span>
                       </button>
                   </div>
               </div>
           </div>
       </form>
       
    </div>