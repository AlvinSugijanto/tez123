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
<style>
    .autocomplete {
  position: relative;
  display: inline-block;
}
.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>
<div class="container col-md-12 row mt-5">
    <div class="col-md-3">
        <div class="card" style="text-align:left" id="tes">
            <div class="card-body">
                <h5 class="card-title">Daftar Laporan</h5>
                <hr>
                <a href="/detail_hpp" class="btn" style="display:block; text-align:left">Laporan HPP</a>
                <hr>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card" style="margin left: 20px">
            <div class="card-body row">
                <div class="col-md-4">
                    <h6 class="card-title">Laporan Detail Hpp</h6>
                </div>
                <div class="col-md-3 offset-md-2">
                    <div class="form-group row">
                        <input type="text" class="form-control" name="ingredient" id="myInput" placeholder="Input Menu"/>
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
                                    <th>Ingredient</th>
                                    <th>Qty</th>
                                    <th>Hpp /gram</th>
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
let total = 0;

function focus_date() {
    $('input[name="daterange"]').daterangepicker();
}
function appendBody(menu) {
    const formatted = menu.hpp.toLocaleString('id-ID');

    var tambah_data = '<tr><td>'+menu.nama+'</td><td>'+menu.ukuran+' gram</td><td>'+menu.hpp_rata+'</td><td>'+formatted+'</td></tr>'
    $('#tableBody').append(tambah_data);
    total = total+menu.hpp;
}
function appendTotal(total){
    let number = total.toFixed(2);
    var data = '<tr style="border-top:1pt groove black;"><td></td><td></td><td><b>Total</b></td><td><b>'+number+'</b></td></tr>'
    $('#tableBody').append(data);

}
$(document).ready(function($){

$('body').on('click', '#submit_date', function () {
    var menu = document.getElementById("myInput").value;
    $.ajax({
        type:"POST",
        url: "{{ url('get_detail_hpp') }}",
        data: { menu:menu },
        dataType: 'json',

        success: function(res){
            $("#tableBody").empty()
            total = 0;
            res.menu.forEach(appendBody);
            appendTotal(total);
        }
    });
});
});


function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}
var menus = <?php echo json_encode($menu); ?>;
autocomplete(document.getElementById("myInput"), menus);

</script>
@endsection