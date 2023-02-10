<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="pages/sales/css/style.css">
	<link rel="stylesheet" href="pages/sales/css/bootstrap-datetimepicker.min.css">
    <title>Sales - Request New Product</title>
  </head>
  <body>
    <?php
	  include 'config/database.php';
      $query3 = "SELECT max(NumDoc) as kodeTerbesar FROM tdocument";
      $hasil = mysqli_query($kon,$query3);
	  $data3 = mysqli_fetch_array($hasil);
	  $kodeBarang = $data3['kodeTerbesar'];
 
	  $urutan = (int) substr($kodeBarang, 2, 5);
 
	  $urutan++;
 
	  $huruf = "D";
	  $kodeBarang = $huruf . sprintf("%03s", $urutan);
	  ?>

    <div class="container" style="margin-top: 20px">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              FORM REQUEST NEW PRODUCT
            </div>
            <div class="card-body">
             <form action="pages/sales/rnp/simpan-rnp.php"  method="POST" enctype="multipart/form-data">
             <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Nomor<font color="red">* </font>:</label>
                        <input type="text" name="NumDoc" value="<?php echo $kodeBarang ?>" class="form-control" readonly>
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Request Date<font color="red">* </font>:</label>
                        <input type="text" name="DateRequest" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("m/d/Y H:i:s");?>" class="form-control" readonly>
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Your Email<font color="red">* </font>:</label>
                        <input type="email" name="EmailSales" value="sales-helpdesk@virobuild.com" class="form-control" readonly>
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Email NPD<font color="red">* </font>:</label>
                        <input type="email" name="EmailRND" class="form-control" required>
                        <input type="hidden" name="subjek" value="Request New Product BOM + CodeProject" class="form-control">
                        <input type="hidden" name="pesan" value="" class="form-control">
                        <input type="hidden" name="StatusRequest" value="NPD" class="form-control">
                        <input type="hidden" name="StatusDoc" value="OPEN" class="form-control">
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>NPD Type<font color="red">* </font>:</label>
                        <select name="NPDType" id="NPDType" class="form-control" onchange='changeValue(this.value)' >  
                        <option value="">Pilih NPD Type</option>
                        <?php   
                        include 'config/database.php';
                        $query = mysqli_query($kon, "select * from npdtype order by NPDTypeID asc");  
                        $result = mysqli_query($kon, "select * from npdtype order by NPDTypeID asc");  
                        $a          = "var NoSO = new Array();";  
                        while ($row = mysqli_fetch_array($result)) {  
                              echo '<option name="NPDTypeID" value="'.$row['NPDTypeID'] . '">' . $row['NPDTypeName'] . '</option>';   
                        $a .= "NoSO['" . $row['NPDTypeID'] . "'] = {NoSO:'" . addslashes($row['NPDTypeName'])."'};"; 
                        }  
                        ?>  
                        
                     </select>
                     <input type="hidden" name="NPDTypeName" class="form-control" id="NoSO" readonly>
                  </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Code Of Project<font color="red">* </font>:</label>
                        <input type="text" name="CodeProject" class="form-control" required>
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Product Name<font color="red">* </font>:</label>
                        <input type="text" name="Prod_Name" class="form-control" required>
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Customer Name<font color="red">* </font>:</label>
                        <input type="text" name="CustName" class="form-control" required>
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Customer Phone<font color="red">* </font>:</label>
                        <input type="text" name="CustPhone" class="form-control" required>
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Feedback Expetation Date<font color="red">* </font>:</label>
                        <input type="date" name="DateFeedbackExp" class="form-control" required>
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>App ID<font color="red">* </font>:</label>
                    </div>
                </div>
            </div>
             <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <!--<input type="text" name="AppID" class="form-control" required>-->
                        <p><input type="checkbox" name="language[]" value="Roofing Outdoor" /> Roofing Outdoor</p>
                        <p><input type="checkbox" name="language[]" value="Roofing Indoor" /> Roofing Indoor</p>
                        <p><input type="checkbox" name="language[]" value="Surface Loose (outdoor)" /> Surface Loose (outdoor)</p>
                        <p><input type="checkbox" name="language[]" value="Surface Loose (indoor)" /> Surface Loose (indoor)</p>
                        <p><input type="checkbox" name="language[]" value="Surface + backing (indoor)" /> Surface + backing (indoor)</p>
                        <p><input type="checkbox" name="language[]" value="Surface + frame (outdoor)" /> Surface + frame (outdoor)</p>
                        <p><input type="checkbox" name="language[]" value="Surface + frame (indoor)" /> Surface + frame (indoor)</p>
                        <p><input type="checkbox" name="language[]" value="Handicraft (outdoor)" /> Handicraft (outdoor)</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <p><input type="checkbox" name="language[]" value="Handicraft (indoor)" /> Handicraft (indoor)</p>
                        <p><input type="checkbox" name="language[]" value="Archineering Partition" /> Archineering Partition</p>  
                        <p><input type="checkbox" name="language[]" value="Archineering Facade" /> Archineering Facade</p>
                        <p><input type="checkbox" name="language[]" value="Archineering Ornament" /> Archineering Ornament</p>
                        <p><input type="checkbox" name="language[]" value="Archineering Sculpture" /> Archineering Sculpture</p>
                        <p><input type="checkbox" name="language[]" value="Archineering (others)" /> Archineering (others)</p>
                        <p><input type="checkbox" name="language[]" value="Umbrella" /> Umbrella</p>
                        <p><input type="checkbox" name="language[]" value="Dome" /> Dome</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <p><input type="checkbox" name="language[]" value="Archineering Ceiling" /> Archineering Ceiling</p>
                        <p><input type="checkbox" name="language[]" value="Varyan Product" /> Varyan Product</p>
                        <p><input type="checkbox" name="language[]" value="Viroforms Product" /> Viroforms Product</p>
                        <p><input type="checkbox" name="language[]" value="Special Application (request) - continue to detail of special applications requested" /> Special Application (request) - continue to detail of special applications requested</p>
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Weaving Pattern & What Fiber<font color="red">* </font>:</label>
                        <input type="text" name="PatternFiber" class="form-control" required>
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Frame Detail<font color="red">* </font>:</label>
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <p><input type="checkbox" name="frame[]" value="using alumunium frame" /> using alumunium frame</p>
                        <p><input type="checkbox" name="frame[]" value="using iron metal frame" /> using iron metal frame</p>  
                        <p><input type="checkbox" name="frame[]" value="hollo profile" /> hollo profile</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <p><input type="checkbox" name="frame[]" value="pipe profile" /> pipe profile</p>
                        <p><input type="checkbox" name="frame[]" value="standard size 40 x 40 cm" /> standard size 40 x 40 cm</p>
                        <p><input type="checkbox" name="frame[]" value="Tidak menggunakan Frame" /> Tidak menggunakan Frame</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Special Size<font color="red">* </font>:</label>
                        <input type="text" name="SpecialSize" class="form-control" required>
                    </div>
                </div>
             </div>
    
        
             <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Attached documents (write project's name on each file) :<font color="red">* </font>:</label>
                        <div class="card">
                        <div class="card-body">
                        <input type="file" name="attachment" class="form-control">
                        <input type="file" name="attachment1" class="form-control">
                        <input type="file" name="attachment2" class="form-control">
                        <input type="file" name="attachment3" class="form-control">
                        <input type="file" name="attachment4" class="form-control">
                        <input type="file" name="attachment5" class="form-control">
                        <label><br>Note : agar attachment terkirim, tolong isi secara berurutan</label>
                    </div>
                    </div>
                </div>
             </div>
        </div>
    
             <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Other Link of Drawing<font color="red">* </font>:</label>
                        <input type="text" name="OtherLinkDrawing" class="form-control" required>
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>General Information<font color="red">* </font>:</label>
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <p><input type="checkbox" name="genif[]" value="Archineering Project" /> Archineering Project</p>
                        <p><input type="checkbox" name="genif[]" value="Request for costing estimation" /> Request for costing estimation</p>  
                        <p><input type="checkbox" name="genif[]" value="Request for design" /> Request for design</p>
                        <p><input type="checkbox" name="genif[]" value="Request for prototyping" /> Request for prototyping</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <p><input type="checkbox" name="genif[]" value="Special request for packaging" /> Special request for packaging</p>
                        <p><input type="checkbox" name="genif[]" value="Special request for shipment" /> Special request for shipment</p>
                        <p><input type="checkbox" name="genif[]" value="Installation by client" /> Installation by client</p>
                        <p><input type="checkbox" name="genif[]" value="Installation by Viro" /> Installation by Viro</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <p><input type="checkbox" name="genif[]" value="Shipment by client" /> Shipment by client</p>
                        <p><input type="checkbox" name="genif[]" value="Shipment by Viro" /> Shipment by Viro</p>
                        <p><input type="checkbox" name="genif[]" value="Request for Exhibition or Event" /> Request for Exhibition or Event</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Packaging Detail<font color="red">* </font>:</label>
                        <input type="text" name="PackagingDetail" class="form-control" required>
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Square m2 (estimation)<font color="red">* </font>:</label>
                        <input type="text" name="Square" class="form-control" required>
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Budget Customer (Estimation)<font color="red">* </font>:</label>
                        <input type="text" name="Budget" class="form-control" required>
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Project Location<font color="red">* </font>:</label>
                        <input type="text" name="Location" class="form-control" required>
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Installation Target Date<font color="red">* </font>:</label>
                        <input type="date" name="DateTarget" class="form-control" required>
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Important Request ( jika ada ... ) :</label>
                        <input type="text" name="ImportantRequest" class="form-control" required>
                    </div>
                </div>
             </div>
                <button type="submit" class="btn btn-lg btn-success">SAVE</button>
                <button type="reset" class="btn btn-lg btn-warning">RESET</button>
              </form>    
              </br>
            </div>
          </div>
      </div>
    </div>
    <script type="text/javascript">   
   <?php   
      echo $a;   
   ?>  
     function changeValue(id){  
      document.getElementById('NoSO').value = NoSO[id].NoSO; 
      };  
  </script>  

    <!--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="page/sales/js/popper.js"></script>
    <script src="pages/sales/js/moment-with-locales.min.js"></script>-->
    <!--<script src="pages/sales/js/bootstrap-datetimepicker.min.js"></script>-->
    <!--<script src="pages/sales/js/main.js"></script>-->
  </body>
</html>
