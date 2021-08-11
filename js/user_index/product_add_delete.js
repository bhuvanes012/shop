
      
      function stopOtherMedia(element) {
          $("audio").not(element).each(function(index, audio) {
            audio.pause();
          });

          $("video").not(element).each(function(index, video) {
            video.pause();
          });
      }
      
      function pauseAll(elem){
	      for(var i=0; i<videos.length; i++){
            //Is this the one we want to play?
            if(videos[i] == elem) continue;
            //Have we already played it && is it already paused?
            if(videos[i].played.length > 0 && !videos[i].paused){
              // Then pause it now
             videos[i].pause(); 
		        }
        }
        
      }
      function addToCart( name,img,store_id,id,price){
        console.log("id-->"+name+"--->");
        //replace all not working here so use split 
        var name = name ;
         $("#addButton"+id).hide();
        var sp=32;
         //hide div and child
         $("#addButtonDIv"+id).each(function() {
          $(this).hide();
         });
         $("#addButtonDIv"+id).show();  //show the div button
         //hide add button 
               
         $("#addButtonDIv"+id).append("<button class='plus btn-outline-info  btn-sm  ' id='addButtonMinus"+id+"' class='btn col-4'  onclick='minus("+store_id+","+id+","+price+")'  >-</button>");
         $("#addButtonDIv"+id).append("<input class='quantity' type='number' value='1' min='1' max='5' class='col-3' readonly id='replyNumber"+id+"' data-bind='value:replyNumber' />");
         $("#addButtonDIv"+id).append("<button class='minus btn-outline-info  btn-sm  ' id='addButtonAdd"+id+"' class='btn col-4' onclick='add( "+store_id+","+id+","+price+")' >+</button>");
          
         addProductDetail(name,img,store_id,id,price);
      }
         

    
        //Add value
        function add(store_id,id,price){
            var currentvalue = $("#replyNumber"+id).val();
             
            $("#replyNumber"+id).val(parseInt(currentvalue)+1);
            addProductDetail("","",store_id,id,price);
        }
        //minus value
        function minus(store_id,id,price){
              var currentvalue = $("#replyNumber"+id).val();
              if(parseInt(currentvalue)>0){
                $("#replyNumber"+id).val(parseInt(currentvalue)-1);
                addProductDetail("","",store_id,id,price)
              }
              if(parseInt(currentvalue)==1){  // remove the add,minus element and show the addButton
                $("#addButtonMinus"+id).remove();
                $("#replyNumber"+id).remove();
                $("#addButtonAdd"+id).remove();
                $("#addButton"+id).show();
                
                delete order[id];
                localStorage.setItem("order", JSON.stringify(order));
                console.log(order);
                console.log(order.length);
              }
        }
        function addProductDetail(name,img,store_id,id ,price){
          
          var orderDetail = new Object();
          var order_time = new Date().getTime()
          localStorage.setItem("order_time",order_time);
         
               orderDetail.quantity = $("#replyNumber"+id).val();
               orderDetail.price =price;
               orderDetail.total =($("#replyNumber"+id).val()*price);    
               orderDetail.store_id =store_id; 
               if(name!=""){
                orderDetail.name =name; 
               } else{
                orderDetail.name =order[id].name; 
               }   
               if(img!=""){
                orderDetail.img =img; 
               }  else{
                orderDetail.img =order[id].img; 
               }  
               order[id]  = orderDetail;                   
               console.log( Object.keys(order).length )
               var tot =0 ;
               localStorage.setItem("order", JSON.stringify(order));
               Object.entries(order).forEach(item => {
                 console.log("dhdhd"+item[1].total)
                 tot += item[1].total
                 if(item[1].store_id != store_id){
                  // alert("would you like to delete other shop item")
                   order ={};
                   orderDetail.total = price ; 
                   order[id]  = orderDetail;      
                   localStorage.setItem("order", JSON.stringify(order));
                 }

                }) 
               
               console.log("Tot----->"+tot);  
               console.log(order);
               $("#total").text(tot);
               sessionStorage.setItem("total",tot)
        }
        function checkout(){
          var order = JSON.parse(localStorage.getItem("order"));            
            if(Object.keys(order).length !=0 ){
              window.location.href="checkout.html"; 
                
            }
        }
     