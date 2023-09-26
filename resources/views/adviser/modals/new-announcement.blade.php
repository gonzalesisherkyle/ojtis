 <!--Basic Modal -->
 <div class="modal fade text-left" id="new-announcement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
        <form action="{{ route('adviser-new-announcement') }}" method="post" enctype="multipart/form-data">
           @csrf
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Create new announcement</h5>
                        <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="to">Room name</label>
                            <strong class="text" style="color:red">*</strong>
                            <select name="room_id" id="room_id" class="form-select @error('room_id') is-invalid @enderror" required>
                                @foreach ($myRooms as $room)
                                    <option value="{{ $room->room_id }}">
                                        {{ $room->room_name }}</option>
                                @endforeach
                            </select>
                            @error('room_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Title</label>
                            <strong class="text" style="color:red">*</strong>
                            <input type="text" class="form-control" id="basicInput" placeholder="Enter title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Message</label>
                            <strong class="text" style="color:red">*</strong>
                            <input type="text" class="form-control" id="basicInput" placeholder="Enter message" name="body" required>
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Image/File</label><br>
                            <div class="form-file">
                                <input type="file" class="custom-file-input" id="file" aria-describedby="file" name="file">
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