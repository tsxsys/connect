<?php
$user_role = 'Standard User';
$title = 'Edit Profile';
require '../login/misc/pagehead.php';
$uid = $_SESSION['uid'];
$usr = Connect\ProfileData::pullAllUserInfo($uid);
//Outputs empty user image if no image exists
//if (@get_headers($usr['UserImage'])[0] == 'HTTP/1.1 404 Not Found' || $usr['UserImage'] == '') {
//    $img_path = "no_user.jpg";
//} else {
//    $img_path = $usr['UserImage'];
//}
?>

<script src="js/profileupdate.js"></script>
<script src="js/croppie.min.js"></script>
<link href="css/croppie.min.css" rel="stylesheet" media="screen">

</head>
<body>
  <?php require '../login/misc/pullnav.php'; ?>
    <div class="container">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <h2><?php echo $title;?></h2>
            <form id="profileForm" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="label label-default">Select Your Image</label>
                            <br/>
                            <input type="file" name="user_image" id="user_image" accept="image/*" class="custom-file-input" />
                            <div id="imgholder"> <img id="imgthumb" class="img-thumbnail" src="<?php echo $img_path."?i=".rand(5, 30000);?>" /> </div>
                            <input id="base64image" hidden></input>
                            <br/> </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="label label-default">First Name</label>
                            <input type="text" class="form-control editprofile" name="firstname" id="firstname" value="<?php echo $usr['FirstName']; ?>">
                            <label for="lastname" class="label label-default">Last Name</label>
                            <input type="text" class="form-control editprofile" name="lastname" id="lastname" value="<?php echo $usr['LastName']; ?>">
                            <label for="address_line_1" class="label label-default">Address 1</label>
                            <input type="text" class="form-control editprofile" name="address_line_1" id="address_line_1" value="<?php echo $usr['address_line_1']; ?>">
                            <label for="address_line_2" class="label label-default">Address 2</label>
                            <input type="text" class="form-control editprofile" name="address_line_2" id="address_line_2" value="<?php echo $usr['address_line_2']; ?>">
                            <label for="address_line_3" class="label label-default">City</label>
                            <input type="text" class="form-control editprofile" name="address_line_3" id="address_line_3" value="<?php echo $usr['address_line_3']; ?>">
                            <label for="address_line_4" class="label label-default">State</label>
                            <input type="text" class="form-control editprofile" name="address_line_4" id="address_line_4" value="<?php echo $usr['address_line_4']; ?>"> </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <label for="phone" class="label label-default">Phone</label>
                            <input type="text" class="form-control editprofile" name="phone" id="phone" value="<?php echo $usr['Phone']; ?>"> </div>
                        <div class="col-sm-6">
                            <label for="Country" class="label label-default">Country</label>
                            <input type="text" class="form-control editprofile" name="country" id="country" value="<?php echo $usr['address_line_6']; ?>"> </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="bio" class="label label-default">Bio</label>
                            <textarea rows="6" name="bio" class="form-control" id="bio"><?php echo $usr['Bio']; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="message"></div>
                            <button type="submit" class="btn btn-primary" id="submitbtn">Save Changes</button>  </div>
                    </div>
            </form>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
</body>

</html>
