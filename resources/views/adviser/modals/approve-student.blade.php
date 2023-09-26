 <!--Basic Modal -->
 <div class="modal fade text-left" id="approve-student{{ $student->user_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
       <form action="{{ route('adviser-approve-student', ['user' => $student->user_id, 'id' => $student->room_id]) }}" method="post">
           @csrf
           <div class="modal-dialog modal-dialog-scrollable" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="myModalLabel1">Approve Application</h5>
                       <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                           <i data-feather="x"></i>
                       </button>
                   </div>
                   <div class="modal-body">
                    <h4>Do you want to approve this application?</h4>
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