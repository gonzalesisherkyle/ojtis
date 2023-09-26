 <!--Basic Modal -->
 <div class="modal fade text-left" id="view-room{{ $room->room_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">          
           <div class="modal-dialog modal-dialog-scrollable" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="myModalLabel1">Room Details</h5>
                       <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                           <i data-feather="x"></i>
                       </button>
                   </div>
                   <div class="modal-body">
                        <div class="form-group">
                            <label for="basicInput">Room name</label>
                            
                            <input type="text" class="form-control" id="basicInput" value="{{ $room->room_name }}" name="room_name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Adviser</label>
                            
                            <input type="text" class="form-control" id="basicInput" value="{{ $adviser->last_name }} {{ $adviser->first_name }} {{ $adviser->middle_name }}" name="room_name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="student_number">Target course</label>
                        
                            <select name="course_id" id="course_id" class="form-select" disabled>
                                @foreach (\App\Models\Course::all() as $course)
                                <option value="{{ $course->course_id }}" @if ($course->course_id == $room->course_id)
                                    selected
                                @endif>
                                    {{ $course->course_name }}
                                </option>
                                @endforeach
                            </select>
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