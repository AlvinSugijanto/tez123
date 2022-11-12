
var activeCat = "";
var ingredient;

function tambahData(ingredient,qty) {
    var ifExist = document.getElementById(ingredient);
    if(typeof(ifExist) != 'undefined' && ifExist != null){
        var temp = document.getElementById(ingredient).innerText;
        var total = parseInt(temp) + parseInt(qty);
        document.getElementById(ingredient).innerHTML = total;
        document.getElementById('qty'+ingredient).value = total;
    }else{
        var tambah_data = '<div class="row"> <input type="text" name="id_detail_menu[]" hidden><input type="text" name="ingredient[]" value="'+ingredient+'" hidden><div class="col-md-3"><h6>'+ingredient+'</h6></div><div class="col-md-2 offset-md-2"></div> <input type="text" name="qty[]" id="qty'+ingredient+'" value="'+qty+'"hidden> <p  id="'+ingredient+'">'+qty+'</p><div class="col-md-2">Gram</div><a href="#" id="delete"><img src="symbols/trash.png" class = "ml-5" style="width:20px;height:20px;"></a></div>';
        $('#ingredient-list').append(tambah_data);
    }

    $('#addQty').modal('hide');
}
function addHarga(varian,harga) {

    var tambah_data = '<div class="row"> <input type="text" name="id_varian_harga[]" hidden><input type="text" name="varian[]" value="'+varian+'" hidden><div class="col-md-3"><h6>'+varian+'</h6></div><div class="col-md-2 offset-md-2"></div> <input type="text" name="harga[]" value="'+harga+'"hidden> <p>'+harga+'</p><a href="#" id="delete"><img src="symbols/trash.png" class = "ml-5" style="width:20px;height:20px;"></a></div>';
    $('#divHarga').append(tambah_data);

    $('#addHarga').modal('hide');
}

function ingredient_detail(res) {

    var tambah_data = '<div class="row"><input type="text" name="id_detail_menu[]" value="'+res.id_detail_menu+'"hidden><input type="text" name="ingredient[]" value="'+res.nama+'" hidden><div class="col-md-3"><h6>'+res.nama+'</h6></div><div class="col-md-2 offset-md-2"><input type="text" name="qty[]" value="'+res.ukuran+'"hidden> <p>'+res.ukuran+'</p></div><div class="col-md-2 offset-md-2"><a href="#" id="delete" data-id="'+res.id_detail_menu+'"><img src="symbols/trash.png" class = "ml-5" style="width:20px;height:20px;"></a></div></div>';
    $('#ingredient-list').append(tambah_data);

}
function varian_harga(res){
    var tambah_data = '<div class="row"><input type="text" name="id_varian_harga[]" value="'+res.id_varian_harga+'"hidden><input type="text" name="varian[]" value="'+res.varian+'" hidden><div class="col-md-3"><h6>'+res.varian+'</h6></div><div class="col-md-2 offset-md-2"><input type="text" name="harga[]" value="'+res.harga+'"hidden> <p>'+res.harga+'</p></div><div class="col-md-2 offset-md-2"><a href="#" id="delete" data-id="'+res.id_varian_harga+'"><img src="symbols/trash.png" class = "ml-5" style="width:20px;height:20px;"></a></div></div>';
    $('#divHarga').append(tambah_data);
}
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

// $(document).on('change', '.add_ingredient', function(e){
//     $('#addQty').modal('show');
//     ingredient = document.getElementById("ingredients").value;

// });
// $(document).on('click', '.btn-add-ingredient', function(e){
//     e.preventDefault();
    
//     var qty = $('#qty').val();
//     $.ajax({
//         success:function(){
//             tambahData(ingredient, qty);
//         }
//     });
// });
$(document).on('click', '#add-harga', function(e){
    $('#addHarga').modal('show');
});
$(document).on('click', '.btn-add-harga', function(e){
    var varian = $('#varian').val();
    var harga = $('#harga').val();

    $.ajax({
        success:function(){
            addHarga(varian,harga);
        }
    });

});

$('#addEditForm').submit(function(e) {
    e.preventDefault();
    let formData = new FormData(this);

    $.ajax({
        type:'POST',
        url: `/menu/store`,
        data: formData,
        contentType: false,
        processData: false,
        success: (response) => {
            if (response) {
                this.reset();
                window.location.reload();
            }
        },
    });
});
// $(document).ready(function($){
//     $.ajaxSetup({
//         headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     $('#addButton').click(function () {
//        $('#ajaxModel').html("Add Ingredient");
//        $('#ajax-model').modal('show');
//     });

//     $('body').on('click', '.edit', function () {
//         var id = $(this).data('id');
//         // ajax
//         $.ajax({
//             type:"POST",
//             url: "{{ url('menu/edit') }}",
//             data: { id: id },
//             dataType: 'json',
//             success: function(res){
//               $('#ajaxModel').html("Edit Ingredient");
//               $('#ajax-model').modal('show');
//               $('#id').val(res.menu.id_menu);
//               $('#nama_menu').val(res.menu.nama_menu);
//               $('#harga').val(res.menu.harga);
//               $('#kategori').val(res.menu.kategori);

//            }
//         });
//     });
//     $('.show_confirm').click(function(event) {
//           var form =  $(this).closest("form");
//           var name = $(this).data("name");
//           event.preventDefault();
//           swal({
//               title: `Are you sure you want to delete this record?`,
//               text: "If you delete this, it will be gone forever.",
//               icon: "warning",
//               buttons: true,
//               dangerMode: true,
//           })
//           .then((willDelete) => {
//             if (willDelete) {
//               form.submit();
//             }
//           });
//       });

// });
