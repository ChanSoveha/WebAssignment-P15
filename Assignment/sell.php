<?php 
$active = "sell";
$title = "Selling";
session_start();
if(!isset($_SESSION['userlogin'])){
    header("location: ./auth/login.php");
    exit();
}else{
    $username = $_SESSION['userlogin']['user_name'];
}

include('structure/header.php');

?>

<section class="content">
    <div class="container-fluid">
    <h1 class="text-primary text-center print-hide ">WELCOME TO SYSTEM SHOP</h1>
    <form class="mt-2 p-5 w-75 border mx-auto">
        <div class="print-hide">
            <div class="form-group" style="display: flex; align-items: center;">
                <div style="flex: 1; margin-right: 10px;">
                    <label for="">Discount</label>
                        <div class="input-group">
                        <input type="number" id="discount" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                        <span class="input-group-text">$</span>
                    </div>
                </div>

                <div style="flex: 1;">
                    <label for="">Customer</label>
                    <select name="customer" id="customer" class="form-control">
                        
                    </select>
                </div>
            </div>
            <div id="product">
            <div class="form-group" style="display: flex; align-items: center;">
                <div style="flex: 2; margin-right: 10px;">
                    <label for="">Product</label>
                    <select name="pro_name[]" id="citySelect" class="form-control">
                        <!-- ... -->
                    </select>
                </div>

                <div style="flex: 1; margin-left: 10px;">
                    <label for="">Quantity</label>
                    <input type="number" name="qty[]" class="form-control" id="qty">
                </div>

                <div style="flex: 1; margin-left: 10px;" class="d-flex">
                    <div>
                    <label for="">Price</label>
                    <div class="input-group">
                            <input type="number" name="price[]" id="price" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                            <span class="input-group-text">$</span>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="d-flex justify-content-end mb-3">
                <div class="mx-6" >
                    <button class="btn btn-primary my-auto" type="button" id="add">Add Product</button>
                </div>
            </div>
        </div>

    <div class="w-75 mx-auto">
        <table class="table">
            <thead>
                <tr>
                    <td>Product</td>
                    <td>Quantity</td>
                    <td>Price</td>
                </tr>
            </thead>
            <tbody id="tableBody">

                <tr>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                </tr>
            </tbody>
        </table>
        <div class="text-primary">Total : <span id="total">0</span> $</div>
    </div>
    <div class="d-flex justify-content-between mt-2">
        <div>
            <button type="button" class="btn btn-info">Print</button>
        </div>
        <div>
            <button type="button" id="sell" class="btn btn-warning me-0">Sell</button>
        </div>
    </div>
    
    
</form>




    </div>
</section>

<?php
    include('structure/footer.php');
?>
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
        var list =[];
        var dt = [];
        var total = 0;
        $.ajax({
        url: 'structure/data/fetchproduct.php', // replace with your API endpoint
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            dt = data;
            var select = $('#citySelect');
            // Clear existing options
            select.empty();
            // Add default option
            select.append('<option value="">Select a Product</option>');
            // Add options based on the JSON data
            $.each(data, function(index, city) {
                select.append('<option value="' + city.id + '">' + city.pro_name + '</option>');
            });
        },
        error: function(error) {
          console.error('Error fetching data:', error);
        }
      });

        $.ajax({
        url: 'structure/data/fetchcustomer.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var select = $('#customer');
            select.empty();

            $.each(data, function(index, customer) {
                var selected = (customer.id === '1') ? 'selected' : '';
                select.append('<option' + selected +' value="' + customer.id + '">' + customer.category + '</option>');
            });

        },
        error: function(error) {
          console.error('Error fetching data:', error);
        }
      });


      $("#add").click(function() {
        var product = $("#citySelect").val();
        var qty = $("#qty").val();
            var item = { 
                "id" : $('#citySelect').val(),
                "pro_name":$('#citySelect option:selected').text(),
                "qty":$('#qty').val(),
                "price": $('#price').val(),
                "customer": $('#customer').val(),
                "discount": $('#discount').val()
            };
            var found = false;
            for(var i in list){
                if(list[i].id==item.id){
                    var oldqty = parseInt(list[i].qty, 10);
                    var newqty = parseInt(item.qty, 10);

                    list[i].qty = oldqty + newqty;
                    list[i].price = parseInt(item.price, 10);
                    found = true;
                    break;
                }
            }
            if(found==false){
                list.push(item);
            }
            var tt = 0;
            for(var i in list){
                var price = parseFloat(list[i].price, 10) 
                var qty = parseInt(list[i].qty, 10);
                var cal = price * qty;
                tt += cal;
            }
            total = tt;
            updateTable();
            
        });

        function updateTable() {
            $("#tableBody").empty();
            // Loop through the list and append rows to the table
            list.forEach(function(item) {
                var row = $("<tr>");
                row.append($("<td>").text(item.pro_name));
                row.append($("<td>").text(item.qty));
                row.append($("<td>").text(item.price));
                $("#tableBody").append(row);
            });
            $("#total").text(total);
        }

        $('#citySelect').change(function() {
            var proid =  $('#citySelect').val();
            $.each(dt, function(index, city) {
                if(city.id == proid){
                    $('#price').val(city.price);
                }
            });
        });

        $("#sell").click(function() {
            console.log(list);
            $.ajax({
                url: 'structure/data/insertsell.php', 
                type: 'POST', 
                data: { 'list': JSON.stringify(list) }, // Convert the list to a JSON string
                success: function(data) {
                    console.log('Data sent successfully:', data);
                    // Handle the response from the server if needed
                },
                error: function(xhr, status, error) {
                    console.error('Error sending data:', xhr.responseText);
                }
            });
        });

    });
</script>

