<?php
include 'header.php';

?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
      <script src="JQuery.js" ></script>
      <script src="sweetalert.min.js" ></script>
	  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    
	</meta>
    <title>  Form Task  </title>
  </head>
  
<style>
@import url("fonts/droid/DroidArabicKuffi.css");
    body{
      margin:0;
      padding:0;
      background-color: #E7E7E7;
	
    }
 
    .mainCenter{
      width:85%;
      height:30%;
      border-radius:4px;
      margin-top:100px;
      background-color: white;
      direction: rtl;
      box-shadow: 1px 5px 10px grey;
	  margin-left: 170px;
	  float: auto;
	  margin-bottom:15px;
	  
	


    }
	
	/* Table CSS Design */
	table {
		font-family: 'Droid Arabic Kufi','arial';
		border-collapse: collapse;
		width:98%;
		border: none;
		border-radius: 4px;
		font-size:15px;
		margin-right:20px;
	}	

	table td{
		border: 1px solid #ddd;
		padding: 5px;
	}

	table th {
		border: 1px solid #ddd;
		padding: 8px;
		background-color:#43768F;
		color:white;
	}

	table tr:nth-child(even){background-color: #f2f2f2;}

	

    .title{
      background-color:#43768F;
      font-size: 18px;
      text-align: center;
    }
    p{
      margin:0;
      color: white;
      padding: 5px;
      font-family: 'Droid Arabic Kufi', 'arial';

    }

    form {
        padding: 10px;
		

    }

  input[type=text],input[type=file] {
	width: 300px;
	padding: 9px 10px;
	box-sizing: border-box;
	border: 1px solid #43768F;
	outline: none;
	border-radius: 4px;
	font-family: 'Droid Arabic Kufi' , 'arial';
	font-size: 15px;
	float: left;
	text-align:left;
}

input[type=text]:focus , input[type=file]:focus, input[type=time]:focus {
	border: 1px solid #8cb3d9;

}


input[type=submit] {
	width:100px;
	padding-top: 7px ;
	padding-bottom: 7px ;
	border: none;
	border-radius: 4px;
	font-family: 'Droid Arabic Kufi', 'arial';
	background-color: green;
	color: white;
	font-size:15px;
	margin-top: 5px;
	margin-left: 12px;
	float: left;
	margin-bottom: 10px;
	
}

input[type=submit]:hover{
	background-color: #2980b9;
	
}
</style>

  <body>
   

   <!--------------- main center section ---------------------->
	<div class="mainCenter">
		<div class="title">
			<p>  Users    </p>
		</div>
		  
		<div id="content" >
		<form  action="#" method="post" style="margin-top: -10px; padding-right:0px; padding-left:0px; "  enctype="multipart/form-data">
		<input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">
			<input id = "saveEmpBtn"  name="submitSaveEmp"  type="submit"   value="save" class=""  class="btn btn-primary"/>
		

		
			<table style="margin-top: 10px;">
				<!-- Name % Email -->
				<tr>
					
                   
                    <td> <p style="color:black;  text-align: left; ">   UserImage   </p></td>
					<td><p style="color:black;  text-align: left; ">  LastName   </p></td>
					<td> <p style="color:black;  text-align: left; ">   FirstName  </p></td>
				</tr>
				
			
				<tr>
					
				<!-- Username ID -->
				<td>
                    <input type ="file" name="imageInput" id="imageInput"  placeholder="Upload Image" required accept="image/*" multiple>
					<div id="thumbnail" width="40px" height="40px"></div>
                </td>
					
                    <td>

                    <input type ="text" name="user_lname" id="user_lname"   placeholder="Please Enter LastName" required >

                    </td>
					<td> 
						<input type ="text" name="user_fname" id="user_fname"  placeholder="Please Enter FirstName"  required >											
                     
					</td>
			
				</tr>
				
			
			
				
			</table>
            <br><br>
			
		</form>
<?php
	// Validate the CSRF token in the processing script

    // Process the form data

	if(isset($_POST["submitSaveEmp"])){
	$_SESSION['csrf_token']=bin2hex(random_bytes(32));
	//echo $_SESSION['csrf_token'];
	//Get Values
		$user_fname = $_POST["user_fname"];
		$user_lname = $_POST["user_lname"];
	//	$user_image = $_POST["imageInput"];
	
	
		$target_dir="upload/";
		$target_file=$target_dir.basename($_FILES["imageInput"]["name"]);
		$imagefiletype=pathinfo($target_file,PATHINFO_EXTENSION);
		  $imageInput =basename($_FILES["imageInput"]["name"]);
		 
	   
	   // Upload file
		 if(move_uploaded_file($_FILES['imageInput']['tmp_name'],"upload/".$imageInput)){
		}
	
			//ADD NEW EMP
			$InsertSQL = "INSERT INTO users (firstname, lastname, image_path) VALUES (?,?,?)";
				$stmt = $conn->prepare($InsertSQL);
				$stmt->bind_param('sss', $user_fname,$user_lname,$imageInput); 
				if($stmt->execute()){ 
					//Add Successful
				
					
					//Notify Success
					echo "<script>
							swal({
								title: 'تم إنشاء مستخدم بنجاح',
								icon: 'success',
								button: 'تم',
							})
							.then((value) => {
								location = 'form.php';
							});
						</script>";
				
				}
			
			
	}

	
?>
		</div>
	</div>
<script>
$(document).ready(function() {
  // Get the image input element
  var imageInput = $("#imageInput");

  // Validate the image before uploading
  imageInput.change(function() {
    var file = imageInput[0].files[0];
    var extension = file.name.split(".")[1];

    // Check if the file extension is allowed
    var allowedExtensions = ["jpg", "jpeg", "png"];
    if (!allowedExtensions.includes(extension)) {
      alert("Only .jpg, .jpeg, and .png files are allowed.");
      imageInput.val("");
      return;
    }

    // Check if the file size is within the limit
    var maxFileSize = 20000; // 2MB
    if (file.size > maxFileSize) {
      alert("The file size must be less than 2MB.");
      imageInput.val("");
      return;
    }

    // Display a thumbnail for the uploaded image
    displayThumbnail(file);
  });

 // Function to display thumbnail of the selected image
function displayThumbnail(file) {
  var reader = new FileReader();

  reader.onload = function(event) {
    var imgElement = document.createElement('img');
    imgElement.setAttribute('src', event.target.result);
    imgElement.setAttribute('class', 'thumbnail');

    // Append the image thumbnail to a container
    var thumbnailContainer = document.getElementById('thumbnail');
    thumbnailContainer.innerHTML = '';
    thumbnailContainer.appendChild(imgElement);
  };

  reader.readAsDataURL(file);
}

  // Save the image in the database
  $("#saveEmpBtn").click(function() {
    var file = imageInput[0].files[0];

    // Save the image in the database
    var database = {
      fileName: file.name,
      fileSize: file.size,
      extension: extension,
    };

    // Save the database
    saveDatabase(database);
  });
});


</script>
</body>
</html>






