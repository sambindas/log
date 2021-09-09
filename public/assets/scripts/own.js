const modal = ()=>{
    // Get the modal
    
    var modal3 = document.getElementById("myModal3");
 
 
 
 
    
    // Get the button that opens the modal
 
    var btn3 = document.getElementById("mybtn3");
    

    
    // Get the <span> element that closes the modal

    var span3 = document.getElementsByClassName("close3")[0];
   

    // }
 
    btn3.onclick = function() {
      modal3.style.display = "flex";
    }

  
      
    
    

    span3.onclick = function() {
        modal3.style.display = "none";
      }

 
 
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal3 ) {
        // modal.style.display = "none";
 
        modal3.style.display = "none";       
      }
    }
 
}

modal()