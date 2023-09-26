 <!--Basic Modal -->
 <div class="modal fade text-left" id="edit-course{{ $course->course_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
       <form action="{{ route('superadmin-courses-update', $course->course_id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="modal-dialog modal-dialog-scrollable" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="myModalLabel1">Update course</h5>
                       <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                           <i data-feather="x"></i>
                       </button>
                   </div>
                   <div class="modal-body">
                    <div class="form-group">
                        <label for="basicInput">Course Name</label>
                        <strong class="text" style="color:red">*</strong>
                        <input type="text" class="form-control" id="course_name" placeholder="Course Name" name="course_name" value="{{ $course->course_name }}" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Acronym</label>
                        <strong class="text" style="color:red">*</strong>
                        <input type="text" class="form-control" id="course_abb" placeholder="Acronym" name="course_abb" value="{{ $course->course_abb }}" required>
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