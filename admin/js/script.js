

$(document).ready(function(){  
    
    tinymce.init({ selector:'textarea'});
    
    $(".modal_thumbnails").click(function(){
        
        $("#set_user_image").prop("disabled", false);        
        user_href = $("#user-id").prop("href");
        user_href = user_href.split("="); 
        user_id = user_href[1];
        
        img_src = $(this).prop("src");
        img_src = img_src.split("/");
        image_name = img_src[img_src.length - 1];
        
    });
    
    $("#set_user_image").click(function(){
       
       $.ajax({
          url: "includes/ajax_code.php" 
           
       });
       
       
    });
    
});








