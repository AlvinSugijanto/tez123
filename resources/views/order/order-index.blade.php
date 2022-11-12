@extends('dashboard-layout')
@section('content')
@section('title', 'Order')

<link href="../css/tes.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >


<div class="card">
    <ul class="nav col-md-8 offset-md-3 mt-2">
        <a href="/order" class="btn btn-outline-primary active col-md-3"><h6>All Order</h6></a>
        <a href="/ongoing-order" class="btn btn-outline-primary col-md-3"><h6>Ongoing Order</h6></a>
        <a href="/order" class="btn btn-outline-primary col-md-3"><h6>Cancelled Order</h6></a>
    </ul>
    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jenis Order</th>
                    <th>Jenis Pembayaran</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order as $row)
                    <tr>
                        <td width="5%">{{ $row->id_order }}</td>
                        <td width="10%">{{ date('l, d M Y', strtotime($row->created_at)) }}</td>
                        <td width="5%">{{ $row->jenis_order }}</td>
                        <td width="10%">{{ $row->jenis_pembayaran }}</td>
                        <td width="10%">Rp. {{number_format($row->total, 0 ,",", ".") }}</td>
                        <td width="5%"><div style="color:green; font-weight: bold;">{{ $row->status }}</div></td>
                        <td width="5%">{{ $row->created_by }}</td>

                        <td width="3%">
                            <ul class="nav">
                                <!-- <li><a href="javascript:void(0)" class="edit" data-id="{{ $row->id_order }}"><i class="fas fa-edit"></i></a></li> -->
                                <!-- <form method="POST" action="menu/delete/{{$row->id_order}}">
                                    @csrf -->
                                    <li><a href="javascript:void(0)" style="color:black" class="btn-show" data-id="{{ $row->id_order }}"><i class="fas fa-eye"></i></a></li>                          
                                <!-- </form> -->
                                <li><a href="javascript:void(0)" class="btn-print" data-id="{{ $row->id_order }}"><i class="fas fa-print"></i></a></li>                          
                                <li><a href="javascript:void(0)" style="color:red" class="btn-cancel" data-id="{{ $row->id_order }}"><i class="fas fa-ban"></i></a></li>                          

                            </ul>
                        </td>

                    </tr>
                 @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <table class="table" id="detailTable">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Varian</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody id="tableBody">
            </tbody>
        </table>
    </div>
  </div>
</div>
<div class="modal fade" id="modalPrint" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">

      <div id="invoice-POS">
    
    <center id="top">
      <div class="logo"></div>
      <div class="info"> 
        <h3 style="font-family:verdana;">Elemen Kopi</h3>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->
    <hr>
    <!-- <div id="mid">
      <div class="info"> -->
        <div class="col-md-12 row">
            <div class="col-md-5">
                <p>Tanggal</p>
            </div>
            <div class="col-md-7" id="tanggal">
            </div>
            <div class="col-md-5">
                <p>No Struk</p>
            </div>
            <div class="col-md-7" id="invoice">
            </div>
            <div class="col-md-5">
                <p>Jenis Pembayaran</p>
            </div>
            <div class="col-md-7" id="jenis_pemb">
            </div>
            
        </div>
        <hr>
    
        <div>
            <table id="tablePrint">
                <thead>
                <tr>
                    <th width="50%"><h6>Item</h6></th>
                    <th width="30%"><h6>Varian</h6></th>
                    <th width="20%" style="text-align:center"><h6>Qty</h6></th>
                    <th width="30%" style="text-align:center"><h6>Subtotal</h6></th>
                </tr>
                </thead>
                <tbody id="tbodyPrint">

                </tbody>


            </table>
        </div>

    </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-add">Print Now</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function($){

    $('body').on('click', '.btn-show', function () {
        var id = $(this).data('id');

        $.ajax({
            type:"POST",
            url: "{{ url('order/show') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
                $("#tableBody").empty()
                res.detail.forEach(appendData);
                $('#detailModal').modal('show');

           }
        });    
    });
    $('body').on('click', '.btn-print', function () {

        var id = $(this).data('id');

        $.ajax({
            type:"POST",
            url: "{{ url('order/getDetail') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
                remove();
                appendOrder(res);
                res.detail.forEach(appendDetail);
                appendTotal(res);
                $('#modalPrint').modal('show');

                console.log(res);
           }
        }); 

    });
});
function appendData(detail){
    var tambah_data = '<tr><td>'+detail.menu_id_menu+'</td><td>'+detail.Varian+'</td><td>'+detail.jumlah+'</td></tr>'
    $('#detailTable').append(tambah_data);

}
function appendOrder(res){
    var date = new Date(res.order.created_at).toLocaleDateString('en-ID', {
                    day : 'numeric',
                    month : 'long',
                    year : 'numeric'
                });

    var tanggal = '<p> : '+date+'</p>'
    var invoice = '<p> : '+res.order.id_order+'</p>'
    var jenis_pemb = '<p> : '+res.order.jenis_pembayaran+'</p>'

    $('#tanggal').append(tanggal);
    $('#invoice').append(invoice);
    $('#jenis_pemb').append(jenis_pemb);


}
function appendDetail(detail){
    const subtotal = detail.harga * detail.jumlah;
    const formatted = subtotal.toLocaleString('id-ID');

    var tambah_data = '<tr><td><p>'+detail.menu_id_menu+'</p></td><td><p>'+detail.Varian+'</p></td><td style="text-align:center"><p>'+detail.jumlah+'</p></td><td style="text-align:center"><p>'+formatted+'</p></td></tr>'
    $('#tablePrint').append(tambah_data);

}
function appendTotal(res){
    var format = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
    }).format(res.order.total);
    var tambah_data = '<tr style="height:30px"></tr><tr><td></td><td></td><td><h6>Total</h6></td><td><h6>'+format+'</h6></td></tr>';
    $('#tablePrint').append(tambah_data);
}

function remove(){
    $("#tbodyPrint").empty();
    $('#tanggal').empty();
    $('#invoice').empty();
    $('#jenis_pemb').empty();
}
</script>
@endsection
