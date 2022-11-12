@extends('dashboard-layout')
@section('content')
@section('title', 'Advanced Menu')

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
  .modalBlur{
    filter: brightness(50%);
  }
  </style>
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
                <th>Kategori</th>
                <th>Description</th>
                <th>Foto</th>
                <th>Action</th>

            </tr>
            </thead>
            <tbody> 
            @foreach ($menu as $row)
            <tr>
                <td>{{ $row->id_menu }}</td>
                <td>{{ $row->nama_menu }}</td>
                <td>{{ $row->kategori_id_kategori }}</td>
                <td>{{ $row->description }}</td>

                <td><img  src="{{ $row->foto }}" width="80" height="80"></td>

                <td width="8%">
                    <ul class="nav">
                        <li><a href="javascript:void(0)" class="edit" style="" data-id="{{ $row->id_menu }}"><i class="fas fa-edit"></i></a></li>
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
<!---------- Add Menu Modal ---------->
<div class="modal fade" id = "ajax-model">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="ajaxModel"></h4>

      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <form id="addEditForm" name="addEditForm" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id">
        <div class="form-group">
            <label>Nama Menu</label>
            <input type="text" id="nama_menu" class="form-control" name="nama_menu">
        </div>
        <div class="form-group">
            <label>Description</label>
            <input type="text" id="description" class="form-control" name="description">
        </div>
        <div class="form-group">
            <label>Foto</label>
            <input type="file" class="form-control" name="file">
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select  id="kategori" name="kategori" class="form-control">
            @foreach($kategori as $row)
                <option value="{{$row->nama_kategori}}">{{$row->nama_kategori}}</option>
            @endforeach
            </select>
        </div>
        <div class="form-group">
          <label class="col-md-4" style="padding:0px">Receipts</label>
          <button type="button" class="btn btn-primary col-md-3 btn-sm ml-3" id="btnAddIng">Add Ingredient</button> 
        </div>
        <div id="receipts">
          <hr>
        </div>
        <hr>

        <div class="form-group">
          <label class="col-md-4" style="padding:0px">Price Variant</label>
          <button type="button" class="btn btn-primary col-md-3 btn-sm ml-3" id="add-harga">Add Variant</button> 
        </div>
        <div id="divHarga">
          <hr>
        </div>
        <button type="submit" class="btn btn-primary col-md-3 offset-md-9" id="btn-save">Submit</button> 

        </form>

      </div>
    </div>
  </div>
</div>
<!-- add receipts modal -->
<div class="modal fade" id="addIngNew" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Receipts</h5>
        <button type="button" class = "close2" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input list="addTes" id="data-ing" class="form-control col-md-12" placeholder="Search Ingredient.." oninput="onInput()">
          <datalist  id="addTes">
          @foreach($ingredient as $row)
            <option value="{{$row->nama}}">
          @endforeach
          </datalist>

      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="addIngNew2" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Receipts</h5>
        <button type="button" class = "close2" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="col-md-12 row">
            <h6 class="col-md-4">Ingredient</h5>
            <h6 class="col-md-4" style="form-control">Quantity</h5>
            <h6 class="col-md-4">Unit</h5>
          </div>
          <div class="col-md-12 row">
            <div class="form-control col-md-4" id="name_ing"></div>
            <input type="number" class="form-control col-md-4" id="quantity">
            <div class="form-control col-md-4">Gram</div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-add-ingredient">Add Ingredient</button>
      </div>
    </div>
  </div>
</div>

<!-- Add harga Modal -->
<div class="modal fade" id="addHarga" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Harga</h5>
        <button type="button" class = "close2" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Varian</label>
            <input type="text" class="form-control col-md-6" id="varian" name="varian">
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="text" class="form-control col-md-6" id="harga" name="harga">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-add-harga">Submit</button>
      </div>
    </div>
  </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="{{ asset('js/add-ingredient.js') }}"></script>

<script type="text/javascript">
function onInput() {

  var nama = $('#data-ing').val();
  console.log(nama);

  document.getElementById("name_ing").textContent = nama;  

  $('#addIngNew').modal('hide');
    
  $('#addIngNew2').modal('show');
}
 $(document).ready(function($){

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#addButton').click(function () {
       $('#addEditForm').trigger("reset");
       $('#ajaxModel').html("Add Menu");
       $('#receipts').empty();
       $('#divHarga').empty();
       $('#id').val(null);
       $('#ajax-model').modal('show');
    });
    $('#btnAddIng').click(function () {
      $('#ajax-model').addClass('modalBlur');
      document.getElementById('data-ing').value = ''
       $('#addIngNew').modal('show');

    });
    // $('body').on('change', '#addTes', function () {
    //   var nama = $(this).data('ing');
    //   document.getElementById("name_ing").textContent = nama;  

    //   $('#addIngNew').modal('hide');
        
    //   $('#addIngNew2').modal('show');

    // });
    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
        $('.ingredient').remove();
        $('.harga').remove();

        $.ajax({
            type:"POST",
            url: "{{ url('menu/edit') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              console.log(res);
              $('#addEditForm').trigger("reset");
              $('#receipts').empty();
              $('#divHarga').empty();
              $('#ajaxModel').html("Edit Menu");
              $('#ajax-model').modal('show');
              $('#id').val(res.menu.id_menu);
              $('#nama_menu').val(res.menu.nama_menu);
              $('#description').val(res.menu.description);
              $('#harga').val(res.menu.harga);
              $("#kategori option[value='"+res.menu.kategori+"']").attr('selected', 'selected');
              res.ingredient.forEach(ingredient_detail);
              res.varian_harga.forEach(varian_harga);
           }
        });
    });
    $('#receipts').on('click', '#delete', function () {
        var id = $(this).data('id');
        $(this).closest(".row").remove();
        $.ajax({
            type:"POST",
            url: "{{ url('deleteDM') }}",
            data: { id: id },
            dataType: 'json',
            success: function(){
            }
        });
      });
      $('#divHarga').on('click', '#delete', function () {
        var id = $(this).data('id');
        console.log(id);
        $(this).closest(".row").remove();
        $.ajax({
            type:"POST",
            url: "{{ url('deleteHarga') }}",
            data: { id: id },
            dataType: 'json',
            success: function(){
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