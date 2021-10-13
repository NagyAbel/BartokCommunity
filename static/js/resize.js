


function resizeImage()
{
    var resize_width  = 500;

    var item = document.querySelector('#file-upload').files[0];
    var reader = new FileReader();
    reader.readAsDataURL(item);
    reader.name = item.name;
    reader.size = item.size;
    reader.onload = function(event){
        var img = new Image();
        img.src = event.target.result;
        img.name = event.target.name;
        img.size = event.target.size;
        img.onload = function(el){
            var elem = document.createElement('canvas');
            var scaleFactor = resize_width/el.target.width;
            elem.width = resize_width;
            elem.height =  el.target.height * scaleFactor;
  
            var ctx = elem.getContext('2d');
            ctx.drawImage(el.target,0,0,elem.width,elem.height);
            var srcEncoded = ctx.canvas.toDataURL(el.target,'image/jpeg',0);
          
          $.ajax({
            
            type : "POST",  //type of method
            url  : "../../site/utils/upload.php",  //your page
            data : { my_image :srcEncoded  },
            // passing the values
            success: function(res){  
    
                    }
        });
      }
  }

}