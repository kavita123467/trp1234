    <?php
    $page = 'two';
    include("includes/config.php");
  //error showing msg  
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
    
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\SMTP;
   use PHPMailer\PHPMailer\Exception;


//Load Composer's autoloader
require('php-mailer/Exception.php');
require('php-mailer/SMTP.php');
require('php-mailer/PHPMailer.php');

///index value
$vendorCompanyname = $_POST['venderCompanyname'];
$vendorHoaddress = $_POST['vendorHoaddress'];
$vendorGstno = $_POST['vendorGstno'];
$vendorFullname =$_POST['vendorFullname'];
$vendorPhone = $_POST['vendorPhone'];
$vendorEmail = $_POST['vendorEmail '];
$vendorWebsite =$_POST['vendorWebsite'];
$msg1="Vendor Company Name *</br>".$vendorCompanyname. "Contact Person Name * </br> ".$vendorFullname." Email *</br>".$vendorEmail."Website </br>".$vendorEmail." HO Address </br>*".$vendorHoaddress. "Mobile No *</br> ".$vendorPhone."GST No </br>".$vendorGstno." ";
echo $vendorCompanyname;
echo $vendorEmail;


if(isset($_POST['savevendor'])){

                 
   
       // $Materials = implode(',',$_REQUEST['vendorMaterials']);
    
            

   $insert =mysqli_query($connect, "INSERT INTO  vendors SET 
                    vendorCompanyname = '".$_REQUEST['vendorCompanyname']."',
                    vendorHoaddress = '".$_REQUEST['vendorHoaddress']."',
                    vendorGstno = '".$_REQUEST['vendorGstno']."',
                    vendorFullname = '".$_REQUEST['vendorFullname']."',
                    vendorPhone = '".$_REQUEST['vendorPhone']."',
                    vendorEmail = '".$_REQUEST['vendorEmail']."',
                    vendorWebsite = '".$_REQUEST['vendorWebsite']."'"); 
                    
                    
                    
             $id = mysqli_insert_id($connect);
              
             
            
            foreach ($_FILES['vendorfiles']['name'] as $k=>$files)
            {
                 $temp_name1=$_FILES['vendorfiles']['tmp_name'][$k];
               $file_name21=$files;   
                $fl = time();
                $nefilename =   $fl.$file_name21;
                $file_path1="images/seller/".$nefilename;
                move_uploaded_file($temp_name1,$file_path1);
                  
                $insert =mysqli_query($connect, "INSERT INTO vendorfiles SET 
                    vendorfileVid = '".$id."',
                    vendorfilePath   = '".$nefilename."'"); 
            }
            
            $mail = new PHPMailer(true);
            //Server settings
           // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'kavitaperfectiongeeks@gmail.com';                     //SMTP username
            $mail->Password   = 'zaoctblsmrdbkwsk';                               //SMTP password
            $mail->SMTPSecure = TLS;          //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom=$_POST['vendorEmail'];
            $mail->Fromname=$_POST['vendorFullname'];
            $mail->addAddress('kavitaperfectiongeeks@gmail.com','touser'); 
           // $mail->AddCC($_POST["buyerEmail"], $_POST["buyerFullname"]); //Adds a "Cc" address
            $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
            $mail->IsHTML(true);       //Sets message type to HTML    
            $mail->Subject = $_POST["vendorWebsite"];    //Sets the Subject of the message
            $mail->Body = $msg1  ; //Add a recipient
            if($mail->Send()) 
             {
              header("Location:vendor.php?msg=s");
                         }
                         else
           {
            $msgs ='<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong>Sorry</strong> 
            
          </div>';
           }
          }
   
    
    if($_REQUEST['msg'] == "s")
    {
        $msgs ='<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
    <strong>Thank you for sharing your requirements with TRP. Our team will connect with you.</strong> 
    
  </div>';
    } 
    
      include("header.php")
    
    ?>
    <!-- middle-content -->
   <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

    <section id="content">
        <div class="content-wrap py-0">
<?php 
echo $vendorCompanyname;
echo $vendorEmail;

?>
            <!-- categories -->
            <div class="custom-bg my-0" style="--custom-bg: #ffffff;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 padding0">
                            <div class="youtube-video">
                                <iframe src="https://www.youtube.com/embed/0DdoTPgXj1g?autoplay=1&mute=1"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                     <div class="row">
                        <div class="col-md-8 offset-md-2">
                           
                            <div class="buyerForm">
                                 <?php echo $msgs; ?>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <h2>Send us a message</h2>
                                    <div class="row">
                                         <div class="col-lg-6">
                                            <label>Contact Person Name *</label>
                                            <input type="text" class="form-control" required name="vendorFullname" id="inputTextBox">
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Vendor Company Name </label>
                                            <input type="text" class="form-control"  name="vendorCompanyname" id="inputTextBox">
                                        </div>
                                        <div class="col-lg-6">
                                            <label>HO Address *</label>
                                            <input type="text" class="form-control" required name="vendorHoaddress">
                                        </div>
                                        <div class="col-lg-6">
                                            <label>GST No </label>
                                            <input type="text" class="form-control"  name="vendorGstno">
                                        </div>
                                       
                                        <div class="col-lg-6">
                                            <label>Mobile No *</label>
                                            <input type="text" class="form-control" min="10" required name="vendorPhone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Email *</label>
                                            <input type="email" class="form-control" required name="vendorEmail">
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Website</label>
                                            <input type="text" class="form-control" name="vendorWebsite">
                                        </div>
                                        <!--<div class="col-lg-6">-->
                                        <!--    <label>Materials Dealt in</label>-->
                                        <!--    <div id="list1" class="dropdown-check-list" tabindex="100">-->
                                        <!--      <span class="anchor">Select</span>-->
                                        <!--      <ul class="items">-->
                                        <!--        <li><input type="checkbox" name="vendorMaterials[]" value="Trader" />Trader </li>-->
                                        <!--        <li><input type="checkbox" name="vendorMaterials[]" value="Dealer"/>Dealer</li>-->
                                        <!--        <li><input type="checkbox" name="vendorMaterials[]" value="Distributor"/>Distributor </li>-->
                                        <!--        <li><input type="checkbox" name="vendorMaterials[]" value="Manufacturer"/>Manufacturer </li>-->
                                        <!--      </ul>-->
                                        <!--    </div>-->
                          
                                        <!--</div>-->
                                     
                                        
                                         <div class="col-lg-6" id="dynamic_field" style="margin-top: 26px !important; ">
                                           <div class="row" >

<div class="col-lg-10">  <input type="file" name="vendorfiles[]"  class="form-control" /> </div>  <div class="col-lg-2">
                                        <td><button type="button" name="add" id="add" class="btn btn-success">+</button></td>
                                    </div></div>
                                  </div>
                                        <div class="col-lg-12 text-center">
                                            <button class="btn btnsubmitbuyer" name="savevendor" type="submit"> <span class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mid-sec -->
            
             <div class="modal fade" id="exampleModalc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Message</h5>
                                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color:#000 !important;">X</button>
                                       </div>  
                                      <div class="modal-body text-danger" style="text-align:center;">
                                     Please select file  less than 5 MB
                                      </div>
                                    </div>
                                  </div>
                                </div>
            
            
        </div>
    </section>
   
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

       
<script type="text/javascript">
   
     
    $(document).ready(function() {

   var i = 1;
                $('#add').click(function () {
                    i++;
                    $('#dynamic_field').append('<div class="row" id="row' + i + '"> <div class="col-lg-10"><input type="file" class="form-control" name="vendorfiles[]"> </div> <div class="col-lg-2"> <td><button type="button" name="add" class="btn btn-danger btn_remove" id="' + i + '">-</button></td> </div> </div>');
                });
                $(document).on('click', '.btn_remove', function () {
                    var button_id = $(this).attr("id");

                    $('#row' + button_id + '').remove();
                });



});
</script>    
   

<script>
   $(() => {
  $('button').on('click', e => {
    let spinner = $(e.currentTarget).find('span')
    spinner.removeClass('d-none')
    setTimeout(_ => spinner.addClass('d-none'), 10000)
  })
})
</script>
          
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<style>
#gotoTop{
    display: none !important;
}
   .float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#393939;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  font-size:30px;
	box-shadow: 2px 2px 3px #999;
  z-index:100;
}

.my-float{
	margin-top:16px;
	color: #FFF;
}
</style>

<script>
    $(document).on('keypress', '#inputTextBox', function (event) {
    var regex = new RegExp("^[a-zA-Z ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});
</script>

    <!-- middle-content -->
<div class="icon-bar">
 <a href="https://wa.me/917011558052" class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>
</div>


    <?php include("footer.php"); ?>
    
