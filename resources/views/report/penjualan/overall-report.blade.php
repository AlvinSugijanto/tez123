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
                <a href="/by_menu" class="btn" style="display:block; text-align:left">Per Menu</a>

            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card" style="margin left: 20px">
          <div class="card-body row">
            <div class="col-md-4">
                <h6 class="card-title">Laporan Rekap Penjualan</h6>
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
            <div class="container" id="tableReport" style="display:none">
                <hr>
                <h6>Transaksi</h6>
                <div class="card" style="background-color : #FAFAFC">
                    <table class="table" width="100%" style="line-height:10px" cellspacing="0">
                        <tr id="metode_pemb">
                            <td id="cek">Metode Pembayaran</td>
                        </tr>
                        <tr style="border-top:1pt solid grey;">
                            <td>Total Transaksi</td>
                            <td></td>
                            <td id="total_trans" style="font-weight:bold"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Total Penjualan</td>
                            <td></td>
                            <td></td>
                            <td id="total_penj" style="font-weight:bold"></td>
                        </tr>
                        <!-- <tr>
                            <td>Laba Kotor</td>
                            <td></td>
                            <td></td>

                            <td width="15%">Rp. 1.050.000</td>
                        </tr> -->

                    </table>
                </div>
                <h6 class="mt-3">Pengeluaran</h6>
                <div class="card" style="background-color : #FAFAFC">
                    <table class="table" width="100%" style="line-height:10px" cellspacing="0">
                    <tr id="pengeluaran">
                        <td id="cek2" style="width:50%">Pengeluaran Lain-lain</td>
                    </tr>
                    <tr>
                        <td>Pembelian Ingredients</td>
                        <td></td>
                        <td style="width:15%"></td>
                        <td id="pengeluaran_ingredient"></td>

                    </tr>
                    <tr style="border-top:2pt solid grey;">
                        <td>Total</td>
                        <td></td>
                        <td style="width:15%"></td>
                        <td id="total_pengeluaran" style="font-weight:bold"></td>

                    </tr>
                    </table>

                </div>
                <h6 class="mt-3">Menu</h6>
                <div class="card" style="background-color : #FAFAFC">
                    <table class="table" width="100%" style="line-height:10px" cellspacing="0">
                    <tr>
                        <td>Total Menu Terjual</td>
                        <td id="total_menu"></td>
                    </tr>
                    <tr>
                        <td>Top Kategori Menu</td>
                        <td id="top_kategori"></td>

                    </tr>
                    <tr>
                        <td>Top Menu</td>
                        <td id="top_menu"></td>

                    </tr>
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
$(document).ready(function($){

    $('body').on('click', '#submit_date', function () {
        var date = document.getElementById("date").value;
        const all_date = date.split(" ");
        all_date.splice(1,1);
        $.ajax({
            type:"POST",
            url: "{{ url('get_overall_report') }}",
            data: { all_date:all_date },
            dataType: 'json',

            success: function(res){
                checkTable();
                console.log(res.metode_pemb);
                appendTable(res.total_trans, res.metode_pemb, res.total_penj, res.total_menu, res.top_kategori, res.top_menu, res.pengeluaran_lain, res.pengeluaran_ingredient, res.total_pengeluaran);
            }
        });
    });
});
function appendTable(total_trans, metode_pemb, total_penj, total_menu, top_kategori, top_menu, pengeluaran_lain, pengeluaran_ingredient, total_pengeluaran){

    const formatted = total_penj.toLocaleString('id-ID')
    console.log(total_pengeluaran);
    document.getElementById("total_trans").innerHTML = total_trans
    document.getElementById("total_penj").innerHTML = formatted
    document.getElementById("total_menu").innerHTML = total_menu
    document.getElementById("top_kategori").innerHTML = top_kategori.nama_kategori
    document.getElementById("top_menu").innerHTML = top_menu.nama_menu
    document.getElementById("pengeluaran_ingredient").innerHTML =   new Intl.NumberFormat('id-ID', { maximumSignificantDigits: 3 }).format(pengeluaran_ingredient);
    document.getElementById("total_pengeluaran").innerHTML = new Intl.NumberFormat('id-ID', { maximumSignificantDigits: 10 }).format(total_pengeluaran);

    $('#cek').attr('rowspan', metode_pemb.length+1);
    metode_pemb.forEach(appendPemb);

    $('#cek2').attr('rowspan', pengeluaran_lain.length+1);
    pengeluaran_lain.forEach(appendPengeluaran);
    $("#tableReport").show();
    
}
function checkTable(){
    $("#total_trans").empty();
    $("#total_penj").empty();
}
function appendPemb(metode_pemb){
    const formatted = metode_pemb.total.toLocaleString('id-ID');

    var tambah_data = '<tr><td>'+metode_pemb.jenis_pembayaran+'</td><td>'+metode_pemb.jumlah+'</td><td>'+formatted+'</td></tr>'
    $('#metode_pemb').after(tambah_data);

}
function appendPengeluaran(pengeluaran_lain){
    const formatted = pengeluaran_lain.total.toLocaleString('id-ID');
    var tambah_data = '<tr><td>'+pengeluaran_lain.items+'</td><td style="width:15%"></td><td>'+formatted+'</td></tr>'
    $('#pengeluaran').after(tambah_data);
}
</script>

@endsection








