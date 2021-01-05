@extends('layout.master')

@section('title', 'Cart page')

@section('content')

<div class="container my-5">
     {{-- Table Start --}}
     <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody id="tablebody">
           
              {{-- @foreach($products as $product)
            <tr class="text-muted">
              <th>{{ $product->id }}</th>
              <td><img src="{{$product->image}}" style="max-width: 100px; max-height:150px"  alt="no"></td>
              <td>{{ $product->name }}</td>
              <td>{{ $product->price }}</td>
              <td>
                  <span>1</span>
                  <span class="bg-primary px-2 py-1 rounded text-white">+</span>
                  <span class="bg-primary px-2 py-1 rounded text-white">-</span>
              </td>
              <td>
                
                 <a href="/admin/product/{{ $product->id }}/delete" class="text-danger">
                    <i class="fa fa-trash text-danger"></i>
                 </a>
              </td>
              <td>200</td>
            </tr>
              @endforeach --}}
            
        </tbody>
    </table>
    {{-- Table End --}}
</div>

@endsection

@section('script')
<script>
       function loadProduct(){
           //alert(123);
        //  clearCart();
        $.ajax({
            type: "POST",
            url: "/cart",
            data:{
                "cart" : getCartItem()
            },
            success: function(results){
               //clearCart();
             //  console.log(results);
               // window.location.href = "/cart";
               saveProducts(results);

            },
            errors: function(response){
                console.log(response.responseText);
            }
        })

        }

        function saveProducts(res){
            localStorage.setItem("products" , res);
            let results = JSON.parse(localStorage.getItem("products"));
            showProducts(results);
        }

        function addProductQty(id){
           // alert(id);
           var results = JSON.parse(localStorage.getItem("products"));
           results.forEach((result) =>{
             //  console.log(result.id);
             if(result.id === id){
                result.qty = result.qty + 1;
             }
           });
           saveProducts(JSON.stringify(results));
        }

        function deduceProductQty(id){
           // alert(id);
           var results = JSON.parse(localStorage.getItem("products"));
           results.forEach((result)=>{
            if(result.id === id){
                if(result.qty > 1){
                    result.qty = result.qty - 1;

                }
            }
           });
           saveProducts(JSON.stringify(results));
        }

        function showProducts(results){
            var str = "";
            results.forEach((result) => {
               // console.log(result.id);
               total += result.qty * result.price;
               str += "<tr>";
                str += `
                    <td>${result.id}</td>
                    <td><img src='${result.image}' alt=''></td>
                    <td>${result.name}</td>
                    <td>${result.price}</td>
                    <td>${result.qty}</td>
                    <td>
                        <i class="fa fa-plus" style="cursor:pointer" onclick="addProductQty($(result.id))"></i>
                        <i class="fa fa-minus" style="cursor:pointer" onclick="deduceProductQty($(result.id))"></i>
                    </td>
                    <td>${result.qty * result.price}</td>
                `;
                str += "</tr>";
               

            });
            str += `
                    <tr>
                        <td colspan="6" style="text-align:right">Grand Total</td>
                        <td>${total.toFixed(2)}</td>    
                    </tr>
                    <tr>
                        <td colspan="7" style="text-align:right">
                            <button class="btn btn-primary btn-sm" onclick="payOut()">CheckOut</button>
                        </td>
                        <td>2000</td>    
                    </tr>
                `;
            $('#tablebody').html(str);
        }

        function payOut(){
            var results = JSON.parse(localStorage.getItem("products"));

            $.ajax({
            type: "POST",
            url: "/payout",
            data:{
                "items" : results
            },
            success: function(results){
             //  console.log(results);
             clearCart();
             showCartItem();
             showProducts([]);
            

            },
            errors: function(response){
                console.log(response.responseText);
            }
        })
        }

        loadProduct();

</script>
@endsection