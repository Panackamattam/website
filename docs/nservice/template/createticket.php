<?php
include 'head.inc';
include 'connection.php';
?>
<div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-12 grid-margin">
<div class="card">
<div class="card-body">
<h4 class="card-title"><strong>Create Tickets</strong></h4>
<form method="get" action="cticket.php">
<br />
<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Customer</label>
                          <div class="col-sm-9">
						  <input type="hidden" name="cus" value="<?php echo $_REQUEST['cus']; ?>"></input>
                            <input type="text" name="cus1" value="<?php echo $_REQUEST['cus']; ?> - <?php echo $_REQUEST['compname']; ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					  </div>
 <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Ticket Type</label>
                          <div class="col-sm-9">
                           <select name="type" class="form-control form-control-sm">
							<option value="Warranty">Warranty</option>
							<option value="Out of Warranty">Out of Warranty</option>
							<option value="Stock Damage">Stock Damage</option>
						   </select>
                          </div>
                        </div>
                      </div>
					  
					  
					   <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Pur. Date</label>
                          <div class="col-sm-9">
                            <input type="date" name="pdate" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
					   <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Inv #</label>
                          <div class="col-sm-9">
                            <input type="text" name="inv" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>

					     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Catagory</label>
                          <div class="col-sm-9">
                            <select name="pcat" class="form-control form-control-sm">
							<?php
$st = "Active";
$sql = "SELECT * FROM catgaory where status='$st' order by pcat";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
?>
<option value="<?php echo $row["pcat"] ?>"><?php echo $row["pcat"] ?></option>
<?php
}
?>
							</select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Brand</label>
                          <div class="col-sm-9">
                            <input type="text" name="brand" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
					   <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Model</label>
                          <div class="col-sm-9">
                            <input type="text" name="model" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
					  <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Complaint in Breif</label>
                          <div class="col-sm-9">
                            <textarea name="complaint" rows="4" cols="27"></textarea>
                          </div>
                        </div>
                      </div>
				
                    </div>
					<br />
						  <p align="center"><button type="submit" class="btn btn-primary mr-2">Submit</button></p>
                  </form>
				  <br /><br /><br />
                </div>
              </div>
            </div>
 </div>
            </div>

 <?php
   include 'footer.inc';
   ?>
  