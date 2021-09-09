const modal = ()=>{
    // Get the modal
    var modal2 = document.getElementById("myModal2");    
    var modal3 = document.getElementById("myModal3");
 
 
 
 
    
    // Get the button that opens the modal
    var btn2 = document.getElementById("mybtn2");
    var btn3 = document.getElementById("mybtn3");
    

    
    // Get the <span> element that closes the modal
    var span2 = document.getElementsByClassName("close2")[0];
    var span3 = document.getElementsByClassName("close3")[0];
   

    // }
    btn2.onclick = function() {
        modal2.style.display = "block";
    }
    btn3.onclick = function() {
      modal3.style.display = "flex";
    }

  
      
    
      span2.onclick = function() {
        modal2.style.display = "none";
      }

    span3.onclick = function() {
        modal3.style.display = "none";
      }

 
 
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal2 || event.target == modal3 ) {
        // modal.style.display = "none";
        modal2.style.display = "none";
        modal3.style.display = "none";       
      }
    }
 
}

modal()