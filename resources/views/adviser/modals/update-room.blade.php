 <!--Basic Modal -->
 <div class="modal fade text-left" id="update-room{{ $room->room_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
       <form action="{{ route('adviser-updateRoom', $room->room_id ) }}" method="post">
           @csrf
            @method('PUT')
           <div class="modal-dialog modal-dialog-scrollable" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="myModalLabel1">Change room status</h5>
                       <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                           <i data-feather="x"></i>
                       </button>
                   </div>
                   <div class="modal-body">
                    <div class="form-group">
                        <label for="basicInput">Room Name</label>
                        <input type="text" value="{{ $room->room_name }}" class="form-control" id="basicInput" placeholder="Room Name" name="room_name" readonly>
                    </div>
                    <div class="form-group">
                        <label for="student_number">Target Course</label>
                        <select name="course_id" id="course_id" class="form-select @error('course_id') is-invalid @enderror" disabled>
                            @foreach (\App\Models\Course::all() as $course)
                            <option value="{{ $course->course_id }}" @isset($room){{ $course->course_id == $room->course_id ? 'selected' : '' }} @endisset>
                                {{ $course->course_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Room Status</label>
                        <strong class="text" style="color:red">*</strong>
                        <select name="status" id="applying_as" class="form-select" required>
                                <option value="open">Open</option>
                                <option value="closed">Close</option>
                                <option value="inactive">Inactive</option>
                        </select>
                        @error('applying_as')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>    
                   </div>
                   
                   <div class="modal-footer">
                       <button type="button" class="btn" data-dismiss="modal">
                           <i class="bx bx-x d-block d-sm-none"></i>
                           <span class="d-none d-sm-block">Cancel</span>
                       </button>
                       <button type="submit" class="btn btn-primary ml-1">
                           <i class="bx bx-check d-block d-sm-none"></i>
                           <span class="d-none d-sm-block">Update</span>
                       </button>
                   </div>
               </div>
           </div>
       </form>
       
    </div>