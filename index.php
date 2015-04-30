<!--Frontend Bootstrap-->
<!DOCTYPE HTML>
<html lang="en">
 <head>
    <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>PHP File Uploader</title>
     <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
     
    </head>
    
<body>
    
    <!--Static Navbar-->
    <div class="navbar navbar-default navbar-static-top">
       <div class="container">
         <div class="navbar-header">
             <a class="navbar-brand" href="index.php">PHP File uploader lovy&copy;</a>
           
            </div>                    
        </div>        
    </div>
    
    
<!--Form Contents-->    
    <div class="container">
        
           <div class="row">
               <div class="col-sm-12">
        <form class="well"  method="post" enctype="multipart/form-data">
            <div class="form-group">
    <label>Name</label>
    <input id="Name" class="form-control" type="text" name="name" placeholder="Enter name" required/></input>

            </div>
                   
                       <div class="form-group">
            <label>Email</label>
            <input id="Email" class="form-control" type="email" name="email" placeholder="Email" required/></input>
            </div>
               
               
               <div class="form-group">
               <label>Contact No.</label>
               <input id="Contact No." class="form-control" type="text" name="contact" placeholder="Mobile" required/></input>
                </div>
        
        
            <div class="form-group">
                <label for="file">Upload here</label>
                <input type="file" name="file">
                <p class="help-block">Only doc,docx,pdf files with maximum size of 2 MB is allowed.</p> 
            </div>
        
        
            <input type="submit" name="submit" class="btn btn-sm btn-success" value="Upload">
           
           </form>
               </div>
            </div>
        </div>
            
    </body>

</html>

<!--Scripting Part-->


<?php
if (!empty($_POST['submit']))

{   if($_POST['submit'] == 'Upload')

{



   $response='';
        $new_file_name='';
    $size='';
$nam='';
    $email='';
        $contact='';
if($_SERVER['REQUEST_METHOD']=='POST')
    { $name= $_FILES['file'] ['name'];
      $tmpname=$_FILES['file'] ['tmp_name'];
      $error= $_FILES['file'] ['error'];
      $size= $_FILES['file'] ['size'];
      $ext= strtolower(pathinfo($name, PATHINFO_EXTENSION));
     $response='';
     
     $todays_date = date("mdYHis");
     $new_file_name=$todays_date.rand(10,100).$name;

switch($error) {
    case UPLOAD_ERR_OK:
                    $valid = true;
                    //validate file extensions
                    if ( !in_array($ext, array('pdf','doc','docx','txt')) ) {
                        $valid = false;
                        $response = 'Invalid file extension.';
                    }
                    //validate file size
                    if ( $size/1024/1024 > 2 ) {
                        $valid = false;
                        $response = 'File size is exceeding maximum allowed size.';
                    }
                    //upload file
                    if ($valid) {
                        $destination = 'C:\xampp\htdocs\File Upload\uploads\\';
            
                        move_uploaded_file($_FILES['file']['tmp_name'], $destination. $new_file_name);
                        
                    }
                    break;
                
        }
    }
echo $response;
//Database

if (!empty($_POST['name']))
{
        $nam=$_POST['name'];
            
  }


if (!empty($_POST['email']))
{
$email=$_POST['email'];
 
}
 

if (!empty($_POST['contact']))
    {
$contact=$_POST['contact']; 

}


include('conn.php');


$sql= mysqli_query($conn,"INSERT INTO `tab` (`CName`,`Email`,`contact`) VALUES('$nam','$email','$contact') ");
$sql= mysqli_query($conn,"INSERT INTO `res_details` (`Fname`,`Size`) VALUES('$new_file_name', '$size') ");


/* FOr redirection to a particular web page
header("Location: http:///");
*/

}
}
?>

