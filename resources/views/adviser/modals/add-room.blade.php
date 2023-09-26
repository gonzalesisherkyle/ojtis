 <!--Basic Modal -->
 <div class="modal fade text-left" id="add-room" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
       <form action="{{ route('adviser-addRoom') }}" method="post">
           @csrf
         
           <div class="modal-dialog modal-dialog-scrollable" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="myModalLabel1">Create new room</h5>
                       <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                           <i data-feather="x"></i>
                       </button>
                   </div>
                   <div class="modal-body">
                    <div class="form-group">
                        <label for="basicInput">Room name</label>
                        <strong class="text" style="color:red">*</strong>
                        <input type="text" class="form-control" id="basicInput" placeholder="Room Name" name="room_name" required>
                    </div>
                    <div class="form-group">
                        <label for="student_number">Target course</label>
                        <strong class="text" style="color:red">*</strong>
                        <select name="course_id" id="course_id" class="form-select @error('course_id') is-invalid @enderror" required> 
                            @foreach (\App\Models\Course::all() as $course)
                                <option value="{{ $course->course_id }}">
                                    {{ $course->course_name }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
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
                           <span class="d-none d-sm-block">Add</span>
                       </button>
                   </div>
               </div>
           </div>
       </form>
       
    </div>