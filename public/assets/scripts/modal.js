const modal = ()=>{
    // Get the modal
    var modal = document.getElementById("myModal");
    // Get the button that opens the modal
    var btn = document.getElementById("mybtn");
    
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // }
    btn.onclick = function() {
      modal.style.display = "block";
    }
    

    span.onclick = function() {
        modal.style.display = "none";
      }
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal || event.target==modal ) {
        // modal.style.display = "none";
        modal.style.display = "none";
        
       
      }
    }
 
}

modal()