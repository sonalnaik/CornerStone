<?php 

ob_start();
session_start();
$host="fdb21.awardspace.net";      
$username="2729660_sonal"; 
$password="Password@sn01"; 
$db_name="2729660_sonal"; 
//$tbl_name="members"; 

$con=mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysqli_select_db($con, "$db_name") or die(mysqli_error($con));

include_once('header.php');
?>

<!-- Font Awesome Icons -->
  <link rel="stylesheet" href="./font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./adminlte.min.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">User Register</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">


                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if($_GET['msg'] == 'success_author'){?>
                                <p style="color:green">User added successfully!!</p>
                            <?php } 
                            $userDetail="SELECT * from user_profiles where id={$_SESSION['user_id']}";
                            $result=$con->query($userDetail);
                            $data=$result->fetch_assoc();
                            
                            ?>
                            
                            <form enctype= "multipart/form-data" role="form" action="register_action.php" method="post" id="editor-form">
                                <!-- text input -->
                                <input name ="id" type="hidden"  value="<?php echo $data['id'];?>">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input name ="firstname" type="text" class="form-control" value="<?php echo $data['firstname'];?>">
                                </div>
                                
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input name ="lastname" type="text" class="form-control" value="<?php echo $data['lastname'];?>">
                                </div>
                                
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name ="email" type="text" class="form-control" value="<?php echo $data['email'];?>">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input name ="phone" type="text" class="form-control" value="<?php echo $data['phone'];?>" >
                                </div>
                                <div class="form-group">
                                    <label>Job title</label>
                                    <select class="form-control" id="job_title" name="job_title">
                                                
                                                        <option value="">Please Select</option>
                                                        <option value="1" <?php if ($data['job_title'] == 1) echo ' selected="selected"' ?>>CXO</option>
                                                        <option value="2" <?php if ($data['job_title'] == 2) echo ' selected="selected"' ?>>VP</option>
                                                        <option value="3" <?php if ($data['job_title'] == 3) echo ' selected="selected"' ?>>PM</option>
                                                        <option value="4" <?php if ($data['job_title'] == 4) echo ' selected="selected"' ?>>Others</option>
                                                   
                                                
                                                </select>
                                </div>

                               


                                <div class="form-group">
                                    <label>Upload Display Picture</label>
                                    <input name ="picture" type="file" class="form-control" >
                                    <img src="/uploads/<?php echo $data['profile_pic'];?>">
                                </div>
                                <button id="submit" type="submit" class="btn btn-primary">Submit</button>

                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div> 
            </div>
            <!-- /.col-md-6 -->

            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->




<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->

</body>
</html>
<script src="./jquery.min.js"></script>
<script type="text/javascript" src="./jquery.validate.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./adminlte.min.js"></script>
<script>
    $(document).ready(function(){
      
    });
    
    
</script>
<script type="text/javascript">

(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#editor-form").validate({
                rules: {
                    firstname:{ 
                        required:true,
                        minlength:3,
                        maxlength:20
                    },
                    lastname:{ 
                        required:true,
                        minlength:3,
                        maxlength:100
                    },
                    email:{ 
                        required:true,
                        email:true
                    },
                    phone:{ 
                        required:true,
                        number:true,
                        minlength:10,
                        maxlength:11
                    },
                    job_title:{ 
                        required:true,
                        
                    },
                    
                    picture:{ 
                        required:true,
                        accept:"jpg,png,jpeg,gif"
                        
                    },
                    
                   
                },
                messages: {
                    firstname:{ 
                        required:"Please enter firstname",
                        minlength:"firstname must be at least 3 characters long",
                        maxlength:"firstname must be at most 20 characters long",
                    },
                    lastname:{ 
                        required:"Please enter lastname",
                        minlength:"lastname must be at least 3 characters long",
                        maxlength:"lastname must be at most 100 characters long",
                    },
                     email:{ 
                        required:"Please enter email",
                        email:"enter valid email"
                    },
                    phone:{ 
                        required:"Please enter phone no.",
                        number:"only numbers are allowed",
                         minlength:"phone no must be at least 10 characters long",
                        maxlength:"phone no must be at most 11 characters long",
                    },
                    job_title:{ 
                        required:"Please select job title",
                        
                    },
                   
                    picture:{ 
                        required:"Please upload picture",
                        accept: "Only image type jpg/png/jpeg/gif is allowed"
                        
                    },
                    
                   
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);
</script>
<style>
    .error{
        color:red;
        font-weight: normal !important;
    }
    </style>
    