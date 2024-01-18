<?php
    $fname = "";
    $lname = "";
    $contact = "";
    $email = "";
    $address = "";
    $class = "";
    $category = "";
    $gender = "";
    $blgroup = "";
    $city = "";
					
    $efname = "";
    $elname = "";
    $econtact = "";
    $eemail = "";
    $eaddress = "";
    $eclass = "";
    $ecategory = "";
    $egender = "";
    $eblgroup = "";
    $ecity = "";

    $sql = "select * from student where id = ".$_GET['eid'];
    $table = mysqli_query($cn, $sql);
    $row = mysqli_fetch_assoc($table);
					
	if(isset($_POST['submit']))
	{
	$fname = $_POST['fname'];
	$lname = $_POST['lname'] ;
	$contact = $_POST['contact'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$class = $_POST['class'];
	$category = $_POST['category'];
						
	if(isset($_POST['gender']))
	$gender = $_POST['gender'];
						
	$blgroup = $_POST['blgroup'];
	$city = $_POST['city'];
						
    $er = 0;
						
    if($fname == "")
    {
        $er++;
        $efname = "*Required";
    }

    if($lname == "")
    {
        $er++;
        $elname = "*Required";
    }

    if($contact == "")
    {
        $er++;
        $econtact = "*Required";
    }
    else
    {
        $contact = test_input($contact);
        if(!preg_match("/^[+0-9]*$/",$contact)){
            $er++;
            $econtact = "*Only numbers are allowed";
        }
							
    }

        if($email == "")
        {
            $er++;
            $eemail = "*Required";
        }
        else
        {
            $email = test_input($email);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $er++;
                $eemail = "*Email format is invalid";
            }
            
        }

        if($address == "")
        {
            $er++;
            $eaddress = "*Required";
        }

        if($class == "")
        {
            $er++;
            $eclass = "*Required";
        }

        if($category == 0)
        {
            $er++;
            $ecategory = "*Please select category";
        }

        if (empty($gender))
        {
            $er++;
            $egender = "*Gender is required";
        } 
        else 
        {
            $gender = test_input($gender);
        }

        if($blgroup == "")
        {
            $er++;
            $eblgroup = "*Required";
        }
        elseif(strlen($blgroup) > 3)
        {
            $er++;
            $eblgroup = "*Not more than 3 character";
        }
        
        else
        {
            $blgroup = test_input($blgroup);
            if(!preg_match("/^[a-zA-Z+-]*$/",$blgroup))
            {
                $er++;
                $eblgroup = "*Blood group not valid";
            }

        }

        if($city == 0)
        {
            $er++;
            $ecity = "*Please select City";
        }
        if($er == 0)
        {
            $sql = "update student set fname = '".strip_tags($fname)."', 
            lname = '".strip_tags($lname)."',
            contact = '".strip_tags($contact)."',
            email = '".strip_tags($email)."',
            address = '".strip_tags($address)."',
            class = '".strip_tags($class)."',
            category = ".strip_tags($category)." ,
            gender = '".strip_tags($gender)."',
            city = ".strip_tags($city)." where id = ".$_GET['eid'];
            
            if(mysqli_query($cn, $sql))
            {
                print '<span class = "successMessage">Students Details Update Successfully !!</span>';
                $row['fname'] = "";
                $row['lname'] = "";
                $row['contact'] = "";
                $row['email'] = "";
                $row['address'] = "";
                $row['class'] = "";
                $row['category'] = "";
                $row['gender'] = "";
                $row['blgroup'] = "";
                $row['city'] = "";
            }
            else
            {
                print '<span>'.mysqli_error($cn).'</span>';
            }
        }
    }
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<div class="form-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 id="et">Please Edit
                        <?php print $row["fname"]; ?>'s Information</h3>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="left-side-form">
                                        <h5><label for="fname">First Name</label>
                                            <span class="error">
                                                <?php print $efname; ?></span></h5>
                                        <p><input type="text" name="fname" value="<?php print $row['fname']; ?>"></p>

                                        <h5><label for="lname">Last Name</label><span class="error">
                                                <?php print $elname; ?></span></h5>
                                        <p><input type="text" name="lname" value="<?php print $row['lname']; ?>"></p>

                                        <h5><label for="contact">contact</label><span class="error">
                                                <?php print $econtact; ?></span></h5>
                                        <p><input type="text" name="contact" value="<?php print $row['contact']; ?>"></p>

                                        <h5><label for="email">email</label><span class="error">
                                                <?php print $eemail; ?></span></h5>
                                        <p><input type="text" name="email" value="<?php print $row['email']; ?>"></p>

                                        <h5><label for="address">address</label><span class="error">
                                                <?php print $eaddress; ?></span></h5>
                                        <p><textarea name="address"><?php print $row['address']; ?></textarea></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="right-side-form">
                                        <h5><label for="class">class</label><span class="error">
                                                <?php print $eclass; ?></span></h5>
                                        <p><input type="text" name="class" value="<?php print $row['class']; ?>"></p>

                                        <h5><label for="category">category</label></h5>
                                        <p><select name="category" id="">
                                                <option value="0">select</option>
												<option value="1">(1)OPEN</option>
												<option value="2">(2)OBC</option>
												<option value="3">(3)NT</option>
												<option value="4">(4)SC</option>
												<option value="5">(5)ST</option>
												<option value="6">(6)Other</option>
                                            </select><span class="error">
                                                <?php print $ecategory; ?></span></p>

                                        <h5><label for="gender">Gender</label></h5>
                                        <input type="radio" name="gender" value="male"><span>Male</span>
                                        <input type="radio" name="gender" value="female"><span>Female</span>
                                        <input type="radio" name="gender" value="others"><span>Others</span>
                                        <span class="error">
                                            <?php print $egender; ?></span>

                                        <h5><label for="blgroup">blood group</label><span class="error">
                                                <?php print $eblgroup; ?></span></h5>

                                        <p><input type="text" name="blgroup" value="<?php print $row['blgroup']; ?>"></p>

                                        <h5><label for="city">city</label></h5>
                                        <p><select name="city" id="">
                                                <option value="0">select</option>
												<option value="1">(1)Mumbai</option>
												<option value="2">(2)Pune</option>
												<option value="3">(3)Nashik</option>
												<option value="4">(4)Dhule</option>
												<option value="5">(5)Other</option>
                                            </select><span class="error">
                                            <?php print $ecity; ?></span></p>

                                        <p><input type="submit" name="submit" value="Save Change"></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
