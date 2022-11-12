@extends('dashboard-layout')
@section('content')

<link href="../css/tes.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>

</style>
<form method="POST" name="transaction_form" id="transaction_form" action="{{ url('purchase/create') }}">   
@csrf  
<div class="col-md-8 offset-md-2">
    <div class="card" style="background: #f5f5f5; padding:20px">
    <div class="form-group row">
        <label for="" class="col-sm-3 col-form-label" style ="color:black">Jenis Pembayaran</label>
        <div class="col-sm-3">
            <select name="jenis_pembayaran" class="form-control"style="">
                <option value="Cash">Cash</option>
                <option value="Transfer">Transfer</option>
                <option value="Lain-lain">Lain-lain</option>
            </select>
        </div>
        <label for="" class="col-sm-2" style ="text-align: center; color:black; margin-top:10px">Tanggal</label>
        <div class="col-sm-3">
            <a><input type="text" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" value="{{ date('d M, Y') }}" readonly></a>
        </div>
    </div>
    <a href="#" id = "addButton" data-bs-target="#addModal" data-bs-toggle="modal" class = "btn btn-primary btn-info col-md-1">Add</a>
        <table id="table-checkout" class = "table" style = "margin-top: 10px">
            <thead>
                <tr>
                    <th></th>
                    <th>Nama Ingredient</th>
                    <th>Qty</th>
                    <!-- <th>Satuan</th> -->
                    <th style ="text-align: center;">Subtotal</th>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        
        <div id="total_harga" class="total_harga" style="text-align: right; margin-top:50px;">
            <b><a class="subtotal-td" style="color:black; font-size:18px; margin-right:100px;"> Total</a></b>
            <span>Rp.</span><input type="text" class="" id="total" name="total" value="" style="border-style:none" readonly>
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
            @foreach($ingredients as $row)
            <a href = "javascript:void(0)" class = "nama_menu mt-3" data-nama="{{ $row->nama }}" data-bs-toggle="modal" data-bs-target="#addQty" style="color:black">
                <div class="card imageDiv {{$row->kategori_id_kategori}}" style="width: 10rem; margin-left:20px">
                    <div class="card-body">
                        <small class="card-title">{{$row->nama}}</small>
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
        <div class="form-group row">
            <label class="col-md-2 mt-2">Qty</label>
            <input type="text" class="form-control col-md-4" id="qty" name="qty">
            <label class="col-md-2 mt-2">Gram</label>
        </div>
        <div class="form-group row">
            <label class="col-md-2 mt-2">Subtotal</label>
            <input type="text" class="form-control col-md-6" id="subtotal" name="subtotal">
        </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-add">Add</button>
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
<script src="{{ asset('js/purchase.js') }}"></script>
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
@endsection