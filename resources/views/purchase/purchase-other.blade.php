@extends('dashboard-layout')
@section('content')
@section('title', 'Other Purchase')

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
                  <th>Tanggal</th>
                  <th>Item</th>
                  <th>Description</th>
                  <th>Total</th>
                  <th>Dibuat oleh</th>
                  <th>Action</th>

                </tr>
              </thead>
              <tbody> 
                @foreach ($purchase as $row)
                <tr>
                    <td>{{ $row->id_other_purchase }}</td>
                    <td width="15%">{{ date('d M Y', strtotime($row->created_at)) }}</td>
                    <td>{{ $row->items }}</td>
                    <td>{{ $row->description }}</td>
                    <td>{{ number_format($row->total) }}</td>
                    <td>{{ $row->created_by }}</td>

                    <td width="5%">
                      <ul class="nav">
                          <li><a href="javascript:void(0)" class="edit" style="margin:10px" data-id="{{ $row->id_other_purchase }}"><i class="fas fa-edit"></i></a></li>
                      </ul>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>  
<!---------- Add Pegawai Modal ---------->
<div class="modal fade" id="purchaseModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h4>Add Purchase</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">

    <form method="POST" action="{{ url('other_purchase/create') }}">   
        @csrf  
        <div class="col-md-12">
            <div class="col-md-3 offset-md-9 mt-2" style="text-align:right">
            </div>
              <div class="form-group row">
                  <label for="" class="col-sm-4" style ="color:black; margin-top:10px">Tanggal</label>
                  <div class="">
                    <input type="text" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" value="{{ date('d M, Y') }}" readonly>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="" class="col-sm-4" style ="color:black; margin-top:10px">Dibuat oleh</label>
                  <div class="">
                      <input type="text" class="form-control" id="created_by" name="created_by" value="{{ auth()->user()->name }}" readonly>
                  </div>
              </div>
              <div class="form-group">
                <label for="name" style="font-weight: 500">Item</label>
                <div>
                  <input type="text" class="form-control" id="item" name="item" value="" maxlength="50" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="name" style="font-weight: 500">Description</label>
                <div>
                  <textarea id="description" name="description" rows="3" cols="56"></textarea>
                </div>
              </div>      
              <div class="form-group">
                <label for="name" style="font-weight: 500;">Total</label>
                <div>
                  <input type="number" class="form-control" id="total" name="total">
                </div>
              </div>      
        </div>

        </form>
        <div class="form-group row">
            <div class="col-sm-3 offset-sm-9">
            <button class="btn btn-primary btnSubmit">Submit</button>
            </div>
        </div>
    </div>
    </div>
  </div>
</div>
<!-- Edit Pegawai Modal  -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h4>Edit Purchase</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">

        <div class="col-md-12">
            <div class="col-md-3 offset-md-9 mt-2" style="text-align:right">
            </div>
            <input type="text" id="editid" name="editid" value="" hidden>

              <div class="form-group row">
                  <label for="" class="col-sm-4" style ="color:black; margin-top:10px">Tanggal</label>
                  <div class="">
                    <input type="text" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" value="{{ date('d M, Y') }}" readonly>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="" class="col-sm-4" style ="color:black; margin-top:10px">Dibuat oleh</label>
                  <div class="">
                      <input type="text" class="form-control" id="editcreated_by" name="created_by" value="" readonly>
                  </div>
              </div>
              <div class="form-group">
                <label for="name" style="font-weight: 500">Item</label>
                <div>
                  <input type="text" class="form-control" id="edititem" name="item" value="" maxlength="50" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="name" style="font-weight: 500">Description</label>
                <div>
                  <textarea id="editdescription" name="description" rows="3" cols="56"></textarea>
                </div>
              </div>      
              <div class="form-group">
                <label for="name" style="font-weight: 500;">Total</label>
                <div>
                  <input type="number" class="form-control" id="edittotal" name="total">
                </div>
              </div>      
        </div>
        <div class="form-group row">
            <div class="col-sm-3 offset-sm-9">
            <button class="btn btn-primary btnSubmitEdit">Submit</button>
            </div>
        </div>
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
      //  $('#id').val(null);
       $('#purchaseModal').modal('show');
    });

    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
         
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('other_purchase/edit') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#editid').val(res.purchase.id_other_purchase);
              $('#edititem').val(res.purchase.items);
              $('#editdescription').val(res.purchase.description);
              $('#edittotal').val(res.purchase.total);
              $('#editcreated_by').val(res.purchase.created_by);
              $('#editModal').modal('show');

           }
        });
    });
    $('body').on('click', '.btnSubmitEdit', function (event) {
        var id = $("#editid").val();
        var item = $("#edititem").val();
        var description = $("#editdescription").val();
        var total = $("#edittotal").val();
        var created_by = $("#editcreated_by").val();

        $.ajax({
            type:"POST",
            url: "{{ url('other_purchase/update') }}",
            data: {
              id : id,
              item:item,
              description:description,
              total:total,
              created_by:created_by,
            },
            dataType: 'json',
            success: (response) => {
            swal({
                title: "Data Purchase Berhasil DiUpdate",
                icon: "success",
                button: "Ok",
            }).then(function(){
                location.href = "/other_purchase";

            });
        },
        });
    });
$('body').on('click', '.btnSubmit', function (event) {

      var item = $("#item").val();
      var description = $("#description").val();
      var total = $("#total").val();
      var created_by = $("#created_by").val();


        $.ajax({
            type:"POST",
            url: "{{ url('other_purchase/create') }}",
            data: {
              item:item,
              description:description,
              total:total,
              created_by:created_by,
            },
            dataType: 'json',
            success: (response) => {
            swal({
                title: "Data Purchase Berhasil DiTambahkan",
                icon: "success",
                button: "Ok",
            }).then(function(){
                location.href = "/other_purchase";

            });
        },
      });
});
    // $('body').on('click', '.btnSubmit', function (event) {

    //     var name = $("#nama").val();
    //     var email = $("#email").val();
    //     var password = $("#password").val();
    //     var tanggal_lahir = $("#tanggal_lahir").val();
    //     var alamat = $("#alamat").val();
    //     var role = $("#role").val();

    //     $.ajax({
    //         type:"POST",
    //         url: "{{ url('pegawai/create') }}",
    //         data: {
    //           name:name,
    //           email:email,
    //           password:password,
    //           tanggal_lahir:tanggal_lahir,
    //           alamat:alamat,
    //           role:role,

    //         },
    //         dataType: 'json',
    //         success: (response) => {
    //         swal({
    //             title: "Data Pegawai Berhasil DiTambahkan",
    //             icon: "success",
    //             button: "Ok",
    //         }).then(function(){
    //             location.href = "pegawai";

    //         });
    //     },
    //     });
    // });
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