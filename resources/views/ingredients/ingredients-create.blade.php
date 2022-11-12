@extends('dashboard-layout')
@section('content')

<link href="../css/tes.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>

/* #totalInput {
   border-width: 1px;
   border-color: #92827F;
   border-style: none none solid none;
} */
</style>
<form method="POST" name="transaction_form" id="transaction_form" action="{{ url('order/store') }}">   
@csrf  
<div class="col-md-12">
    <div class="card" style="background: #f5f5f5; padding:20px">
    <div class="form-group row">
        <label for="" class="col-sm-3 col-form-label" style ="color:black">Jenis Order</label>
        <div class="col-sm-3">
            <select name="jenis_order" id="jenis_order"class="form-control"style="">
                <option value="dine_in">Dine In</option>
                <option value="take_away">Take Away</option>
                <option value="lain_lain">Lain-lain</option>
            </select>
        </div>
        <label for="" class="col-sm-2" style ="text-align: center; color:black; margin-top:10px">Tanggal</label>
        <div class="col-sm-3">
            <a><input type="text" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" value="{{ date('d M, Y') }}" readonly></a>
        </div>
    </div>
    <!-- <div class="form-group row">   
        <label for="" class="col-sm-3" style ="color:black;">Jenis Pembayaran</label>
        <div class="col-sm-3">
            <select name="jenis_pembayaran" class="form-control"style="">
                <option value="Cash">Cash</option>
                <option value="Transfer">Transfer</option>
                <option value="Lain-lain">Lain-lain</option>
            </select>
        </div>

        <label for="" class="col-sm-2" style ="text-align: center; color:black;">Status Pembayaran</label>
        <div class="col-sm-3">
        <select name="status" class="form-control"style="">
            <option value="Lunas">Lunas</option>
            <option value="Belum Lunas">Belum Lunas</option>
            <option value="Lain-lain">Lain-lain</option>
        </select>
        </div>
    </div> -->
    <a href="#" id = "addButton" data-bs-target="#addModal" data-bs-toggle="modal" class = "btn btn-primary btn-info col-md-1">Add</a>
        <table id="table-checkout" class = "table" style = "margin-top: 10px">
            <thead>
                <tr>
                    <th></th>
                    <th>Nama Menu</th>
                    <th>Varian</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        
        <div id="total_harga" class="total_harga" style="text-align: right; margin-top:50px;">
            <b><a class="subtotal-td" style="color:black; font-size:18px; margin-right:100px"> Total</a></b>
            <input type="text" class="" id="total" name="total" value="" readonly>
        </div>
        <div style="text-align: right; margin-top:10px">
            <button type = "button" data-bs-target="#payNow" data-bs-toggle="modal" class="btn btn-primary btn-pay" style="">Pay Now</button>
            <button type="submit" class="btn btn-primary btn-submit" style="">Save</button>
        </div>
    </div>
</div>

</form>

<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Menu</h5>
        <button type="button" class = "close1" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <h5 class="ml-3 mt-1">Kategori</h5>
            <select  id="kategori" name="kategori" class="form-control col-md-2 ml-3 mb-2" onchange = "onSelect()">
                <option value = "all">All</option>
                @foreach($kategori as $row)
                    <option value="{{$row->id_kategori}}">{{$row->nama_kategori}}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            @foreach($menu as $row)
            <a href = "javascript:void(0)" class = "nama_menu mt-3" data-nama="{{ $row->nama_menu }}" data-bs-toggle="modal" data-bs-target="#addQty" style="color:black">
                <div class="card imageDiv {{$row->kategori_id_kategori}}" style="width: 10rem; margin-left:20px">
                    <img class="card-img-top" src="{{ $row->foto }}" style="width: 10rem; height: 8rem">
                        <div class="card-body">
                            <small class="card-title">{{$row->nama_menu}}</small>
                        </div>
                </div>
            </a>
            @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addQty" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Qty</h5>
        <button type="button" class = "close2" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="addQtyForm">
      <div class="modal-body">
        <div class="form-group">
            <label>Qty</label>
            <div class="row ml-1">
                <input type="text" id="qty" class="form-control col-md-1" value = "1" name="qty" readonly>
                <a href="#" onclick="increment()"><img src="symbols/plus.png" style="width:42px;height:42px;"></a>
                <a href="#" onclick="decrement()"><img src="symbols/minus.png" style="width:20px;height:42px;"></a>
            </div>
        </div>
        <div class="form-group">
            <label>Varian Harga</label>
            <select id="inputVarian" name="varian" class="form-control col-md-4" onchange = "selectVarian()">
            </select>        
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="text" class="form-control" id="harga" name="harga" readonly>
        </div>
      </div>
    </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-add">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="payNow" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pay</h5>
        <button type="button" class = "close2" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
            <label for="" class="col-md-2" style ="color:black;">Jenis Pembayaran</label>
                <div class="col-md-5 offset-md-4">
                    <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-control" onchange = "bayarToggle()">
                        <option selected disabled></option>
                        <option value="Cash">Cash</option>
                        <option value="Transfer">Transfer</option>
                        <option value="Lain-lain">Lain-lain</option>
                    </select>
                </div>
        </div>
        <div class="form-group row" id="toggleBayar" style="display:none">
            <label class="col-md-2">Bayar</label>
            <input type="text" class="form-control col-md-5 offset-md-4" id="bayar" name="bayar" oninput="getKembalian()" onfocusout="formatNumber()">
        </div>
        <div class="form-group row" id="toggleKembalian" style="display:none">
            <label class="col-md-2">Kembalian</label>
            <h5 type="text" class="form-control col-md-5 offset-md-4" id="kembalian"></h5>
        </div>
        <div class="col-md-1 offset-md-10">
            <button type="button" class="btn btn-primary btn-pay-save">Save</button>
        </div>
        <hr>


        <div class="col-md-6 offset-md-4">
            <b id="totalInput" style="font-size: 20px"></b>
        </div>
        


      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="{{ asset('js/transaction.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">

$(document).on('click', '.btn-pay', function(e){
    var total = document.getElementById("total").value;
    var formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
    }).format(total);

    console.log(formatter);
    document.getElementById("totalInput").innerText = formatter;

});

function bayarToggle() {
  var x = document.getElementById("jenis_pembayaran").value;
  console.log(x);
  if (x === "Cash") {
    $("#toggleBayar").show();
    $("#toggleKembalian").show();

  } else {
    $("#toggleBayar").hide();
    $("#toggleKembalian").hide();
  }
}
function getKembalian() {
  let total = document.getElementById("total").value
  let bayar = document.getElementById("bayar").value;
  var format = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
    }).format(bayar-total);
  document.getElementById("kembalian").innerText = format;

}
function formatNumber() {
  let x = document.getElementById("bayar").value;
//   if(typeof(x) !== 'string'){
    var format = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
    }).format(x);
    document.getElementById("bayar").value = format;
//   }
}
$(document).on('click', '.btn-pay-save', function(e){
    $(this).html('Sending..');

    var total = document.getElementById("total").value;
    var jenis_order = document.getElementById("jenis_order").value;
    var jenis_pembayaran = document.getElementById("jenis_pembayaran").value;
    var status_pembayaran = "Lunas";
    var nama_menu =[];
    var qty =[];
    var varian =[];

    var tempInput = document.getElementsByName('nama_menu[]');
    var tempQty = document.getElementsByName('qty[]');
    var tempVarian = document.getElementsByName('varian[]');

    for (var i = 0; i <tempInput.length; i++) {
        nama_menu[i] = tempInput[i].value;
        qty[i] = tempQty[i].value;
        varian[i] = tempVarian[i].value;

    }

    $.ajax({
        type:"POST",
        url: "/order/store",
        data: {total : total,
               jenis_order : jenis_order,
               jenis_pembayaran : jenis_pembayaran,
               status : status_pembayaran,
               nama_menu : nama_menu,
               qty : qty,
               varian : varian
        },
        dataType: 'json',
        success: (response) => {
            swal({
                title: "Order Has Been Completed !",
                text: "created by Alvin",
                icon: "success",
                button: "Ok",
            }).then(function(){
                location.href = "order";
            });
        },
    });

});
</script>