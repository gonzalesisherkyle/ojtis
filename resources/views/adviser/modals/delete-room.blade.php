 <!--Basic Modal -->
 <div class="modal fade text-left" id="delete-room{{ $room->room_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
       <form action="{{ route('adviser-deleteRoom', $room->room_id) }}" method="post">
           @csrf
           <div class="modal-dialog modal-dialog-scrollable" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="myModalLabel1">Warning</h5>
                       <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                           <i data-feather="x"></i>
                       </button>
                   </div>
                   <div class="modal-body">
                        <h3>Delete this room?</h3>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn" data-dismiss="modal">
                           <i class="bx bx-x d-block d-sm-none"></i>
                           <span class="d-none d-sm-block">Cancel</span>
                       </button>
                       <button type="submit" class="btn btn-danger ml-1">
                           <i class="bx bx-check d-block d-sm-none"></i>
                           <span class="d-none d-sm-block">Delete</span>
                       </button>
                   </div>
               </div>
           </div>
       </form>
       
    </div>