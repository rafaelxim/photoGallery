

$(document).ready(function(){  
    
            $(".info-box-header").click(function(){
               
               $(".inside").slideToggle();
               $("#toggle").toggleClass("glyphicon-menu-down glyphicon , glyphicon-menu-up glyphicon");
                
            });
    
    tinymce.init({ selector:'textarea'});
    
    $(".modal_thumbnails").click(function(){
        
        $("#set_user_image").prop("disabled", false);        
        user_href = $("#user-id").prop("href");
        user_href = user_href.split("="); 
        user_id = user_href[1];
        
        img_src = $(this).prop("src");
        img_src = img_src.split("/");
        image_name = img_src[img_src.length - 1];

        photo_id = $(this).attr("data");    
        
        $.ajax({
          url: "includes/ajax_code.php" ,
          data: {
            photo_id: photo_id
          },
          type: "POST",
          success: function(data){
            if(!data.error){

                $("#modal_sidebar").html(data);
            }
          }
       });
    });
    
    $("#set_user_image").click(function(){
       
       $.ajax({
          url: "includes/ajax_code.php" ,
          data: {
            image_name: image_name, 
            user_id : user_id
          },
          type: "POST",
          success: function(data){
            if(!data.error){

                $(".user_image_box a img").prop("src", data);
            }
          }
          
           
       });
       
       
    });
    
});








