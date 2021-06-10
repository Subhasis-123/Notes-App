



<?php
//INSERT INTO `note` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'go to buy fruit', 'as isugdikbkjbdkb.kj', current_timestamp());


$update=false;
$delete=false;
$insert=false;
// Connect to the Database 
$servername="localhost";
$username="root";
$password="";
$database="notes";

// Create a connection
$conn=mysqli_connect($servername,$username,$password,$database);

// Die if connection was not successful
if(!$conn)
{
    die("sorry for connection".mysqli_connect_error());

}

//echo $_GET['update'];
//echo $_POST['snoEdit'];
//exit();
if(isset($_GET['delete']))
{
  $sno = $_GET['delete'];
  $delete=true;
  $sql = "DELETE FROM `note` WHERE `sno`=$sno";
  $result=mysqli_query($conn,$sql);

  

}
if($_SERVER['REQUEST_METHOD']=='POST')
{
  if (isset($_POST['snoEdit']))

  //update the record
  {
  
  $sno=$_POST["snoEdit"];
  $title=$_POST["titleEdit"];
  $description=$_POST["descriptionEdit"];

  // Sql query to be executed

  $sql="UPDATE `note` SET `title`='$title',`description`='$description' WHERE `sno`=$sno ";
  $result=mysqli_query($conn,$sql);

  if($result)
  {
    $update=true;
  }
  else
  {
    echo "not updated";
  }
  
  }
  else
  {

  
  
  $title=$_POST["title"];
  $description=$_POST["description"];

  // Sql query to be executed
  $sql="INSERT INTO `note` ( `title`, `description`)VALUES('$title','$description')";
  $result=mysqli_query($conn,$sql);

  if($result)
  {
    $insert=true;
  }
  else
  {
    echo "error".mysqli_error($conn);
  }

}
}

?>




<!doctype html>
<html lang="en">
  <head>
 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">
    </script>
    
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    



    
  
  <title>Notes App</title>
  </head>
  <body>
  


<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModallabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModallabel">Edit Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
     
        <form action="/crud/index.php" method="post">
        <input type="hidden" name="snoEdit" id="snoEdit"> 
            <div class="mb-3">
              <label for="title" class="form-label">Notes Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
              
            </div>
            
              <div class="mb-3">
                <label for="description" class="form-label">Notes Description</label>
                <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
              </div>
            
            
            
            <button type="submit" class="btn btn-primary">Update Note</button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Note</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contect Us</a>
              </li>
             
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

      <?php
        if($insert)
        {
          echo"<div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>sucsesfully!</strong> Your notes inserted done.
          <button type='button' class='btn-close' data-bs-dismiss='alert'aria-label='Close'></button>
        </div>";
        }
?>
<?php
        if($delete)
        {
          echo"<div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>sucsesfully!</strong> Your notes deleted done.
          <button type='button' class='btn-close' data-bs-dismiss='alert'aria-label='Close'></button>
        </div>";
        }


?>
<?php
        if($update)
        {
          echo"<div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>sucsesfully!</strong> Your notes updated done.
          <button type='button' class='btn-close' data-bs-dismiss='alert'aria-label='Close'></button>
        </div>";
        }


?>










      <div class="container my-4">
          <h2>Add a Note</h2>
        <form action="/crud/index.php" method="post">
            <div class="mb-3">
              <label for="title" class="form-label">Notes Title</label>
              <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
              
            </div>
            
              <div class="mb-3">
                <label for="description" class="form-label">Notes Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
              </div>
            
            
            
            <button type="submit" class="btn btn-primary">Add Note</button>
          </form>
      </div>
      <hr>
      <div class="container my-4">
        

<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php

            
$sql="SELECT * FROM `note` ";
$result=mysqli_query($conn,$sql);
$sno=0;
$num= mysqli_num_rows($result);
echo $num;
echo "<br>";
if($num>0)
{
    while($row= mysqli_fetch_assoc($result))
    {
        $sno=$sno+1;
        echo"<tr>
        <th scope='row'>". $sno ."</th>
        <td>". $row['title'] ."</td>
        <td>". $row['description'] ."</td>
        <td><button class='edit  btn  btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-primary' 
        id=d". $row['sno'].">Delete</button></td>
        
      </tr>";
      
    }   
}

?>
    
    
  </tbody>
</table>
       
      </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <script>
      $(document).ready( function () {
    $('#myTable').DataTable();
    } );

    </script>
  
    <script>
    edits=document.getElementsByClassName('edit');
    Array.from(edits).forEach((element)=>{
    element.addEventListener("click", (e)=>{
      console.log("edit",);
      tr=e.target.parentNode.parentNode;
      title=tr.getElementsByTagName("td")[0].innerText;
      description=tr.getElementsByTagName("td")[1].innerText;
      console.log(title,description);
      titleEdit.value=title;
      descriptionEdit.value=description;
      snoEdit.value=e.target.id;
      console.log(e.target.id);
     $('#editModal').modal('toggle');
   
    })
    })


    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
    element.addEventListener("click", (e) => {
      console.log("edit ");
      tr=e.target.parentNode.parentNode;
      sno=e.target.id.substr(1,);
      
     if( confirm("confirm"))
     {
       console.log("yes");
       window.location = `/crud/index.php?delete=${sno}`;
     }
     else
     {
       console.log("no");
     }
     
   
    })
    })
  </script>



  </body>
</html>