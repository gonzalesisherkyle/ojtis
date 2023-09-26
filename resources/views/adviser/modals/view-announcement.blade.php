 <!--Basic Modal -->
 <div class="modal fade text-left" id="view-announcement{{ $announcement->announcement_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">  

    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Annoucement</h5>
                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="basicInput">Room name</label>
                    <small class="text-muted">required</small>
                    <input type="text" class="form-control" id="basicInput" name="room_name" value="{{ $announcement->room_name }}" readonly>
                </div>
                
                <div class="form-group">
                    <label for="basicInput">Title</label>
                    <small class="text-muted">required</small>
                    <input type="text" class="form-control" id="basicInput"  name="title" value="{{ $announcement->title }}" readonly>
                </div>
                <div class="form-group">
                    <label for="basicInput">Message</label>
                    <small class="text-muted">required</small>
                    <input type="text" class="form-control" id="basicInput" name="message" value="{{ $announcement->body }}" readonly>
                </div>
            </div>
          
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
               
            </div>
        </div>
    </div>
</div>