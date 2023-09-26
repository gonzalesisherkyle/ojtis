 <!--Basic Modal -->
 <div class="modal fade text-left" id="add-course" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
       <form action="{{ route('superadmin-courses-store') }}" method="post">
           @csrf
          
           <div class="modal-dialog modal-dialog-scrollable" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="myModalLabel1">Add new course</h5>
                       <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                           <i data-feather="x"></i>
                       </button>
                   </div>
                   <div class="modal-body">
                        <div class="form-group">
                            <label for="basicInput">Course Name</label>
                            <strong class="text" style="color:red">*</strong>
                            <input type="text" class="form-control" id="course_name" placeholder="Course Name" name="course_name" autofocus required>
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Acronym</label>
                            <strong class="text" style="color:red">*</strong>
                            <input type="text" class="form-control" id="course_abb" placeholder="Acronym" name="course_abb" required>
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