<footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Chris It Solutions 2021</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">A Billing Software </a> from Chris IT Solutions</span>
            </div>
          </footer>
      </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
<script>

		// onkeyup event will occur when the user
		// release the key and calls the function
		// assigned to this event
		function GetDetail(str) {
			if (str.length == 0) {
				document.getElementById("srate").value = "";
				document.getElementById("qty").value = "";
				return;
			}
			else {

				// Creates a new XMLHttpRequest object
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function () {

					// Defines a function to be called when
					// the readyState property changes
					if (this.readyState == 4 &&
							this.status == 200) {
						
						// Typical action to be performed
						// when the document is ready
						var myObj = JSON.parse(this.responseText);

						// Returns the response data as a
						// string and store this array in
						// a variable assign the value
						// received to first name input field
						
						document.getElementById("srate").value = myObj[0];
						
						// Assign the value received to
						// last name input field
						document.getElementById("qty").value = myObj[1];
					}
				};

				// xhttp.open("GET", "filename", true);
				xmlhttp.open("GET", "gfg.php?user_id=" + str, true);
				
				// Sends the request to the server
				xmlhttp.send();
			}
		}
	</script>

	<script type="text/javascript">
  $(function() {
     $( "#cname" ).autocomplete({
       source: 'ajax-db-search-customer.php',
     });
  });
</script>

<script type="text/javascript">
  $(function() {
     $( "#user_id" ).autocomplete({
       source: 'ajax-db-search-item-stock.php',
     });
  });
</script>
    <script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/file-upload.js"></script>
    <script src="assets/js/typeahead.js"></script>
  </body>
</html>