<!--Basic Modal -->
<div class="modal fade text-left" id="add-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
aria-hidden="true">
    <form action="{{ route('superadmin-store') }}" method="post">
        @csrf
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Add New User</h5>
                    <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="basicInput">Email</label>
                        <strong class="text" style="color:red">*</strong>
                        <input type="email" class="form-control" id="basicInput" placeholder="Email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Account Role</label>
                        <strong class="text" style="color:red">*</strong>
                        <select name="applying_as" id="applying_as" class="form-select" required>
                                <option value="Adviser">Adviser</option>
                                <option value="OJT Coordinator">OJT Coordinator</option>
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
                        <span class="d-none d-sm-block">Add</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>