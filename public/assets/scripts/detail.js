const modal2 = ()=>{
    // Get the modal
    var modal2 = document.getElementById("myModal2");
    // Get the button that opens the modal
    var btn2 = document.getElementById("mybtn2");
    
    // Get the <span> element that closes the modal
    var span2 = document.getElementsByClassName("close2")[0];

    // }
    btn2.onclick = function() {
      modal2.style.display = "block";
    }
    

    span2.onclick = function() {
        modal2.style.display = "none";
      }
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal2 || event.target==modal2 ) {
        // modal.style.display = "none";
        modal2.style.display = "none";
        
       
      }
    }
 
}

modal2()