@extends('dashboard-layout')
@section('content')
@section('title', 'MENU')

<link href="../css/tes.css" rel="stylesheet" type="text/css">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<div class="card mt-2" style="background-color: #D3D3D8; border-radius: 20px;">
    <select  id="kategoriFilter" name="kategori" class="form-control col-md-2 ml-4 mt-3" onchange = "onSelect()">
        <option value = "all">All</option>
        @foreach($kategori as $row)
            <option value="{{$row->nama_kategori}}">{{$row->nama_kategori}}</option>
        @endforeach
    </select>
    <div class="row">
    @foreach($menu as $row)
        <div class="card imageDiv {{$row->kategori_id_kategori}} mt-4 mb-3" style="width: 12rem; margin-left:50px;">
            <img class="card-img-top" src="{{ $row->foto }}" style="width: 11rem; height: 10rem">
            <div class="card-body" style="text-align: center">
                <h5 class="card-title">{{$row->nama_menu}}</h5>
                <small style="color:black" class="card-text">Rp. {{ number_format($row->harga,0,',','.') }}</small>
                <p class="card-title mt-2">Stok : {{number_format($row->stok) }}</p>
            </div>
        </div>
    @endforeach
</div>
</div>

<!-- Add Menu Modal  -->
<div class="modal fade" id = "ajax-model" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="ajaxModel"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addEditForm" name="addEditForm" method="POST" enctype="multipart/form-data">
            @csrf
          <input type="hidden" name="id" id="id">
            <div class="form-group">
                <label>Nama Menu</label>
                <input type="text" id="nama_menu" class="form-control" name="nama_menu">
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
                <label>Harga</label>
                <span><small><a class ="ml-5" href="javascript:void(0)" id="add-harga">Tambah Varian Harga</a></small></span>
                <div class="card" style="background-color:#EAEAEA; padding: 10px; border:none">
                  <div id="divHarga"></div>
                </div>

            </div>
            <div class="form-group">
                <label>Ingredient</label>
                <select  id="ingredients" name="ingredients" class="form-control add_ingredient">
                @foreach($ingredient as $row)
                    <option value="{{$row->nama}}">{{$row->nama}}</option>
                @endforeach
                </select>
            </div>
            <div class="card" style="background-color:#EAEAEA; padding: 10px; border:none">
            <div id="ingredient-list">
                <label>Ingredient Servings</label>
                <hr>
            </div>
            </div>

            <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button> 

      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="addQty" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Menu</h5>
        <button type="button" class = "close2" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Qty</label>
            <div class="row ml-1">
                <input type="text" id="qty" class="form-control col-md-3" value = "1" name="qty">
            </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
var activeCat = "";
var ingredient;

function onSelect() {
    var category = document.getElementById("kategoriFilter").value;
    filterGroup(category);
}
function filterGroup(category){
    
    if(category == "all"){
        return $(".imageDiv").show();
    }
    if(activeCat != category){

        $(".imageDiv").filter("."+category).show();
        $(".imageDiv").filter(":not(."+category+")").hide();
        activeCat = category;
    }

}

</script>
@endsection