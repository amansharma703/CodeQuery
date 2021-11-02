
<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Signup for an CodeQuery Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/forum/partials/_handleSignup.php" method="post">
          <!-- <div class="form-group">
            <label for="name">Name</label>
            <input type="name" class="form-control" id="username" name="username">
          </div> -->
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" id="signupEmail" name="signupEmail" aria-describedby="emailHelp">
          </div>
         
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="signupPassword" name="signupPassword">
          </div>
          <div class="form-group">
            <label for="cexampleInputPassword1">Confirm Password</label>
            <input type="password" class="form-control" id="signupcPassword" name="signupcPassword">
          </div>
          
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>