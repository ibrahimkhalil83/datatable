<!--Data Insert modal here-->
<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        </div>
        <div class="modal-body">
         <form method="post" data-toogle="validator">
             @csrf {{ method_field('POST') }}
           <div class="form-group">
           <input type="hidden" name="id" id="id">
             <label for="exampleInputEmail1">Title</label>
             <input type="text" class="form-control" name="name" id="name" placeholder="Title" required="" autofocus="">
           </div>
           <div class="form-group">
             <label for="exampleInputEmail2">Email </label>
             <input type="text" class="form-control" name="email" id="email" placeholder="Email" required="" autofocus="">
           </div>
           <div class="form-group">
             <label for="exampleInputEmail21">Phone </label>
             <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" required="" autofocus="">
           </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="insertbutton"></button>
        </div>
        </form>
      </div>
    </div>
  </div>
