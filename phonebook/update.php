<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $phoneNum = "";
$name_err = $phoneNum_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["submit"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    //Validate Phone Number
    $input_phoneNum = trim($_POST["phoneNumber"]);
    if(empty($input_phoneNum)){
        $phoneNum_err = "Please enter a phone number.";     
    }elseif (!filter_var($input_phoneNum, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/")))) {
        $phoneNum_err = "Please enter a valid phone number.";
    } 
    else{
        $phoneNum = $input_phoneNum;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($phoneNum_err)){
        // Prepare an update statement
        $sql = "UPDATE phonebook SET name=?, phone=?, WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
             // Set parameters
             $param_name = $name;
             $param_phoneNumber = $phoneNum;
             $param_id = $id;
             
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssi", $param_name, $param_phoneNumber, $param_id);
            
           
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // // Close statement
        // mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{ }

    // Check existence of id parameter before processing further
    // if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){}
        // Get URL parameter
        // $id =  trim($_GET["id"]);
        $id=$_GET['id'];
        
        // Prepare a select statement
        $sql = "SELECT * FROM phonebook WHERE pid = $id";
        $result = mysqli_query($link,$sql);
        $row = mysqli_fetch_assoc($result);
        $ename = $row['pname'];
        $ePhone = $row['pphoned'];
        // if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            // mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            // $param_id = $id;
            
            // Attempt to execute the prepared statement
            // if(mysqli_stmt_execute($stmt)){
            //     $result = mysqli_stmt_get_result($stmt);
    
            //     if(mysqli_num_rows($result) == 1){
            //         /* Fetch result row as an associative array. Since the result set
            //         contains only one row, we don't need to use while loop */
            //         $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    // $name = $row["name"];
                    // $phoneNum = $row["phoneNumber"];

                    if (isset ($_POST['update'])){
                        $name=$_POST['name'];
                        $phoneNum = $_POST['phoneNumber'];

                        $sql = "update phonebook set pname='$name',pphoned = '$phoneNum' where pid='$id'";
                        $result = mysqli_query($link,$sql);

                        if ( $result){
                            echo "success";
                            header("location: index.php");
                        } else{
                    // URL doesn't contain valid id. Redirect to error page
                        header("location: error.php");
                        }
                    }
                
            // } else{
            //     echo "Oops! Something went wrong. Please try again later.";
            // }
        // }
        
        // // Close statement
        // mysqli_stmt_close($stmt);
        
        // // Close connection
        // mysqli_close($link);
    // }  else{
    //     // URL doesn't contain id parameter. Redirect to error page
    //     header("location: error.php");
    //     exit();
    // }

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value=<?php echo $ename;?> class="form-control  <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phoneNumber" value=<?php echo $ePhone;?> class="form-control <?php echo (!empty($phoneNum_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phoneNum; ?>">
                            <span class="invalid-feedback"><?php echo $phoneNum_err;?></span>
                        </div>
                        <!-- <input type="text" name="id" value="<?php echo $id; ?>"/> -->
                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>