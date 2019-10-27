<?php include 'includes/header.php'?>   
<h2>Contact Us</h2>
<?php

$to = 'jfdavenport416@gmail.com';
    
$from = 'noreply@dreamhost.com';  

if(isset($_POST["First_Name"])){//if data show it
    
//    echo $_POST["First_Name"];    
    
//    echo '<pre>';
//    var_dump($_POST);
//    echo '</pre>';     
    
    $replyTo = $_POST["Email"];
    $subject = 'ITC240 Contact Page ';
//    $message = $_POST["Comments"];
    $message = process_post();
    $today = date('F, j, Y, g:i:s a');
    $subject .= $today;
    
    $headers = 'From: ' . $from . PHP_EOL .        
        'Reply-To: ' . $replyTo . PHP_EOL .        
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
//    echo 'Email sent? ' . $today;
    
    echo '
        <div class="form-group col-lg-12">
            <p>We\'ll get back to you shortly!</p>
            <p><a href="">BACK</a></p>
        </div>  
    ';
    
}else{//no data, show form
  echo '
    <form action="" method="post">
    
        <div class="row">
            <div class="form-group col-lg-4">
                <label class="text-heading" for="First_Name">First Name</label>
                <input class="form-control" type="text" name="First_Name" id="First_Name" autofocus required />
            </div>

            <div class="form-group col-lg-4">
                <label class="text-heading" for="Last_Name">Last Name</label>
                <input class="form-control" type="text" name="Last_Name" id="Last_Name" required />
            </div>

            <div class="form-group col-lg-4">
                <label class="text-heading" for="Email">Email</label>
                <input class="form-control" type="email" name="Email" id="Email" required />
            </div>
            
            <div class="clearfix"></div>

            <div class="form-group col-lg-12">
                <label class="text-heading" for="Comments">Comments</label>
                <textarea class="form-control" name="Comments" id="Comments"></textarea>
            </div>

            <div class="form-group col-lg-12">
                <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
        </div>
    </form>
  ';
}
?>
<?php 

include 'includes/footer.php';

function process_post()
{//loop through POST vars and return a single string
    $myReturn = ''; //set to initial empty value

    foreach($_POST as $varName=> $value)
    {#loop POST vars to create JS array on the current page - include email
         $strippedVarName = str_replace("_"," ",$varName);#remove underscores
        if(is_array($_POST[$varName]))
         {#checkboxes are arrays, and we need to collapse the array to comma separated string!
             $myReturn .= $strippedVarName . ": " . implode(",",$_POST[$varName]) . PHP_EOL;
         }else{//not an array, create line
             $myReturn .= $strippedVarName . ": " . $value . PHP_EOL;
         }
    }
    return $myReturn;
}
?> 