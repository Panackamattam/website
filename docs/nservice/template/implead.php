<?php
include 'head.inc';
include 'connection.php';
include 'customer.inc';
use Phppot\DataSource;

$add = $_REQUEST['add'];
If ($add) {

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

//if (isset($_POST["import"])) {
    
	$fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            
            $userId = "";
            if (isset($column[0])) {
                $userId = mysqli_real_escape_string($conn, $column[0]);
            }
            $userName = "";
            if (isset($column[1])) {
                $userName = mysqli_real_escape_string($conn, $column[1]);
            }
            $password = "";
            if (isset($column[2])) {
                $password = mysqli_real_escape_string($conn, $column[2]);
            }
            $firstName = "";
            if (isset($column[3])) {
                $firstName = mysqli_real_escape_string($conn, $column[3]);
            }
            $lastName = "";
            if (isset($column[4])) {
                $lastName = mysqli_real_escape_string($conn, $column[4]);
            }
//echo "Shine";
//---- csv file ended
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
$tid = "0";

$fname =  mysqli_real_escape_string($conn, $column[0]);
$lname = mysqli_real_escape_string($conn, $column[1]);
$gen = mysqli_real_escape_string($conn, $column[2]);
$bname = mysqli_real_escape_string($conn, $column[3]);
$add1 = mysqli_real_escape_string($conn, $column[4]);
$add2 = mysqli_real_escape_string($conn, $column[5]);
$city = mysqli_real_escape_string($conn, $column[6]);
$state = mysqli_real_escape_string($conn, $column[7]);
$pin = mysqli_real_escape_string($conn, $column[8]);
$cntry = $_REQUEST['cntry'];
$phone = mysqli_real_escape_string($conn, $column[9]);
$mobile = mysqli_real_escape_string($conn, $column[10]);
$email = mysqli_real_escape_string($conn, $column[11]);
$lsource = mysqli_real_escape_string($conn, $column[12]);
$ldetails = mysqli_real_escape_string($conn, $column[13]);
$lstatus = "Not Contacted";
$lbranch = $_REQUEST['store'];
$lsalesman = $_REQUEST['sman'];

//$qcurr = mysqli_real_escape_string($conn, $column[4]);

$sql1 = "INSERT INTO leads(fname, lname, gen, bname, add1, add2, city, state, pin, phone, mobile, email, leadsource, leaddetails, lstatus, lbranch, lsalesman, crby, crdate, status, tid) VALUES ('$fname','$lname','$gen','$bname','$add1','$add2','$city','$state','$pin','$phone','$mobile','$email','$lsource','$ldetails','$lstatus','$lbranch','$lsalesman','$user','$cdate','$st','$tid')";
//echo $sql1;
 if(mysqli_query($con, $sql1)){
   //echo "Records added successfully.";
	} else{
  //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

$msg = "Leads added sucessfully !";
}
}
}
//}
?>
     <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
  <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
			
                  <h4 class="card-title">Import Leads</h4>
				   <br /> <br />
				  <p><?php echo $msg; ?></p>
                 <div id="response"
        class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
        <?php if(!empty($message)) { echo $message; } ?>
        </div>
    <div class="outer-scontainer">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport"
                enctype="multipart/form-data">

                <div class="input-row">
							<label>
				<table width="100%">
				<tr>
				<td>Lead to Branch</td>
				<td><select name="store" class="form-control form-control-sm">
				<?php
$lsqry1 = "select * from Stores order by storename";
$lres1 = $con->query($lsqry1);
while($lrow1 = $lres1->fetch_assoc()) {
?>
<option value="<?php echo $lrow1["storename"]?>" <?php if ($lrow1["country"] == "India") {echo "selected";}?>> <?php echo $lrow1["storename"]?></option>

<?php
}
?>
				</select></td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				</tr>
				<tr>
				<td>Lead to Salesman</td>
				<td><select name="sman" class="form-control form-control-sm">
<?php
$sman1 = "Salesman";
$lsqry2 = "select * from users where role='$sman1' order by Name";
$lres2 = $con->query($lsqry2);
while($lrow2 = $lres2->fetch_assoc()) {
?>
<option value="<?php echo $lrow2["Name"]?>" <?php if ($lrow1["country"] == "India") {echo "selected";}?>> <?php echo $lrow2["Name"]?></option>

<?php
}
?>
						</SELECT></td>
				</tr>
				</table>
				</label>
				<br />
                    <label class="col-md-4 control-label">Choose CSV
                        File</label> <input type="file" name="file"
                        id="file" accept=".csv">
						<input type="hidden" name="add" value="Add"></input>
<button type="submit" class="btn btn-primary mr-2">Import</button>
                    <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
					 <br /> <br /> <br />

                </div>
                        </div>
                          </div>
                        </div>
                      </div>
                  </form>
                </div>
              </div>
            </div>
 </div>
            </div>
 <?php
   include 'footer.inc';
   ?>
 