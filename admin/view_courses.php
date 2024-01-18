<div id="padding">
<div class="section-title">
    <h3>Students Enrolled for Courses</h3>
</div>

        <?php 

        if(isset($_GET['did']))
        {
        delete();
        print '<h6 class= "successMessage">Enrollment Details Deleted Successfully !!</h6>';
        }
               
                /* $cn = mysqli_connect("localhost", "root", "", "db_admission");*/
				$sql = "select * from enroll";
				
				$table = mysqli_query($cn, $sql);
				
				
				print '<table>';
				print '<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Branch</th><th>Class</th><th>Course</th><th>Action</th></tr>';
				
				while($row = mysqli_fetch_assoc($table))
				{
					print '<tr>';
					print '<td>'.htmlentities($row["id"]).'</td>';
					print '<td>'.htmlentities($row["fname"]).'</td>';
					print '<td>'.htmlentities($row["lname"]).'</td>';
					print '<td>'.htmlentities($row["branch"]).'</td>';
					print '<td>'.htmlentities($row["class"]).'</td>';
					print '<td>'.htmlentities($row["course"]).'</td>';
					print '<td> <a class= "action-e" href= "?a=edit1&eid='.$row["id"].'"><i class="fa fa-wrench" title="Update"></i></a>
					<a class= "action-d" href= "?a='.$_GET['a'].'&did='.$row['id'].'"><i class="fa fa-trash" title="Delete"></i></a></td>';
					print '</tr>';
				}
	
				print '</table>';

    function delete()
        {
            global $cn;
            $sql = "delete from enroll where id = ".$_GET['did'];
            mysqli_query($cn, $sql);
        }
	
    ?>
     
</div>