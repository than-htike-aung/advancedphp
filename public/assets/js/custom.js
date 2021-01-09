
     
        // function addToCart(num){
        //     alert(num);
        // }

        function addToCart(num){
            var ary = JSON.parse(localStorage.getItem("items"));
            if(ary == null){
                var itemAry = [num];
                localStorage.setItem("items", JSON.stringify(itemAry));
            }else{
           //  console.log(ary);
           $con = ary.indexOf(num);
           if($con == -1){
                ary.push(num);
                 localStorage.setItem("items", JSON.stringify(ary));
           }
          
            }

           // getCartItem();
           alert("Item already Added to Cart!");
          // $("#cart-count").html(getCartItem().length);
          showCartItem();
        }

        function showCartItem(){
            let ary = JSON.parse(localStorage.getItem('items'));
            if(ary != null){
                $("#cart-count").html(ary.length);
            }else{
                $("#cart-count").html(0);
            }
           //console.log(ary);
           //return ary;
        }

        function getCartItem(){
            let ary = JSON.parse(localStorage.getItem("items"));
            return ary;
           //console.log(ary);
          
        }

        function deleteItem(id) {
            var ary = JSON.parse(localStorage.getItem("items"));
            if(ary != null){
                ary.forEach((item)=>{
                    if(item == id){
                        var ind = ary.indexOf(item);
                        ary.splice(ind,1);
                    }
                })
            }
            localStorage.setItem("item", JSON.stringify(ary));
            showCartItem();
        }

        function clearCart(){
            localStorage.removeItem("items");
        }

        showCartItem();
