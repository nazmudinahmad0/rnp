<?php

    if (isset($_POST['edit_mapel'])) {
        
        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            include '../../../config/database.php';
            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");

            $NumDoc                 =$_POST["NumDoc"];
            $StatusRequest          =$_POST["StatusRequest"];
            $StatusDoc              =$_POST["StatusDoc"];
            $CustName               =$_POST["CustName"];
            $Prod_Name              =$_POST["Prod_Name"];
            $CodeProject            =$_POST["CodeProject"];
            $NPDType                =$_POST["NPDType"];
            $NPDTypeName            =$_POST["NPDTypeName"];
            $CustPhone              =$_POST["CustPhone"];
            $DateFeedbackExp        =$_POST["DateFeedbackExp"];
            $PatternFiber           =$_POST["PatternFiber"];
            $SpecialSize            =$_POST["SpecialSize"];
            $OtherLinkDrawing       =$_POST["OtherLinkDrawing"];
            $PackagingDetail        =$_POST["PackagingDetail"];
            $Square                 =$_POST["Square"];
            $Budget                 =$_POST["Budget"];
            $Location               =$_POST["Location"];
            $DateTarget             =$_POST["DateTarget"];
            $ImportantRequest       =$_POST["ImportantRequest"];
            $DateVerification       =$_POST["DateVerification"];
            /* $DateEstBOM             =$_POST["DateEstBOM"];
            $DateCosting            =$_POST["DateCosting"]; */
            $DateClose              =$_POST["DateClose"];
            $EmailSales             =$_POST["EmailSales"];
            $EmailRND               =$_POST["EmailRND"];
            $EmailFA                =$_POST["EmailFA"];
            $EmailMKT               =$_POST["EmailMKT"];
            $AppName                =$_POST["AppName"];
            $FrameName              =$_POST["FrameName"];
            $GenifName              =$_POST["GenifName"];
            $departtement           =$_POST["Dept"];
            $komen                  =$_POST["Comment"];         
            //$CustPhone      =$_POST["CustPhone"];
            //$DateVerification=$_POST["DateVerification"];
            $query3 = "SELECT max(NumDoc) as kodeTerbesar FROM tdocument";
            $hasil = mysqli_query($kon,$query3);
            $data3 = mysqli_fetch_array($hasil);
            $kodeBarang = $data3['kodeTerbesar'];
            date_default_timezone_set('Asia/Jakarta');
            $DR                 =  date("Y-m-d H:i:s");
        
            $urutan = (int) substr($kodeBarang, 2, 5);
        
            $urutan++;
        
            $huruf = "D";
            $kodeBarang = $huruf . sprintf("%03s", $urutan);
            $dokumen = "OPEN";
            $stts_request = "SALES";

            $sql="update tdocument 
            Left Join tapplications on tdocument.NumDoc = tapplications.NumDoc
            Left Join tframedetail on tdocument.NumDoc = tframedetail.NumDoc
            Left Join tgeninformation on tdocument.NumDoc = tgeninformation.NumDoc 
            
            set
            tdocument.NumDoc          ='$NumDoc',
            tdocument.StatusRequest   ='$StatusRequest',
            tdocument.StatusDoc       ='$StatusDoc',
            tdocument.CustName        ='$CustName',
            tdocument.Prod_Name       ='$Prod_Name',
            tdocument.CodeProject     ='$CodeProject',
            tdocument.NPDType         ='$NPDType',
            tdocument.NPDTypeName     ='$NPDTypeName',
            tdocument.CustPhone       ='$CustPhone',
            tdocument.DateFeedbackExp ='$DateFeedbackExp',
            tdocument.PatternFiber    ='$PatternFiber',
            tdocument.SpecialSize     ='$SpecialSize',
            tdocument.OtherLinkDrawing='$OtherLinkDrawing',
            tdocument.PackagingDetail ='$PackagingDetail',
            tdocument.Square          ='$Square',
            tdocument.Budget          ='$Budget',
            tdocument.Location        ='$Location',
            tdocument.DateTarget      ='$DateTarget',
            tdocument.ImportantRequest='$ImportantRequest',
            tdocument.DateVerification='$DateVerification',
            
            tdocument.DateClose       ='$DateClose',
            tdocument.EmailSales      ='$EmailSales',
            tdocument.EmailRND        ='$EmailRND',
            tdocument.EmailFA         ='$EmailFA',
            tdocument.EmailMKT        ='$EmailMKT',
            tapplications.AppName     ='$AppName',
            tframedetail.FrameName    ='$FrameName',
            tgeninformation.GenifName ='$GenifName'
            where tdocument.NumDoc    ='$NumDoc'";
            $sql6  ="insert into tdocument (NumDoc,DateRequest,StatusRequest,StatusDoc,CustName,Prod_Name,CodeProject,NPDType,NPDTypeName,CustPhone,DateFeedbackExp,PatternFiber,SpecialSize,OtherLinkDrawing,PackagingDetail,Square,Budget,Location,DateTarget,ImportantRequest,DateVerification,DateEstBOM,DateCosting,DateClose,EmailSales,EmailRND,EmailFA,EmailMKT) VALUES ('$kodeBarang','$DR','$stts_request','$dokumen','$CustName','$Prod_Name','$CodeProject','$NPDType','$NPDTypeName','$CustPhone','$DateFeedbackExp','$PatternFiber','$SpecialSize','$OtherLinkDrawing','$PackagingDetail','$Square','$Budget','$Location','$DateTarget','$ImportantRequest','$DateVerification','$DateEstBOM','$DateCosting','$DateClose','$EmailSales','$EmailRND','$EmailFA','$EmailMKT')";
            $sql7  ="insert into tapplications(NumDoc, AppName) VALUES ('$kodeBarang','$AppName')";
            $sql8  ="insert into tframedetail(NumDoc, FrameName) VALUES ('$kodeBarang','$FrameName')";
            $sql9  ="insert into tgeninformation(NumDoc, GenifName) VALUES ('$kodeBarang','$GenifName')";
            $sql10 ="insert into thistorycomment(NumDoc,DateComment,Dept,Comment) VALUES ('$NumDoc','$DR','$departtement','$komen')";
            $sql11 = "update tdocument set StatusDoc = '$StatusDoc' where tdocument.NumDoc    ='$NumDoc'";
            $simpan_mapel=mysqli_query($kon,$sql);
            $simpan_doc=mysqli_query($kon,$sql6);
            $simpan_app=mysqli_query($kon,$sql7);
            $simpan_frm=mysqli_query($kon,$sql8);
            $simpan_gen=mysqli_query($kon,$sql9);
            $simpan_his=mysqli_query($kon,$sql10);
            $update_stts=mysqli_query($kon,$sql11);
        
            //Menyimpan ke tabel mapel
            

            if ($simpan_mapel AND $StatusDoc == 'CORRECTED' AND $simpan_doc AND $simpan_app AND $simpan_frm AND $simpan_gen AND $simpan_his) {
                
                    mysqli_query($kon,"COMMIT");
                    header("Location:../../../index.php?page=beranda-sales&edit=berhasil");
            }
            
            else{
                    mysqli_query($kon,"ROLLBACK");
                    header("Location:../../../index.php?page=beranda-sales&edit=berhasil");
            }
            
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                include '../../../config/database.php';
                //Memulai transaksi
                mysqli_query($kon,"START TRANSACTION");
    
                $NumDoc                 =$_POST["NumDoc"];
                $StatusRequest          ='SALES';
                $StatusDoc              =$_POST["StatusDoc"];
                $CustName               =$_POST["CustName"];
                $Prod_Name              =$_POST["Prod_Name"];
                $CodeProject            =$_POST["CodeProject"];
                $NPDType                =$_POST["NPDType"];
                $NPDTypeName            =$_POST["NPDTypeName"];
                $CustPhone              =$_POST["CustPhone"];
                $DateFeedbackExp        =$_POST["DateFeedbackExp"];
                $PatternFiber           =$_POST["PatternFiber"];
                $SpecialSize            =$_POST["SpecialSize"];
                $OtherLinkDrawing       =$_POST["OtherLinkDrawing"];
                $PackagingDetail        =$_POST["PackagingDetail"];
                $Square                 =$_POST["Square"];
                $Budget                 =$_POST["Budget"];
                $Location               =$_POST["Location"];
                $DateTarget             =$_POST["DateTarget"];
                $ImportantRequest       =$_POST["ImportantRequest"];
                $DateVerification       =$_POST["DateVerification"];
                /* $DateEstBOM             =$_POST["DateEstBOM"];
                $DateCosting            =$_POST["DateCosting"]; */
                $DateClose              =$_POST["DateClose"];
                $EmailSales             =$_POST["EmailSales"];
                $EmailRND               =$_POST["EmailRND"];
                $EmailFA                =$_POST["EmailFA"];
                $EmailMKT               =$_POST["EmailMKT"];
                $AppName                =$_POST["AppName"];
                $FrameName              =$_POST["FrameName"];
                $GenifName              =$_POST["GenifName"];
                $departtement           =$_POST["Dept"];
                $komen                  =$_POST["Comment"]; 
                $Status_Close           ='CLOSE';
                //$Status_Open            ='OPEN';
                $sql13="update tdocument 
                Left Join tapplications on tdocument.NumDoc = tapplications.NumDoc
                Left Join tframedetail on tdocument.NumDoc = tframedetail.NumDoc
                Left Join tgeninformation on tdocument.NumDoc = tgeninformation.NumDoc 
                        
                set
                tdocument.NumDoc          ='$NumDoc',
                tdocument.StatusRequest   ='$StatusRequest',
                tdocument.StatusDoc       ='$StatusDoc',
                tdocument.CustName        ='$CustName',
                tdocument.Prod_Name       ='$Prod_Name',
                tdocument.CodeProject     ='$CodeProject',
                tdocument.NPDType         ='$NPDType',
                tdocument.NPDTypeName     ='$NPDTypeName',
                tdocument.CustPhone       ='$CustPhone',
                tdocument.DateFeedbackExp ='$DateFeedbackExp',
                tdocument.PatternFiber    ='$PatternFiber',
                tdocument.SpecialSize     ='$SpecialSize',
                tdocument.OtherLinkDrawing='$OtherLinkDrawing',
                tdocument.PackagingDetail ='$PackagingDetail',
                tdocument.Square          ='$Square',
                tdocument.Budget          ='$Budget',
                tdocument.Location        ='$Location',
                tdocument.DateTarget      ='$DateTarget',
                tdocument.ImportantRequest='$ImportantRequest',
                tdocument.DateVerification='$DateVerification',
                
                tdocument.DateClose       ='$DateClose',
                tdocument.EmailSales      ='$EmailSales',
                tdocument.EmailRND        ='$EmailRND',
                tdocument.EmailFA         ='$EmailFA',
                tdocument.EmailMKT        ='$EmailMKT',
                tapplications.AppName     ='$AppName',
                tframedetail.FrameName    ='$FrameName',
                tgeninformation.GenifName ='$GenifName'
                where tdocument.NumDoc    ='$NumDoc'";
                $sql12 = "update tdocument set StatusDoc = '$Status_Close' where tdocument.NumDoc ='$NumDoc'";
                //$sql14 = "update tdocument set StatusDoc = '$Status_Open' where tdocument.NumDoc ='$NumDoc'";
                $sql15 = "insert into thistorycomment(NumDoc,DateComment,Dept,Comment) VALUES ('$NumDoc','$DR','$departtement','$komen')";
                $masukandata=mysqli_query($kon,$sql13);
                $update_close=mysqli_query($kon,$sql12);
                //$update_open=mysqli_query($kon,$sql14);
                $insert_history=mysqli_query($kon,$sql15);
                if ($masukandata AND $StatusDoc == 'CLOSE' AND $update_close AND $insert_history) {
                    
                        mysqli_query($kon,"COMMIT");
                        header("Location:../../../index.php?page=beranda-sales&edit=berhasil");
                }
                
                else{
                        mysqli_query($kon,"ROLLBACK");
                        header("Location:../../../index.php?page=beranda-sales&edit=berhasil");
                }
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                include '../../../config/database.php';
                //Memulai transaksi
                mysqli_query($kon,"START TRANSACTION");
    
                $NumDoc                 =$_POST["NumDoc"];
                $StatusRequest          ='SALES';
                $StatusDoc              =$_POST["StatusDoc"];
                $CustName               =$_POST["CustName"];
                $Prod_Name              =$_POST["Prod_Name"];
                $CodeProject            =$_POST["CodeProject"];
                $NPDType                =$_POST["NPDType"];
                $NPDTypeName            =$_POST["NPDTypeName"];
                $CustPhone              =$_POST["CustPhone"];
                $DateFeedbackExp        =$_POST["DateFeedbackExp"];
                $PatternFiber           =$_POST["PatternFiber"];
                $SpecialSize            =$_POST["SpecialSize"];
                $OtherLinkDrawing       =$_POST["OtherLinkDrawing"];
                $PackagingDetail        =$_POST["PackagingDetail"];
                $Square                 =$_POST["Square"];
                $Budget                 =$_POST["Budget"];
                $Location               =$_POST["Location"];
                $DateTarget             =$_POST["DateTarget"];
                $ImportantRequest       =$_POST["ImportantRequest"];
                $DateVerification       =$_POST["DateVerification"];
                /* $DateEstBOM             =$_POST["DateEstBOM"];
                $DateCosting            =$_POST["DateCosting"]; */
                $DateClose              =$_POST["DateClose"];
                $EmailSales             =$_POST["EmailSales"];
                $EmailRND               =$_POST["EmailRND"];
                $EmailFA                =$_POST["EmailFA"];
                $EmailMKT               =$_POST["EmailMKT"];
                $AppName                =$_POST["AppName"];
                $FrameName              =$_POST["FrameName"];
                $GenifName              =$_POST["GenifName"];
                $departtement           =$_POST["Dept"];
                $komen                  =$_POST["Comment"]; 
                $Status_Order           ='ORDER';
                //$Status_Open            ='OPEN';
                $sql21="update tdocument 
                Left Join tapplications on tdocument.NumDoc = tapplications.NumDoc
                Left Join tframedetail on tdocument.NumDoc = tframedetail.NumDoc
                Left Join tgeninformation on tdocument.NumDoc = tgeninformation.NumDoc 
                        
                set
                tdocument.NumDoc          ='$NumDoc',
                tdocument.StatusRequest   ='$StatusRequest',
                tdocument.StatusDoc       ='$StatusDoc',
                tdocument.CustName        ='$CustName',
                tdocument.Prod_Name       ='$Prod_Name',
                tdocument.CodeProject     ='$CodeProject',
                tdocument.NPDType         ='$NPDType',
                tdocument.NPDTypeName     ='$NPDTypeName',
                tdocument.CustPhone       ='$CustPhone',
                tdocument.DateFeedbackExp ='$DateFeedbackExp',
                tdocument.PatternFiber    ='$PatternFiber',
                tdocument.SpecialSize     ='$SpecialSize',
                tdocument.OtherLinkDrawing='$OtherLinkDrawing',
                tdocument.PackagingDetail ='$PackagingDetail',
                tdocument.Square          ='$Square',
                tdocument.Budget          ='$Budget',
                tdocument.Location        ='$Location',
                tdocument.DateTarget      ='$DateTarget',
                tdocument.ImportantRequest='$ImportantRequest',
                tdocument.DateVerification='$DateVerification',
               
                tdocument.DateClose       ='$DateClose',
                tdocument.EmailSales      ='$EmailSales',
                tdocument.EmailRND        ='$EmailRND',
                tdocument.EmailFA         ='$EmailFA',
                tdocument.EmailMKT        ='$EmailMKT',
                tapplications.AppName     ='$AppName',
                tframedetail.FrameName    ='$FrameName',
                tgeninformation.GenifName ='$GenifName'
                where tdocument.NumDoc    ='$NumDoc'";
                $sql22 = "update tdocument set StatusDoc = '$Status_Order' where tdocument.NumDoc ='$NumDoc'";
                //$sql14 = "update tdocument set StatusDoc = '$Status_Open' where tdocument.NumDoc ='$NumDoc'";
                $sql23 = "insert into thistorycomment(NumDoc,DateComment,Dept,Comment) VALUES ('$NumDoc','$DR','$departtement','$komen')";
                $masukandata=mysqli_query($kon,$sql21);
                $update_close=mysqli_query($kon,$sql22);
                //$update_open=mysqli_query($kon,$sql14);
                $insert_history=mysqli_query($kon,$sql23);
                if ($masukandata AND $StatusDoc == 'ORDER' AND $update_close AND $insert_history) {
                    
                        mysqli_query($kon,"COMMIT");
                        header("Location:../../../index.php?page=beranda-sales&edit=berhasil");
                }
                
                else{
                        mysqli_query($kon,"ROLLBACK");
                        header("Location:../../../index.php?page=beranda-sales&edit=berhasil");
                }
            }


    }


    
?>

<?php 
    include '../../../config/database.php';
    $NumDoc=$_POST["NumDoc"];
    $sql="select * from tdocument left join tapplications on tdocument.NumDoc = tapplications.NumDoc left join tframedetail on tdocument.NumDoc = tframedetail.NumDoc left join tgeninformation on tdocument.NumDoc = tgeninformation.NumDoc left join thistorycomment on tdocument.NumDoc = thistorycomment.NumDoc  where tdocument.NumDoc='$NumDoc' limit 1";
    $hasil=mysqli_query($kon,$sql);
    $data = mysqli_fetch_array($hasil); 
?>

<form action="pages/sales/beranda/edit.php" method="post">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Product Name:</label>
                <input type="hidden" name="NumDoc" value="<?php echo $data['NumDoc'];?>" class="form-control" readonly >
                <input type="text" name="Prod_Name" value="<?php echo $data['Prod_Name'];?>" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Status Request:</label>
                <input type="text" name="StatusRequest" value="<?php echo $data['StatusRequest'];?>" class="form-control"  required>
                <input type="hidden" name="CustName" value="<?php echo $data['CustName'];?>" class="form-control">
                <input type="hidden" name="Prod_Name" value="<?php echo $data['Prod_Name'];?>" class="form-control">
                <input type="hidden" name="CodeProject" value="<?php echo $data['CodeProject'];?>" class="form-control">
                <input type="hidden" name="NPDType" value="<?php echo $data['NPDType'];?>" class="form-control">
                <input type="hidden" name="NPDTypeName" value="<?php echo $data['NPDTypeName'];?>" class="form-control">
                <input type="hidden" name="CustPhone" value="<?php echo $data['CustPhone'];?>" class="form-control">
                <input type="hidden" name="DateFeedbackExp" value="<?php echo $data['DateFeedbackExp'];?>" class="form-control">
                <input type="hidden" name="PatternFiber" value="<?php echo $data['PatternFiber'];?>" class="form-control">
                <input type="hidden" name="SpecialSize" value="<?php echo $data['SpecialSize'];?>" class="form-control">
                <input type="hidden" name="OtherLinkDrawing" value="<?php echo $data['OtherLinkDrawing'];?>" class="form-control">
                <input type="hidden" name="PackagingDetail" value="<?php echo $data['PackagingDetail'];?>" class="form-control">
                <input type="hidden" name="Square" value="<?php echo $data['Square'];?>" class="form-control">
                <input type="hidden" name="Budget" value="<?php echo $data['Budget'];?>" class="form-control">
                <input type="hidden" name="Location" value="<?php echo $data['Location'];?>" class="form-control">
                <input type="hidden" name="DateTarget" value="<?php echo $data['DateTarget'];?>" class="form-control">
                <input type="hidden" name="ImportantRequest" value="<?php echo $data['ImportantRequest'];?>" class="form-control">
                <input type="hidden" name="DateVerification" value="<?php echo $data['DateVerification'];?>" class="form-control">
                <!-- <input type="hidden" name="DateEstBOM" value="<?php echo $data['DateEstBOM'];?>" class="form-control"> -->
                <!-- <input type="hidden" name="DateCosting" value="<?php echo $data['DateCosting'];?>" class="form-control"> -->
                <input type="hidden" name="DateClose" value="<?php echo $data['DateClose'];?>" class="form-control">
                <input type="hidden" name="EmailSales" value="<?php echo $data['EmailSales'];?>" class="form-control">
                <input type="hidden" name="EmailRND" value="<?php echo $data['EmailRND'];?>" class="form-control">
                <input type="hidden" name="EmailFA" value="<?php echo $data['EmailFA'];?>" class="form-control">
                <input type="hidden" name="EmailMKT" value="<?php echo $data['EmailMKT'];?>" class="form-control">
                <input type="hidden" name="AppName" value="<?php echo $data['AppName'];?>" class="form-control">
                <input type="hidden" name="FrameName" value="<?php echo $data['FrameName'];?>" class="form-control">
                <input type="hidden" name="GenifName" value="<?php echo $data['GenifName'];?>" class="form-control">

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
            
                <label>Status Doc:</label>
                <!--<input type="text" name="StatusDoc" value="" class="form-control" placeholder="Masukan Data" required>-->
                <!--<select class="form-control" name="StatusDoc" value="">-->
                <select class="form-control" name="StatusDoc" required>
                    <option value="<?php echo $data['StatusDoc'];?>"><?php echo $data['StatusDoc'];?></option>
                    <option value="CLOSE">CLOSE</option>
                    <option value="CORRECTED">CORRECTED</option>
                    <option value="ORDER">ORDER</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Comment :</label>
                <textarea name="Comment" class="form-control"><?php echo $data['Comment'];?></textarea>
                <input type="hidden" name="Dept" value="SALES">
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-4">


        <?php
            if ($data['StatusDoc'] == 'OPEN' AND $data['StatusRequest'] == 'SALES') {
                echo '<button type="submit" name="edit_mapel" id="Submit" class="btn btn-warning">Update</button>';
            }
            else {
                /* echo '<button type="button" name="edit_kelas" id="Submit" class="btn btn-warning" disabled>Update</button>'; */
                echo '<button type="submit" name="edit_mapel" id="Submit" class="btn btn-warning" disabled>Update</button>';
            }

            ?>


            
           <!--  <button type="submit" name="edit_mapel" id="Submit" class="btn btn-warning">Update</button> -->
        </div>
    </div>
</form>