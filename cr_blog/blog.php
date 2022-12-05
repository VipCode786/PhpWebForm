<?php
ini_set('mysql.connect_timeout',300);
ini_set('default.socket_timeout',300);
// above two line means databse will connect after 300 millisecond 
?>
<html>
    <body>

<!-- When you make a POST request, you have to encode the data that forms the body of the request in some way. we encode it in "multipart/form-data" -->

        <form method="post" enctype="multipart/form-data">
<br/>
&nbsp;  &nbsp; <input type="file" name="image"/> 
<!-- taking image  -->
<br/><br/>

&nbsp;  &nbsp; <input type="submit" name="submit" value="upload"/>

    </form>
    
    <?php
    if(isset($_POST['submit']))
    //  return true only if 'Submit' is an existing parameter, i.e. if the user has sent such a value using n HTML form. 
    {
        if(getimagesize($_FILES['image']['tmp_name'])==FALSE)
        // getimagesize — Get the size of an image
        // $_FILES['file']['tmp_name'] - The temporary filename where the uploaded file was stored on the server.
        {
           echo"pls select img";
         }
        else{
            $image= addslashes($_FILES['image']['tmp_name']);
            $name= addslashes($_FILES['image']['name']);
    //   above name and image variable define
            $image= file_get_contents($image);
            // file_get_contents() reads a file into a string
            $image= base64_encode($image);
            // Base64 encoding is a way to encode binary data in ASCII text
            saveimage($name,$image);
        }
    }
    // call fn from below
    displayimage();
    function saveimage($name,$image)
    {
    //   name of host , user, database etc
        $databaseHost = 'localhost';
        $databaseName = 'ret_dis';
        $databaseUsername = 'root';
        $databasePassword = '';
        // connection with database
        $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
        //  connection and inserting in database table
        $result = mysqli_query($mysqli, "INSERT INTO images(name,image) VALUES('$name','$image')");
		
    // check  either img upload or not 
       if($result)
    {
        echo"<br/>image uploaded.";
    }
    else{
        echo"<br/> image not uploaded";
    }
    }
    // displaying the data in database
function displayimage()
{
    
    $databaseHost = 'localhost';
    $databaseName = 'ret_dis';
    $databaseUsername = 'root';
    $databasePassword = '';
    
    $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
     
    $result = mysqli_query($mysqli, "SELECT * FROM images");
     while($res = mysql_fetch_array($result))
     {
        $name = $res['name'];
        $image = $res['image'];
        
     }
     mysql_clode($mysqli);
}

    ?>
</body>
</html>