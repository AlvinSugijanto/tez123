
var nama_ingredient;
var harga;
var activeCat = "";
let grandTotal = 0;
var varian_harga =[];

function tambahData(nama_ingredient,qty,subtotal) {
    const formatted = parseInt(subtotal).toLocaleString('id-ID');
    var tambah_data = '<tr><td width = "3%"><a href="#" id = "deleteRow" data-harga ="'+subtotal+'"><img src="symbols/trash.png" style="width:20px;height:20px;"></a></td><td><input type="text" name="nama_ingredient[]" hidden="" value="'+nama_ingredient+'"<span class="">'+ nama_ingredient +'</span></td><td><input type="text" name="qty[]" hidden="" value="'+qty+'"<span class="">'+ qty +' gram</span></td><td style ="text-align: center;"><input type="text" name="subtotal[]" hidden="" value="'+subtotal+'"<span class="">'+ formatted +'</span></td></tr>';
    $('#table-checkout').append(tambah_data);
    grandTotal = parseInt(subtotal) + grandTotal;

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
    nama_ingredient = $(this).data('nama');
});

$(document).on('click', '.btn-add', function(e){
    e.preventDefault();
   
    var qty = $('#qty').val();
    var subtotal = $('#subtotal').val();
    console.log(subtotal);
    $.ajax({
        success:function(){
            tambahData(nama_ingredient, qty, subtotal);
        }
    });

    
});
