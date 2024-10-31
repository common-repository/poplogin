/**
 * PopLogin 
 * version: 1.0.0
 */

        
/* PopUp Modal */        
var modal = document.getElementById("poplogModal");

// Get the button that opens the modal
var btn = document.getElementById("poplogBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("poplog-close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
} 
