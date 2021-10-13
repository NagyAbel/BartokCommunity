function likeImage(clicked_id)
{
    
    $.ajax({
        type : "POST",  //type of method
        url  : "../../site/utils/like.php",  //your page
        data : { image_id :clicked_id  },
        // passing the values
        success: function(res){  
           // const data = JSON.parse(res);
           data = String(res).split(',');
                       console.log(data[0]); 
                       console.log(data[1]); 

                  div =   document.getElementsByClassName(data[0]);
                  div[0].innerHTML = `${data[1]} <i  style="color: red;position: relative;right: -5%;" class='fas fa-heart'></i>`;
                  div[1].innerHTML = `${data[1]} <i  style="color: red;position: relative;right: -5%;" class='fas fa-heart'></i>`;

                   //=  `jancsika ${data[1]} likes`; 
                  //var elements = document.querySelectorAll( 'body *' );

                }
    });

}