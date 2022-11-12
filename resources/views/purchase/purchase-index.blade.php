@extends('dashboard-layout')
@section('content')
@section('title', 'PURCHASE')

<link href="../css/tes.css" rel="stylesheet" type="text/css">



<div class="row">
    <div class="col-md-3 mb-2">
        <a href="#" data-bs-target="#purchaseModal" data-bs-toggle="modal" class="btn btn-primary">Add New</a>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jenis Pembayaran</th>
                    <th>Total</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchase as $row)
                    <tr>
                        <td width="5%">{{ $row->id_purchase }}</td>
                        <td width="10%">{{ date('l, d M Y', strtotime($row->created_at)) }}</td>
                        <td width="5%">{{ $row->jenis_pembayaran }}</td>
                        <td width="10%">Rp. {{number_format($row->total, 0 ,",", ".") }}</td>
                        <td width="5%">{{ $row->created_by }}</td>
                        <td width="1%">
                            <a href="javascript:void(0)" style="color:black" class="btn-show" data-id="{{ $row->id_purchase }}"><i class="fas fa-eye"></i></a></li>                          
                        </td>

                    </tr>
                 @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="purchaseModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
    <form method="POST" name="transaction_form" id="transaction_form" action="{{ url('purchase/create') }}">   
        @csrf  
        <div class="col-md-12">
            <div class="col-md-3 offset-md-9 mt-2" style="text-align:right">
                <label for="" class="" style ="color:black">Created By <b>{{ auth()->user()->name }}</b></label>
                <input type="text" name="created_by" value="{{ auth()->user()->name }}" hidden>
                <input type="text" name="jenis_stok" value="in" hidden>

            </div>
            <div class="container" style="padding:20px">
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
                
                <div id="total_harga" class="total_harga" style="text-align: right; margin-top:50px; margin-right:94px">
                    <b><a class="subtotal-td" style="color:black; font-size:18px; margin-right:50px;"> Total</a></b>
                    <span>Rp.</span><input type="text" class="col-md-1" id="total" name="total" value="" style="border-style:none; text-align: center;" readonly>
                </div>
                <div style="text-align: right; margin-top:10px">
                    <button class="btn btn-primary btn-submit" style="">Submit</button>
                </div>
            </div>
        </div>

        </form>
    </div>
  </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Ingredient</h5>
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
        </div>
        </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-add">Add</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Details</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table" id="detailTable">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Quantity</th>
                    <th>Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody id="tableBody">
            </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="{{ asset('js/purchase.js') }}"></script>
<script type="text/javascript">
$(document).ready(function($){

    $('body').on('click', '.btn-show', function () {
        var id = $(this).data('id');

        $.ajax({
            type:"POST",
            url: "{{ url('purchase/show') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
                $("#tableBody").empty()
                res.detail.forEach(appendData);
                $('#detailModal').modal('show');

           }
        });    
    });
});
function appendData(detail){
    const formatted = detail.subtotal.toLocaleString('id-ID');

    var tambah_data = '<tr><td>'+detail.ingredients_id_ingredient+'</td><td>'+detail.jumlah+'</td><td>Gram</td><td>'+formatted+'</td></tr>'
    $('#tableBody').append(tambah_data);

}
</script>
@endsection
