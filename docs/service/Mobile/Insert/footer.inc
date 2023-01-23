
  <!-- Contact -->
  <div class="w3-container" id="contact" style="background-color: black;">
    <h3>Contact</h3>
    <i class="fa fa-map-marker" style="width:30px"></i> Chris IT Solutions<br>
    <i class="fa fa-phone" style="width:30px"></i> Phone: +91 986 987 9400<br>
    <i class="fa fa-envelope" style="width:30px"> </i> Email: chrisitsolutions@gmail.com<br>
  </div>
  
  <footer class="w3-container w3-padding-16" style="margin-top:32px">Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">Chris IT Solutions, Kerala</a></footer>

<!-- End page content -->
</div>

<script>
// Script to open and close sidebar when on tablets and phones
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}

// Slideshow Apartment Images
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " w3-opacity-off";
}
</script>

</body>
</html>
