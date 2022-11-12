
var nama_menu;
var harga;
var activeCat = "";
let grandTotal = parseInt(document.getElementById("total").value);
var varian_harga =[];

function tambahData(nama_menu,qty,subtotal, grandTotal, varian) {
    var tambah_data = '<tr><td width = "3%"><a href="#" id = "deleteRow" data-harga ="'+subtotal+'"><img src="../symbols/trash.png" style="width:20px;height:20px;"></a></td><td><input type="text" name="nama_menu[]" hidden="" value="'+nama_menu+'"<span class="">'+ nama_menu +'</span></td><td><input type="text" name="varian[]" hidden="" value="'+varian+'"<span class="">'+ varian +'</span></td><td><input type="text" name="qty[]" hidden="" value="'+qty+'"<span class="">'+ qty +'</span></td><td style="text-align:center"><span class="">'+ subtotal +'</span><input type="text" class="form-control" value="'+subtotal+'" name="subtotal[]" hidden></td></tr>';
    $('#table-checkout').append(tambah_data);

    $('#total').val(grandTotal);

    
    $('.close2').click();
    $('.close1').click();

}
function increment() {
    let total = document.getElementById("qty").value;
    total++;
    qty.value = total;
}
function decrement() {
    let total = document.getElementById("qty").value;
    if(total == 1)
        return
    total--;
    qty.value = total;
}

function addOption(res){
    $("#inputVarian").append(new Option(res.varian,res.varian));

}
function selectVarian(){
    var temp = varian_harga.find(v => v.varian == document.getElementById("inputVarian").value)
    console.log(temp);
    document.getElementById("harga").value = temp.harga;
}
function onSelect() {
    var category = document.getElementById("kategori").value;
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
$('#table-checkout').on('click', '#deleteRow', function () {
    $(this).closest("tr").remove();
    let subtotal = $(this).data('harga');
    grandTotal = grandTotal - subtotal;

    $('#total').val(grandTotal);

});

$('body').on('click', '.nama_menu', function () {
    document.getElementById("addQtyForm").reset();
    $("#inputVarian").empty()
    nama_menu = $(this).data('nama');
      $.ajax({
        type:"POST",
        url: "/getHarga",
        data: {nama_menu : nama_menu},
        dataType: 'json',
        success: (response) => {
            varian_harga = response.varian_harga;
            varian_harga.forEach(addOption);
            $("#harga").val(varian_harga[0].harga);
        },
    });
});

$(document).on('click', '.btn-add', function(e){
    e.preventDefault();
   
    var qty = $('#qty').val();
    var harga = $('#harga').val();
    var varian = $('#inputVarian').val();
    $.ajax({
        success:function(){
            subtotal = harga*qty;
            parseInt($('#qty').val(qty));
            grandTotal = subtotal+grandTotal;
            console.log(grandTotal);
            tambahData(nama_menu, qty, subtotal, grandTotal, varian);
        }
    });

    
});
