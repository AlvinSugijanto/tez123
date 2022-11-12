@extends('dashboard-layout')
@section('content')
@section('title', 'Pegawai')

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div class="row">
    <div class="col-md-3 mb-2">
      <button type="button" id = "addButton" class="btn btn-primary">Add New</button>
    </div>
</div>
<div class="card">

    <div class="card-body">
            <table class="table table-bordered" id="dataTable">
              <thead style="background-color:#E5E4E2">
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Tanggal Lahir</th>
                  <th>Alamat</th>
                  <th>Role</th>
                  <th>Action</th>

                </tr>
              </thead>
              <tbody> 
                @foreach ($pegawai as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->email }}</td>
                    <td width="15%">{{ date('d M Y', strtotime($row->tanggal_lahir)) }}</td>
                    <td>{{ $row->alamat }}</td>
                    <td>{{ $row->role }}</td>
                    <td width="8%">
                      <ul class="nav">
                          <li><a href="javascript:void(0)" class="edit" style="margin:10px" data-id="{{ $row->id }}"><i class="fas fa-edit"></i></a></li>
                          <form method="POST" action="ingredients/delete/{{$row->id_ingredient}}">
                              @csrf
                              <li><a href="javascript:void(0)" style="margin:10px;color:red"><i class="fas fa-trash show_confirm"></i></a></li>                          
                          </form>
                      </ul>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>  
<!---------- Add Pegawai Modal ---------->
<div class="modal fade" id="ajax-model" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="ajaxModel"></h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="javascript:void(0)" enctype="multipart/form-data" id="formPegawai" >
        <div class="form-group row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" placeholder="Email" name="email">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
            </div>
        </div>
        <div class="form-group form-group-lg row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <textarea id="alamat" name="alamat" rows="4" cols="48"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
                <select  id="role" name="role" class="form-control">
                    <option value = "Owner">Owner</option>
                    <option value = "Manajer">Manajer</option>
                    <option value = "Pegawai">Pegawai</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3 offset-sm-9">
            <button class="btn btn-primary btnSubmit">Submit</button>
            </div>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
<!-- Edit Pegawai Modal  -->
<div class="modal fade" id="edit-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="editModel"></h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="javascript:void(0)" enctype="multipart/form-data">
        <div class="form-group row">
          <input type="text" id="editid" name="id" hidden>
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="editnama" placeholder="Nama" name="nama">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="editemail" placeholder="Email" name="email">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="edittanggal_lahir" name="tanggal_lahir">
            </div>
        </div>
        <div class="form-group form-group-lg row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <textarea id="editalamat" name="alamat" rows="4" cols="48"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
                <select  id="editrole" name="role" class="form-control">
                    <option value = "Owner">Owner</option>
                    <option value = "Manajer">Manajer</option>
                    <option value = "Pegawai">Pegawai</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3 offset-sm-9">
            <button class="btn btn-primary btnSubmitEdit">Submit</button>
            </div>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
 $(document).ready(function($){

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#addButton').click(function () {
       $('#addEditForm').trigger("reset");
       $('#ajaxModel').html("Add Pegawai");
       $('#id').val(null);
       $('#ajax-model').modal('show');
    });

    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
         
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('pegawai/edit') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#editModel').html("Edit Pegawai");
              $('#edit-modal').modal('show');
              $('#editid').val(res.pegawai.id);
              $('#editnama').val(res.pegawai.name);
              $('#editemail').val(res.pegawai.email);
              $('#edittanggal_lahir').val(res.pegawai.tanggal_lahir);
              $('#editalamat').val(res.pegawai.alamat);
              $("#editrole option[value='"+res.pegawai.role+"']").attr('selected', 'selected');

           }
        });
    });
    $('body').on('click', '.btnSubmitEdit', function (event) {
        var id = $("#editid").val();
        var name = $("#editnama").val();
        var email = $("#editemail").val();
        var tanggal_lahir = $("#edittanggal_lahir").val();
        var alamat = $("#editalamat").val();
        var role = $("#editrole").val();

        $.ajax({
            type:"POST",
            url: "{{ url('pegawai/update') }}",
            data: {
              id : id,
              name:name,
              email:email,
              tanggal_lahir:tanggal_lahir,
              alamat:alamat,
              role:role,
            },
            dataType: 'json',
            success: (response) => {
            swal({
                title: "Data Pegawai Berhasil DiUpdate",
                icon: "success",
                button: "Ok",
            }).then(function(){
                location.href = "pegawai";

            });
        },
        });
    });
$('body').on('click', '.btnSubmit', function (event) {

      var name = $("#nama").val();
      var email = $("#email").val();
      var password = $("#password").val();
      var tanggal_lahir = $("#tanggal_lahir").val();
      var alamat = $("#alamat").val();
      var role = $("#role").val();

        $.ajax({
            type:"POST",
            url: "{{ url('pegawai/create') }}",
            data: {
              name:name,
              email:email,
              password:password,
              tanggal_lahir:tanggal_lahir,
              alamat:alamat,
              role:role,

            },
            dataType: 'json',
            success: (response) => {
            swal({
                title: "Data Pegawai Berhasil DiTambahkan",
                icon: "success",
                button: "Ok",
            }).then(function(){
                location.href = "pegawai";

            });
        },
      });
});
    $('body').on('click', '.btnSubmit', function (event) {

        var name = $("#nama").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var tanggal_lahir = $("#tanggal_lahir").val();
        var alamat = $("#alamat").val();
        var role = $("#role").val();

        $.ajax({
            type:"POST",
            url: "{{ url('pegawai/create') }}",
            data: {
              name:name,
              email:email,
              password:password,
              tanggal_lahir:tanggal_lahir,
              alamat:alamat,
              role:role,

            },
            dataType: 'json',
            success: (response) => {
            swal({
                title: "Data Pegawai Berhasil DiTambahkan",
                icon: "success",
                button: "Ok",
            }).then(function(){
                location.href = "pegawai";

            });
        },
        });
    });
    $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
});
</script>
@endsection