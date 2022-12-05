<html>
    <body> 
         <center>
            <form action="" method="POST" enctype="multipart/form-data">
                <!-- when we have to upload img in db we use multipart/form-data -->
 <!-- When you make a POST request, you have to encode the data that forms the body of the request in some way. we encode it in "multipart/form-data" -->            
                <table>
                    <thead>
                        <tr>
                            <!-- heading of the table -->
                            <th>name</th>
                            <th>image</th>
                           
                        </tr>
                    </thead>
                    <?php
                    $connection = mysqli_connect("localhost","root","");
// mysqli_connect() function attempts to open a connection to the MySQL Server running on host 
                    $db = mysqli_select_db($connection,'ret_dis');
//    Selects the default database to be used when performing queries against the database connection
                    $query =" SELECT * FROM `images`";
                    $query_run = mysqli_query($connection,$query);
 // query() / mysqli_query() function performs a query against a database.
                    while($row = mysqli_fetch_array($query_run))
// mysqli_fetch_array() function fetches a result  .
                    {
                      ?>
                      <tr>
                      <td><?php echo $row['name']; ?> </td> 
<!--  echo() function outputs one or more strings -->
                        <td> <?php echo '<img src="data:image;base64,'.base64_encode($row['image']).' " alt="image" style="width:200px; height: 200px;">'; ?></td>  
                         
                    </tr>
                    <?php
                }
                    ?>
                </table>
            </form>
        </center>
</body>
</html>
