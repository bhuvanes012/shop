 
       
      // List View
      function listView() {
        $('li').removeClass('col-6').addClass('col-12');
        $('.add_button').removeClass('col-12');
        $('.product-price').removeClass('col-12').addClass('col-5');
        $(".product_details").css({"padding-left": "10px" });
        $(".product_details").removeClass('col-12').addClass('col');
        $(".img_dis_lable").css('top','95%');
        $(".img_dis_lable").css('margin-left','20%');
        $(".dis_text").css('font-size','15px');

      }
      
      // Grid View
      function gridView() {
        $('li').removeClass('col-12').addClass('col-6');
        $('.add_button').removeClass('col-6').addClass('col-12');
        $('.product-price').removeClass('col-5').addClass('col-12');
        $(".product_details").removeClass('col').addClass('col-12');
        //details padding 
        $(".product_details").css({"padding-left": "0px" });
        $(".img_dis_lable").css('top','0%');
        $(".img_dis_lable").css('margin-left','90%');
        $(".dis_text").css('font-size','10px');
      }

      var  prodArray1 = [];
      //get order time and if more then 30 mins delete the order json in local storage
      var current_time = new Date().getTime();   
      if(localStorage.getItem("order_time")===null){
      
      }else{
        var res = diff_minutes(current_time , localStorage.getItem("order_time")) ;   
         if(res>30){
           localStorage.removeItem("order")
           localStorage.removeItem("order_time")
         }
      }
      

      function diff_minutes(dt2, dt1) 
      {

        console.log( dt2+"---------"+dt1);
        var diff =(dt2  - dt1 ) / 1000;
        diff /= 60;
        return Math.abs(Math.round(diff));
        
      }

      
      if( localStorage.getItem("order") === null){
      var ord = {}; 
      localStorage.setItem("order", JSON.stringify(ord));
      }else{       
        readTotal();
      } 
      function readTotal(){
        var order = JSON.parse(localStorage.getItem("order"));
         var total =0;     
         Object.entries(order).forEach(item => {
                 console.log("store id"+item[1].store_id +sessionStorage.getItem("store_product"))               
                 if(item[1].store_id == sessionStorage.getItem("store_product")){
                  total += item[1].total                   
                 }
                }) 
           console.log("total--->>"+total); 
           $("#total").text(total);    
      }
      var order = JSON.parse(localStorage.getItem("order"));
       
       $.ajax({   //like 
          url : 'php/index.php', // php URL
          type: "POST",
          data: {store_id:sessionStorage.getItem("store_product"),request:"getproduct"}, 
          dataType:"TEXT",
          async: false,
          cache: false,
          timeout: 30000,        
           
          success: function(data)
          {
          //alert(data);
            if(data.length>4){
            data = JSON.parse(data)
            $("#productdiv").empty();
            for(i=0 ; i<data.length ;i++){
              var  prodArray = [];
               
              prodArray.push("<li class='col-12 product list-group-item list-group-item-action '>")
                prodArray.push("<div class='container'> ");   
                prodArray.push("  <div class='row justify-content-start'>");    
                prodArray.push(" <div id='img_div' class='' >");          
                 prodArray.push(" <img   src='php/"+data[i].image1+"'>");
                 if(data[i].discount!="0"){
                  prodArray.push(" <div  id='img_dis_lable' class='img_dis_lable justify-content-center'>");   
                  prodArray.push("<span   <i class='fa fa-tag red-color fa-1.5x' aria-hidden='true'></i> </span> <h8 class='dis_text'>"+data[i].discount+"% </h8> ")
                  prodArray.push(" </div>");  
                 }
                prodArray.push(" </div>");    
                prodArray.push(" <div class='product_details col' >");    
                prodArray.push(" <span class='product_name' > "+data[i].product_name+"      </span>");    
                prodArray.push("<div> ");    
                prodArray.push(" <span class='product_size'>  Size : gddfhfh</span>");    
                prodArray.push("</div> ");  
                prodArray.push("<div  class=' row '>");  
                prodArray.push("<div class=' product-price col-5 align-self-start'> "); 
                prodArray.push(" <span class='product_price'>$"+data[i].price+"</span> ");       
                prodArray.push("</div>");  
                prodArray.push("<div  id='addButtonDIv"+data[i].product_id+"' class='add_button   align-self-start justify-content-between '>");  
                prodArray.push(" <button id='addButton"+data[i].product_id+"' onclick="+"addToCart('"+data[i].product_name_with +"','"+data[i].image1+"','"+data[i].store_id+"','"+data[i].product_id+"',"+data[i].price+")"+"   class=' btn btn-outline-info  btn-sm  '>Add + </button>");  
                prodArray.push("</div>"); 
                prodArray.push("</div>"); 
                prodArray.push("</div>"); 
                prodArray.push("</div>"); 
                prodArray.push("</div>"); 
                prodArray.push("</li>"); 
                 
                            $("#productdiv").append(prodArray.join(""));
                            var order = JSON.parse(localStorage.getItem("order"));
                            Object.entries(order).forEach(item => {
                                console.log("dhdhd--->>"+item[0])
                                 
                                if(item[1].store_id == data[i].store_id && item[0]==data[i].product_id ){
                                  console.log("ifff@@");
                                  $("#addButton"+data[i].product_id).hide();    
                                  //hide div and child
                                  $("#addButtonDIv"+data[i].product_id).each(function() {
                                    $(this).hide();
                                  });
                                  $("#addButtonDIv"+data[i].product_id).show();  //show the div button
                                   
                                  $("#addButtonDIv"+data[i].product_id).append("<button class='plus btn-outline-info  btn-sm  ' id='addButtonMinus"+data[i].product_id+"'    onclick='minus("+data[i].store_id+","+data[i].product_id+","+data[i].price+")'  >-</button>");
                                 $("#addButtonDIv"+data[i].product_id).append("<input class='quantity' type='number' value='"+item[1].quantity+"' min='1' max='5'   readonly id='replyNumber"+data[i].product_id+"' data-bind='value:replyNumber' />");
                                  $("#addButtonDIv"+data[i].product_id).append("<button class='minus btn-outline-info  btn-sm  ' id='addButtonAdd"+data[i].product_id+"'  onclick='add("+data[i].store_id+","+data[i].product_id+","+data[i].price+")' >+</button>");
          
                                   // $("#replyNumber"+id).val(parseInt(item[1].quantity) );
                                }
                             }) 

               
            }
            $("#loading").hide();
          }
        }
        }); 
      
        