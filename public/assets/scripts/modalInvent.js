const modal = ()=>{
    // Get the modal
    var modal2 = document.getElementById("myModal2");    
    var modal3 = document.getElementById("myModal3");
    var modal4 = document.getElementById("myModal4");
    var modal5 = document.getElementById("myModal5");
    var modal6 = document.getElementById("myModal6");
    var modal7 = document.getElementById("myModal7");
    
    // Get the button that opens the modal
    var btn2 = document.getElementById("mybtn2");
    var btn3 = document.getElementById("mybtn3");
    var btn4 = document.getElementById("mybtn4");
    var btn5 = document.getElementById("mybtn5");
    var btn6 = document.getElementById("mybtn6");
    var btn7 = document.getElementById("mybtn7");
    
    // Get the <span> element that closes the modal
    var span2 = document.getElementsByClassName("close2")[0];
    var span3 = document.getElementsByClassName("close3")[0];
    var span4 = document.getElementsByClassName("close4")[0];
    var span5= document.getElementsByClassName("close5")[0];
    var span6 = document.getElementsByClassName("close6")[0];
    var span7 = document.getElementsByClassName("close7")[0];

    // }
    btn2.onclick = function() {
        modal2.style.display = "block";
    }
    btn3.onclick = function() {
      modal3.style.display = "flex";
    }
    btn4.onclick = function() {
        modal4.style.display = "flex";
      }
      btn5.onclick = function() {
        modal5.style.display = "flex";
      }
      btn6.onclick = function() {
        modal6.style.display = "flex";
      }
      btn7.onclick = function() {
        modal7.style.display = "flex";
      }
      
    
      span2.onclick = function() {
        modal2.style.display = "none";
      }

    span3.onclick = function() {
        modal3.style.display = "none";
      }
      span4.onclick = function() {
        modal4.style.display = "none";
      } 
      span5.onclick = function() {
        modal5.style.display = "none";
      } 
      span6.onclick = function() {
        modal6.style.display = "none";
      } 
      span7.onclick = function() {
        modal7.style.display = "none";
      }
 
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal2 || event.target == modal3 || event.target==modal4 || event.target==modal5 || event.target==modal6 || event.target==modal7 ) {
        // modal.style.display = "none";
        modal2.style.display = "none";
        modal3.style.display = "none";
        modal4.style.display = "none";
        modal5.style.display = "none";
        modal6.style.display = "none";
        modal7.style.display = "none";
       
       
      }
    }
 
}

modal()