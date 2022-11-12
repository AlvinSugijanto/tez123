@extends('dashboard-layout')
@section('content')
@section('title', 'INGREDIENTS')

<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<button type="button" id = "addButton" class="btn btn-primary">Add New</button>

<div class="card">
    <div class="card-body">
            <table class="table table-bordered" id="dataTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>Qty</th>
                  <th>Satuan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody> 
                @foreach ($ingredient as $row)
                <tr>
                    <td>{{ $row->id_ingredient }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->ukuran }}</td>
                    <td>{{ $row->satuan }}</td>
                    <td width="9%">
                      <ul class="nav">
                          <li><a href="javascript:void(0)" class="edit" style="margin:10px" data-id="{{ $row->id_ingredient }}"><i class="fas fa-edit"></i></a></li>
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
<!---------- Add Ingredient Modal ---------->
<div class="modal fade" id="ajax-model" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="ajaxModel"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="javascript:void(0)" id="addEditForm" name="addEditForm" class="form-horizontal" method="POST">
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label for="name">Ingredients Name</label>
            <div>
              <input type="text" class="form-control" id="nama" name="nama" value="" maxlength="50" required="">
            </div>
          </div>
            
          <center><button type="submit" class="btn btn-primary" id="btn-save" value="addNewBook">Save changes</button></center>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
<!-- Add Stok Modal -->
<div class="modal fade" id="add-stok-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Stok</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="javascript:void(0)" id="addEditForm" name="addEditForm" class="form-horizontal" method="POST">
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label for="name">Qty</label>
            <div class="row">
              <input type="text" class="form-control col-md-4 ml-3" id="qty" name="qty" value=""required="">
              <small class="mt-2 ml-2">Gram</small>
            </div>
          </div>
          <center><button type="submit" class="btn btn-primary" id="btn-add-stok" value="addNewBook">Save changes</button></center>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
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
       $('#ajaxModel').html("Add Ingredient");
       $('#id').val(null);
       $('#ajax-model').modal('show');
    });

    $('body').on('click', '#add_stok', function () {
      var id = $(this).data('id');
       $('#id').val(id);
    });

    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
         
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('ingredients/edit') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#ajaxModel').html("Edit Ingredient");
              $('#ajax-model').modal('show');
              $('#id').val(res.id_ingredient);
              $('#nama').val(res.nama);
           }
        });
    });
    $('body').on('click', '.add', function () {
        var id = $(this).data('id');
         
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('ingredients/edit') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#ajaxModel').html("Edit Ingredient");
              $('#ajax-model').modal('show');
              $('#id').val(res.id_ingredient);
              $('#nama').val(res.nama);
           }
        });
    });
    $('body').on('click', '#btn-save', function (event) {
          var id = $("#id").val();
          var nama = $("#nama").val();
         
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('ingredients/store') }}",
            data: {
              id:id,
              nama:nama
            },
            dataType: 'json',
            success: function(res){
             window.location.reload();
            $("#btn-save").html('Submit');
            $("#btn-save"). attr("disabled", false);
           }
        });
    });
    $('body').on('click', '#btn-add-stok', function (event) {
          var id = $("#id").val();
          let qty = $("#qty").val();
         
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('ingredients/store') }}",
            data: {
              id:id,
              ukuran:qty
            },
            dataType: 'json',
            success: function(res){
             window.location.reload();
           }
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