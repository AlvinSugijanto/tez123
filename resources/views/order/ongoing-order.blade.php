@extends('dashboard-layout')
@section('content')
@section('title', 'Ongoing Order')

<link href="../css/tes.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >


<!-- <a href="/order" class="btn btn-primary mb-2">Order History</a> -->

<div class="card">
    <ul class="nav col-md-8 offset-md-3 mt-2">
        <a href="/order" class="btn btn-outline-primary col-md-3"><h6>All Order</h6></a>
        <a href="/ongoing-order" class="btn btn-outline-primary active col-md-3"><h6>Ongoing Order</h6></a>
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
                        <td width="5%">Rp. {{number_format($row->total, 0 ,",", ".") }}</td>
                        <td width="10%"><div style="color:orange; font-weight: bold;">Belum Lunas</div></td>
                        <td width="5%">{{ $row->created_by }}</td>

                        <td width="1%">
                            <ul class="nav">
                                <li><a href="editOrder/{{$row->id_order}}" class="btn-edit"><i class="fas fa-edit"></i></a></li>
                                <form method="POST" action="menu/delete/{{$row->id_order}}">
                                    @csrf
                                    <li><a href="javascript:void(0)" style="color:black" class="btn-show" data-id="{{ $row->id_order }}"><i class="fas fa-eye"></i></a></li>                          
              
                                </form>
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

    // $('body').on('click', '.btn-edit', function () {
    //     var id = $(this).data('id');

    //     $.ajax({
    //         type:"GET",
    //         url: "{{ url('create_order') }}",
    //         dataType: 'json',
    //         success: function(res){
    //             $(".container-fluid").append(res);

    //        }
    //     });    
    // });
});
function appendData(detail){
    var tambah_data = '<tr><td>'+detail.menu_id_menu+'</td><td>'+detail.Varian+'</td><td>'+detail.jumlah+'</td></tr>'
    $('#detailTable').append(tambah_data);

}
// function editData(nama_menu,qty,subtotal, grandTotal, varian) {
//     var tambah_data = '<tr><td width = "3%"><a href="#" id = "deleteRow" data-harga ="'+subtotal+'"><img src="symbols/trash.png" style="width:20px;height:20px;"></a></td><td><input type="text" name="nama_menu[]" hidden="" value="'+nama_menu+'"<span class="">'+ nama_menu +'</span></td><td><input type="text" name="varian[]" hidden="" value="'+varian+'"<span class="">'+ varian +'</span></td><td><input type="text" name="qty[]" hidden="" value="'+qty+'"<span class="">'+ qty +'</span></td><td><span class="">'+ subtotal +'</span></td></tr>';
//     $('#table-checkout').append(tambah_data);

//     $('#total').val(grandTotal);

    
//     $('.close2').click();
//     $('.close1').click();

// }
</script>
@endsection
