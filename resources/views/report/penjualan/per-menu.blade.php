@extends('dashboard-layout')
@section('content')
@section('nav')
<div class="col-md-6 offset-md-3">
    <nav class="navbar bg-light topbar static-top shadow" style="padding:0px; height:40px; justify-content:start">
        <a href="/overall-report" class="btn btn-light" style="color: #707070; width:215px; height:40px;"><b>Laporan Penjualan</b></a>
        <a href="/stok_report" class="btn btn-light" style="color: #707070; width:215px; height:40px;"><b>Laporan Stok</b></a>
        <a href="/detail_hpp" class="btn btn-light" style="color: #707070; width:215px; height:40px;"><b>Laporan HPP</b></a>
    </nav>
</div>
@endsection
<div class="container col-md-12 row mt-5">
    <div class="col-md-3">
        <div class="card" style="text-align:left" id="tes">
            <div class="card-body">
                <h5 class="card-title">Daftar Laporan</h5>
                <hr>
                <a href="/overall-report" class="btn" style="display:block; text-align:left">Laporan Keseluruhan</a>
                <hr>
                <a href="/by_menu" class="btn active" style="display:block; text-align:left">Per Menu</a>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card" style="margin left: 20px">
            <div class="card-body row">
                <div class="col-md-4">
                    <h6 class="card-title">Laporan Penjualan Per Menu</h6>
                </div>
                <div class="col-md-5 offset-md-1">
                    <div class="form-group row">
                        <label class="col-md-2 mt-2">Date</label>
                        <input type="text" class="form-control col-md-10" name="daterange" placeholder="Input Date" onfocus="focus_date()" id="date"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary btn-sm mt-1" id="submit_date">Submit</button>
                </div>
                <div class="container">
                    <hr>
                    <div class="card" style="background-color : #FAFAFC">
                        <table class="table" width="100%" style="line-height:10px" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama Menu</th>
                                    <th>Kategori</th>
                                    <th>Quantity</th>
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
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<script type="text/javascript">

function focus_date() {
    $('input[name="daterange"]').daterangepicker();
}
function appendBody(menu) {
    var format = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
    }).format(menu.subtotal);
    var tambah_data = '<tr><td>'+menu.nama_menu+'</td><td>'+menu.nama_kategori+'</td><td>'+menu.jumlah+'</td><td>('+format+')</td></tr>'
    $('#tableBody').append(tambah_data);

}
$(document).ready(function($){

$('body').on('click', '#submit_date', function () {
    var date = document.getElementById("date").value;
    const all_date = date.split(" ");
    all_date.splice(1,1);
    $.ajax({
        type:"POST",
        url: "{{ url('get_by_menu') }}",
        data: { all_date:all_date },
        dataType: 'json',

        success: function(res){
            $("#tableBody").empty()
            res.menu.forEach(appendBody);
        }
    });
});
});
</script>
@endsection