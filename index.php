<html>
   <head>
      <meta charset="utf-8">   <!-- meta-data -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="PHP File Upload">
      <meta name="author" content="Pavan Satish Kutha">
      <title>PHP File Upload</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="./assets/css/style.css">   <!-- external style sheet -->
   </head>
   <body>
      <div align="center">   <!-- div align to be center -->
         <h2>PHP- File Upload</h2>
         <form action="" enctype="multipart/form-data" method="post" class="form">
            <p class="txt">Select File-type to upload :</p>
            <fieldset id="fileType">
               <div class="fieldgroup">
                  <input type="radio" checked name="fileType" id="img" value="Image"><label for="payment1">Image (jpg,gif)
                  </label>
               </div>
               <div class="fieldgroup">
                  <input type="radio" name="fileType" id="pdf" value="Pdf"><label for="payment2">Pdf (.pdf)</label>
               </div>
               <div class="fieldgroup">
                  <input type="radio" name="fileType" id="txt" value="Text"><label for="payment2">Text (.txt)</label>
               </div>
               <div class="fieldgroup">
                  <input type="radio" name="fileType" id="doc" value="Documents"><label for="payment2">Documents (.doc)</label>
               </div>
               <div class="fieldgroup">
                  <input type="radio" name="fileType" id="xslx" value="Excel"><label for="payment2">Excel (.xlsx)</label>
               </div>
            </fieldset>
            <p class="note"> <b style="color: red;">*</b>Note: File size must be
               < 400kb
            </p>
            
            <input type="file" id="theFileInput" name="file"/>
            <div class='captcha_wrapper' >
                <div class='g-recaptcha' id="recaptcha" data-sitekey='6Ldi1EwUAAAAABw9_lbpS-qJ-L3Vms9urU5y-SSM' style="display: none;">       
                </div>
            </div>            
            <center><input type="submit" value="Upload" name="Submit" class="btn btn-green"></center>
         </form>
         <?php
            // errors displaying
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            
            // on submit 
            if(isset($_POST['Submit']))
            {       
                    // declaring variables
                $file_name = $_FILES['file']['name'];
                $file_type = $_FILES['file']['type'];
                $file_size = $_FILES['file']['size'];
                $file_Eror = $_FILES['file']['error'];
                $file_TmpName = $_FILES['file']['tmp_name'];
            
                $fileExt = explode('.', $file_name);
                $fileActualExt = strtolower(end($fileExt));
                    // allowing particular file extension types 
                $allowedImgExt= array('jpg','gif');
                $allowedFileExtPdf = array('pdf');
                $allowedFileExtTxt = array('txt');
                $allowedFileExtDoc = array('doc');
                $allowedFileExtExc = array('xlsx');
                    // Random names for files that will be uploaded.
                $rand= rand(100,999);
                $fileNameNewImg="image-".$rand;
                $fileNameNewPdf="pdf-".$rand;
                $fileNameNewTxt="txt-".$rand;
                $fileNameNewDoc="doc-".$rand;
                $fileNameNewExc="xlsx-".$rand;
 

                //Image extension files uploading 
                if ($_POST["fileType"] == "Image") {            
                if(!empty($_FILES['file']['name'])){               /*if no file is selected */
                if(in_array($fileActualExt, $allowedImgExt)){                  
                    if ($file_size < 400000) {                  /*file size is < 400kb*/
                            // for file name of each file to be unique
                        // $fileNameNew= uniqid('',true).".".$fileActualExt;
                        $fileDestination='./assets/uploads/photos/'.$fileNameNewImg;  // Declaring Path for uploaded images.
                        move_uploaded_file($file_TmpName,$fileDestination);
                        if(isset($_POST['g-recaptcha-response'])){               // Recaptcha working
                        $captcha=$_POST['g-recaptcha-response'];
                        }
                        if($captcha){
                            $secretKey = "6Ldi1EwUAAAAAFhrPoGYRDs-v7G-k77kGOtDhmue";
                            $ip = $_SERVER['REMOTE_ADDR'];
                            $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
                            $responseKeys = json_decode($response,true);
                            if(intval($responseKeys["success"]) == 1) {
                        
                        echo "<img id='empty' src=".$fileDestination."
                        height='150px' width='250px'>"; 
                    }
                    else{
                        echo '<p>You are spammer ! Get the out of here</p>';
                    }
                    }else{
                        echo "<p id='empty'>Please confirm you are not robot!</p>";
                    }
                    }
                    else{
                        echo "<p id='empty'>**file is too large!**</p>";
                    }
                     }
                else{
                        echo "<p id='empty'>**Wrong file type..Please upload only <b style='color:coral;'>Image files of jpg & gif format.</b>**</p>";
                    }
                    }
                    else{
                         echo "<p id='empty'>**Please select <b style='color:coral;'>atleast one file to proceed!</b>**</p>";
                    }
               

            }
                // Pdf files uploading
                elseif($_POST["fileType"] == "Pdf"){
                    if(!empty($_FILES['file']['name'])){                    /*if no file is selected */
                    if(in_array($fileActualExt, $allowedFileExtPdf)){
                    if ($file_size <400000) {                               /*file size is < 400kb*/
                          if(isset($_POST['g-recaptcha-response'])){               // Recaptcha working
                        $captcha=$_POST['g-recaptcha-response'];
                        }
                        if($captcha){
                            $secretKey = "6Ldi1EwUAAAAAFhrPoGYRDs-v7G-k77kGOtDhmue";
                            $ip = $_SERVER['REMOTE_ADDR'];
                            $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
                            $responseKeys = json_decode($response,true);
                            if(intval($responseKeys["success"]) == 1) {
                        $fileDestination='./assets/uploads/PDFs/'.$fileNameNewPdf;
                        move_uploaded_file($file_TmpName, $fileDestination);
                        echo "<iframe id='empty' src='".$fileDestination ."'height='150px' width='250px'></iframe>";
                    }
                    else{
                        echo '<p>You are spammer ! Get the out of here</p>';
                    }
                    }else{
                        echo "<p id='empty'>Please confirm you are not robot!</p>";
                    }
                    }
                    else{
                        echo "<p id='empty'>**file is too large**</p>";
                    }
                }
                    else{
                    
                        echo "<p id='empty'>**Wrong file type..Please upload only <b style='color:coral;'>PDF files</b>**</p>";
                    }
                }
                else{
                        echo "<p id='empty'>**Please select <b style='color:coral;'>atleast one file to proceed!</b>**</p>";
            }
            }
            // Text files uploading
            elseif($_POST["fileType"] == "Text"){
                    if(!empty($_FILES['file']['name'])){                    /*if no file is selected */
                    if(in_array($fileActualExt, $allowedFileExtTxt)){
                    if ($file_size <400000) {                               /*file size is < 400kb*/
                          if(isset($_POST['g-recaptcha-response'])){               // Recaptcha working
                        $captcha=$_POST['g-recaptcha-response'];
                        }
                        if($captcha){
                            $secretKey = "6Ldi1EwUAAAAAFhrPoGYRDs-v7G-k77kGOtDhmue";
                            $ip = $_SERVER['REMOTE_ADDR'];
                            $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
                            $responseKeys = json_decode($response,true);
                            if(intval($responseKeys["success"]) == 1) {
                        $fileDestination='./assets/uploads/texts/'.$fileNameNewTxt;
                        move_uploaded_file($file_TmpName, $fileDestination);
                        echo "<iframe id='empty' src='".$fileDestination ."'height='150px' width='250px'></iframe>";
                    }
                    else{
                        echo '<p>You are spammer ! Get the out of here</p>';
                    }
                    }else{
                        echo "<p id='empty'>Please confirm you are not robot!</p>";
                    }
                    }
                    else{
                        echo "<p id='empty'>**file is too large**</p>";
                    }
                }
                    else{
                        echo "<p id='empty'>**Wrong file type..Please upload only <b style='color:coral;'>text files</b>**</p>";
                    
                }
                }
                else{
                    echo "<p id='empty'>**Please select <b style='color:coral;'>atleast one file to proceed!</b>**</p>";
            }
            }
            // Document files uploading
            elseif($_POST["fileType"] == "Documents"){
                    if(!empty($_FILES['file']['name'])){                    /*if no file is selected */
                    if(in_array($fileActualExt, $allowedFileExtDoc)){
                    if ($file_size <400000) {                               /*file size is < 400kb*/
                          if(isset($_POST['g-recaptcha-response'])){               // Recaptcha working
                        $captcha=$_POST['g-recaptcha-response'];
                        }
                        if($captcha){
                            $secretKey = "6Ldi1EwUAAAAAFhrPoGYRDs-v7G-k77kGOtDhmue";
                            $ip = $_SERVER['REMOTE_ADDR'];
                            $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
                            $responseKeys = json_decode($response,true);
                            if(intval($responseKeys["success"]) == 1) {
                        $fileDestination='./assets/uploads/docs/'.$fileNameNewDoc;
                        move_uploaded_file($file_TmpName, $fileDestination);
                        // we can view document files by giving url of path file
                        // echo "<iframe src='https://docs.google.com/viewer?url='".$fileDestination."'&embedded=true' frameborder='0'></iframe>";
                        echo "<p id='empty' style='color:coral;'><b><i class='glyphicon glyphicon-ok' style='color:#51d466;'></i></b>Your document file uploaded successfully!</p>";
                    }
                    else{
                        echo '<p>You are spammer ! Get the out of here</p>';
                    }
                    }else{
                        echo "<p id='empty'>Please confirm you are not robot!</p>";
                    }
                    }
                    else{
                        echo "<p id='empty'>**file is too large**</p>";
                    }
                }
                    else{
                        echo "<p id='empty'>**Wrong file type..Please upload only <b style='color:coral;'>document files(.doc)</b>**</p>";
                    
                }
                }
                else{
                    echo "<p id='empty'>**Please select <b style='color:coral;'>atleast one file to proceed!</b>**</p>";
            }
            }
            // Excel files uploading
            elseif($_POST["fileType"] == "Excel"){
                if(!empty($_FILES['file']['name'])){                            /*if no file is selected */              
                    if(in_array($fileActualExt, $allowedFileExtExc)){                   
                    if ($file_size <400000) {                                   /*file size is < 400kb*/
                          if(isset($_POST['g-recaptcha-response'])){               // Recaptcha working
                        $captcha=$_POST['g-recaptcha-response'];
                        }
                        if($captcha){
                            $secretKey = "6Ldi1EwUAAAAAFhrPoGYRDs-v7G-k77kGOtDhmue";
                            $ip = $_SERVER['REMOTE_ADDR'];
                            $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
                            $responseKeys = json_decode($response,true);
                            if(intval($responseKeys["success"]) == 1) {
                        $fileDestination='./assets/uploads/excel/'.$fileNameNewExc;
                        move_uploaded_file($file_TmpName, $fileDestination);
                        echo "<p id='empty'style='color:coral;'><b><i class='glyphicon glyphicon-ok' style='color:#51d466;'></i></b>Your Excel file uploaded successfully!</p>";
                    }
                    else{
                        echo '<p>You are spammer ! Get the out of here</p>';
                    }
                    }else{
                        echo "<p id='empty'>Please confirm you are not robot!</p>";
                    }
                    }
                    else{
                        echo "<p id='empty'>**file is too large**</p>";
                    }
                }
                    else{
                        echo "<p id='empty'>**Wrong file type..Please upload only <b style='color:coral;'>Excel files(.xlsx)</b>**</p>";
                    
                }
                }
                else{
                    echo "<p id='empty'>**Please select <b style='color:coral;'>atleast one file to proceed!</b>**</p>";  
            }
            }
        }

            ?>
      </div>
      <div class="container">
         <div class="row">
            <!-- <div class="col-md-12"> -->
            <div class="carousel carousel-showmanymoveone slide" id="framesid">
               <div class="carousel-inner">
                  <div class="item active">
                     <?php 
                        //display all images in the directory
                        $files = glob("./assets/uploads/photos/**");
                        // if (is_dir($dir_path)) 
                        // {
                        // $file = scandir($dir_path);
                        
                        //remove ./ and ../ folders 
                        // $files = array_values(array_diff($file, array('.', '..')));

                        $per_page = 5;
                        $page = $per_page;
                        if(isset($_REQUEST['page']))
                        {
                        $page = $_REQUEST['page'] - 1;
                        
                        $from = $page * $per_page;
                        $to = $from + $per_page;    
                        }
                        else
                        {
                        $from = 0;
                        $to = $per_page;
                        }
                        for($i = 0 ; $i < count($files) ; $i++)
                            
                        {
                            $image = $files[$i];
                        if($i >= $from && $i < $to)
                        {
                        // $fileExt = explode('.', $files[$i]);
                        // $fileActualExt = strtolower(end($fileExt));
                        // $fileNameNew= uniqid('',true).".".$fileActualExt;
                        // $fileNameNew='image'. uniqid('',true);
                        // $rand= rand(100,999);
                        // $fileNameNew="image-".$rand;

                        // $allowedImgExt = array('jpg','gif');
                        // $allowedFileExt = array('txt','pdf');
                        // echo nl2br( file_get_contents("./assets/uploads/".$_FILES["file"]["name"]) );
                        // if(in_array($fileActualExt, $allowedImgExt)) {
                                echo "<form method='post'><div class='item'><div class='col-md-5ths col-xs-6'>
                                <a href='#'><img src='".$image."' style='width:180px;height:150px;' class='img-responsive'><p align='center'>".basename($image)."</p></div></div></form>";
                            // echo '<form method="post"><div class="item"><div class="col-md-5ths col-xs-6"><img src="'.$image.'"style=width:180px;height:150px;"/></div></div></form>';
                            //     echo basename($image);
                            // }
                            // to view pdf files in the slider
                            // elseif (in_array($fileActualExt, $allowedFileExt)) {
                            //  echo "<form method='post'><div class='item'><div class='col-md-5ths col-xs-6'>
                         //        <a href='#'><iframe src='$dir_path$files[$i]' style='width:150px;height:150px;' class='img-responsive'></iframe></a>";
                         //        echo "<div id='images'style='width:100px;display:table-caption;caption-side:bottom;'><b>$files[$i]</b></div></div></div>";
                                
                            // }
                            // else {
                            //     echo "<p>**Invalid file format**</p>";
                            // }
                        }
                        }
                        // }
                        
                        ?>
                  </div>
                  <?php 
                     $files_per_page = 5;
                     $number_of_files = count($files);
                     $number_of_pages = ceil($number_of_files/$files_per_page);
                     $page = isset($_GET['page']) ? $_GET['page'] : 1;
                     
                     $is_first = $page == 1;
                     $is_last  = $page == $number_of_pages;
                     
                     // Prev cannot be less than one
                     $prev = max(1, $page - 1);
                     // Next cannot be larger than $number_of_pages
                     $next = min($number_of_pages , $page + 1);
                     
                     // If we are on page 2 or higher
                     if(!$is_first) {
                         // echo '<a href="file_upload.php?page=1">First</a>';
                         echo '<a class="left carousel-control" href="file_upload.php?page='.$prev.'"><i class="glyphicon glyphicon-chevron-left"></i></a>';
                     }
                      // page number display
                     // echo '<span>Page '.$page.' / '.'</span>';
                     
                     // If we are not at the last page
                     if(!$is_last) {
                         echo '<a class="right carousel-control" href="file_upload.php?page='.$next.'"><i class="glyphicon glyphicon-chevron-right" ></i></a>';
                             // echo '<a href="file_upload.php?page='.$number_of_pages.'">Last</a>';
                     }
                     
                     ?>
               </div>
            </div>
            <!-- light-box -->
            <div id="background_overlay" iframe='true'></div>
         </div>
         <!-- row ending -->
      </div>
      <!-- container ending -->
      <p style="font-size: 15px;font-weight: bold;color: #51d466;">Tree structure of UPLOADS ITEMS:</p>
      <div class="tree">
         <?php
            $dir= "./assets/uploads/";
             function listFolderFiles($dir){
            $ffs = scandir($dir);
            // folders & sub-folders
            unset($ffs[array_search('.', $ffs, true)]);
            unset($ffs[array_search('..', $ffs, true)]);
            
            // prevent empty ordered elements
            if (count($ffs) < 1)
               return;
            
            echo '<ol>';
            foreach($ffs as $ff){
               echo '<li><a href=""</a><i class="glyphicon glyphicon-folder-open"></i> '. $ff;
               if(is_dir($dir.'/'.$ff)) listFolderFiles($dir.'/'.$ff);
               echo '</li>';
            }
            echo '</ol>';
            }           
            listFolderFiles('./assets/uploads/');
            ?>
      </div>
      <script src='https://www.google.com/recaptcha/api.js'></script>   <!-- google recaptcha js -->
      <script src="./assets/js/script.js"></script>    <!-- external js -->
   </body>
</html>