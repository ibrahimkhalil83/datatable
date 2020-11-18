<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

     <style type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"></style>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Ajax Crud</title>
  </head>
<body>


<div class="container">
	<br><br>
	<a data-toggle="modal" data-target="#modelId" class="btn btn-sm btn-danger text-white" style="float: right;">Add New</a>

	<table id="post-table"  class="table table-striped">
		<thead>
			<tr>
			  <th width="30">No</th>
              <th>Name</th>
              <th>Roll</th>
              <th>Phone</th>
              <th>Action</th>
			</tr>
		</thead>
		<tbody>

		</tbody>
	</table>
</div>

<!-- Create Student Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="contact-form">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" id="name">
                            <span class="text-danger" id="name-error"></span>
                        </div>

                        <div class="form-group">
                            <input type="text" name="mobile_number" class="form-control" placeholder="Enter Mobile Number" id="mobile_number">
                            <span class="text-danger" id="mobile-number-error"></span>
                        </div>

                        <div class="form-group">
                            <input type="text" name="roll" class="form-control" placeholder="Enter roll" id="roll">
                            <span class="text-danger" id="roll-error"></span>
                        </div>


                        <div class="form-group">
                            <button class="btn btn-success" id="submit">Submit</button>
                        </div>
                        <div class="form-group">
                            <b><span class="text-success" id="success-message"> </span><b>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Edit Modal  --}}
<!-- Modal -->
<div class="modal fade" id="editModalForm" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="edit-student-form">
                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <input type="text" name="edit_name" class="form-control" placeholder="Enter Name" id="edit_name">
                            <span class="text-danger" id="edit-name-error"></span>
                        </div>

                        <div class="form-group">
                            <input type="text" name="edit_mobile_number" class="form-control" placeholder="Enter Mobile Number" id="edit_mobile_number">
                            <span class="text-danger" id="edit-mobile-number-error"></span>
                        </div>

                        <div class="form-group">
                            <input type="text" name="edit_roll" class="form-control" placeholder="Enter roll" id="edit_roll">
                            <span class="text-danger" id="edit-roll-error"></span>
                        </div>


                        <div class="form-group">
                            <button class="btn btn-success" id="submit">Submit</button>
                        </div>
                        <div class="form-group">
                            <b><span class="text-success" id="success-message"> </span><b>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Create Contact
        $('#contact-form').on('submit', function(event){
            event.preventDefault();
            $('#name-error').text('');
            $('#mobile-number-error').text('');
            $('#roll-error').text('');

            var form=$("#contact-form");
            $.ajax({
              url:"{{ url('student/') }} ",
              type: "POST",
              data:form.serialize(),
              success:function(res){
                  $('#modelId').modal('hide');
                  $('#modelId form')[0].reset();
                  table1.ajax.reload();
                  swal({
                    title: "Good job!",
                    text: "Data inserted successfully!",
                    icon: "success",
                    button: "Great!",
                });
              },

              error:function(res){
                  console.log(res);
                  $('#name-error').text(res.responseJSON.errors.name);
                $('#mobile-number-error').text(res.responseJSON.errors.mobile_number);
                $('#roll-error').text(res.responseJSON.errors.roll);

              }


            })


        })

        // Edit Data

        function editData(id){
            $('#editModalForm').modal('show');
            $.ajax({
              url: "{{ url('student/') }}" + "/" +id + "/edit",
              type: "get",
              success:function(data){
                $('.modal-title').text('Edit DAta');
                $('#edit_name').val(data.name);
                $('#id').val(data.id);
                $('#edit_mobile_number').val(data.phone);
                $('#edit_roll').val(data.roll);
              }
            })
        }




        $('#edit-student-form').on('submit', function(event){
            event.preventDefault();
            var id=$("#id").val();

            $('#edit-name-error').text('');
            $('#edit-mobile-number-error').text('');
            $('#edit-roll-error').text('');

            var form=$("#edit-student-form");
            $.ajax({
              url:"{{ url('student') }}" +"/" +id,
              type: "PATCH",
              data:form.serialize(),
              success:function(res){
                  console.log(res);
                  $('#editModalForm').modal('hide');
                  $('#editModalForm form')[0].reset();
                  table1.ajax.reload();
                  swal({
                    title: "Good job!",
                    text: "Data inserted successfully!",
                    icon: "success",
                    button: "Great!",
                });
              },

              error:function(res){
                  $('#edit-name-error').text(res.responseJSON.errors.edit_name);
                $('#edit-mobile-number-error').text(res.responseJSON.errors.edit_mobile_number);
                $('#edit-roll-error').text(res.responseJSON.errors.edit_roll);

              }


            })

        })



        // Delete Data
        function deleteData(id){
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((res)=>{
                if(res){
                    $.ajax({
                        url : "{{ url('student') }}" + '/' + id,
                        type : "POST",
                        data : {'_method' : 'DELETE'},
                        success : function(data) {
                            table1.ajax.reload();
                            swal({
                                title: "Delete Done!",
                                text: "You clicked the button!",
                                icon: "success",
                                button: "Done",
                            });
                        },
                        error : function () {
                            swal({
                                title: 'Oops...',
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });
                }else{
                    swal("Your imaginary file is safe!");
                }
            })

        }

        // Load DAta
        var table1 = $('#post-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('all.student') }}",
            columns: [
              {data:'id', name:'id'},
              {data:'name', name:'name'},
              {data:'roll', name:'roll'},
              {data:'phone', name:'phone'},
              {data:'action', name:'action', orderable: false, searchable: false}
            ]
        })



        </script>



</body>
</html>
