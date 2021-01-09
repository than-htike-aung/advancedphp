<?php $__env->startSection('title', 'Cart page'); ?>

<?php $__env->startSection('content'); ?>

<input type="hidden" id="token" value="<?php echo e(\App\classes\CSRFToken::__token()); ?>">
<div class="container my-5">
     
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
        </tbody>
           <?php if(\App\classes\Auth::check()): ?>
             <tr>
                 <td colspan="7" style="text-align:right" id="checkOutBtn">
                     <button class="btn btn-primary btn-sm" onclick="payOut()">CheckOut</button>
                 </td>

             </tr>
              <tr style="visibility: hidden" id="stripeTR">
                  <td colspan="7" class="text-right">
                      <form action="/payment/stripe" method="post" style="display: none" id="stripeForm">
                          <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                  data-key="<?php echo e(\App\classes\Session::get("publishable_key")); ?>"
                                  data-description="Coder Online Shopping"
                                  data-amount="500000"
                                  data-email="<?php echo e(\App\classes\Auth::user()->email); ?>"
                                  data-locale="auto">

                          </script>
                      </form>
                  </td>
              </tr>
         <?php else: ?>
             <tr>
                 <td colspan="7" style="text-align:right">
                     <a class="btn btn-primary btn-sm" href="/user/login" >Login To Checkout</a>
                 </td>

             </tr>
         <?php endif; ?>

    </table>
    
    <a href="/getitems">Show Items</a>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
       function loadProduct(){
           //alert(123);
        //  clearCart();
        $.ajax({
            type: "POST",
            url: "/cart",
            data:{
                "cart" : getCartItem(),
                "token" : $("#token").val()
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
            var total = 0;
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
                        <i class="fa fa-plus" style="cursor:pointer" onclick="addProductQty(${result.id})"></i>
                        <i class="fa fa-minus" style="cursor:pointer" onclick="deduceProductQty(${result.id})"></i>
                        <i class="fa fa-trash" style="cursor:pointer" onclick="deleteProduct(${result.id})"></i>
                    </td>
                    <td>${(result.qty * result.price).toFixed(2)}</td>
                `;
                str += "</tr>";
               

            });
            str += `
                    <tr>
                        <td colspan="6" style="text-align:right">Grand Total</td>
                        <td>${total.toFixed(2)}</td>    
                    </tr>

                `;
            $('#tablebody').html(str);
        }

        function deleteProduct(id) {
          // clearCart();
            var results = JSON.parse(localStorage.getItem("products"));
            results.forEach((result)=>{
                if(result.id === id){
                    var ind = results.indexOf(result);
                    //console.log(ind);
                     results.splice(ind, 1);
                }
            });
            deleteItem(id);
            saveProducts(JSON.stringify(results));

        }

        function payOut(){
           //alert("Payout")
            var results = JSON.parse(localStorage.getItem("products"));

            $.ajax({
            type: "POST",
            url: "/payout",
            data:{
                "items" : results,
                "token" : $("#token").val()
            },
            success: function(results){
              console.log(results);
              $('#checkOutBtn').css("display", "none");
              $('#stripeTR').css("visibility", "visible");
              $('#stripeForm').css("display", "block");
             // clearCart();
             // showCartItem();
             // showProducts([]);


            },

            errors: function(response){
                console.log(response.responseText);
            }
        })
        }

        loadProduct();

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>