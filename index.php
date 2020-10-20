<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

<script>
  
</script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous">
</script> -->
    <title>Notes hai vai yeh</title>
  </head>
  <body>
    <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"></button> -->
<!--Edit  Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLable" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLable">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/notes/index.php" method="POST">
      <input type="hidden" name="idEdit" id="idEdit">
        <div class="form-group">
          <label for="title">Title edit</label>
          <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
          <small id="emailHelp" class="form-text text-muted">Add the title to your notes</small>
        </div>
        <!-- <div class="form-group">
          <label for="exampleInputPassword1">Content</label>
          <input type="password" class="form-control" id="exampleInputPassword1">
        </div> -->
        <div class="form-group">
            <label for="content">Content edit</label>
            <textarea class="form-control" name="contentEdit" id="contentEdit" rows="3"></textarea>
          </div>
          

        <button type="submit" class="btn btn-primary">Update Notes</button>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
 
<div class="container">
    <?php
  //lets capture the notes title and description.
    

    // echo "title is = ".($title)."<br>"."content is = ".($content);
    //So now lets connect to our database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "note";
    $connection = mysqli_connect($servername,$username,$password,$database);
    // if ($connection)
    // {
    //     echo '<div class="alert alert-success" role="alert">
    //     connection to database successful.
    //   </div>';
    // }
    // else {
    //     echo '<div class="alert alert-danger" role="alert">
    //     connection to database failed!
    //   </div>';
    // }


    ?>
  </div>
      <!--
          Navbar here --------------------------------------
      -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><img src="/notes/note.png" height=28px alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/notes">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="http://naitik.herokuapp.com/about">About <span class="sr-only">(current)</span></a>
            </li>
            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a> -->
              <!-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li> -->
            <li class="nav-item active ">
              <a class="nav-link" href="https://naitik.vercel.app/">Contact us <span class="sr-only">(current)</span></a>
            </li>
          </ul>
          <!-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form> -->
        </div>
        </nav></div>
        <div class="container">
        <?php
{ 
  if(isset($_GET['delete'])){
    $idss = $_GET['delete'];
    // echo $idss;
    $deletes = "DELETE FROM `notes` WHERE `notes`.`id` = '$idss'";
    $run_del = mysqli_query($connection,$deletes);
  }
if ($_SERVER["REQUEST_METHOD"] == "POST" )

  if(isset($_POST['idEdit'])){
    // echo "yes"; lets update the record
    $id = $_POST['idEdit'];
    $titles = $_POST['titleEdit'] ;
    $contents = $_POST['contentEdit'];
    // exit();
    //update query to be executed:
    $edits = "UPDATE `notes` SET `title` =  '$titles' , `content` = '$contents' WHERE `notes`.`id` = '$id' ";
    $update = mysqli_query($connection,$edits);
  }
else{
  $title = $_POST['title'];
  $content = $_POST['content'];
    //now lets add the form captured data into our database
    $inserts = "INSERT INTO `notes` (`title`, `content`) VALUES ( '$title', '$content')";
    $querys = mysqli_query($connection,$inserts);
    $files = fopen("new.txt",'a');
    fwrite($files,$title."\n".$content);
    fclose($files);
  //   if ($querys)
  //   {
  //     echo '<div class="alert alert-success" role="alert">
  //     adding data  to database successful.
  //   </div>';
  //   }
  //   else {
  //     echo '<div class="alert alert-danger" role="alert">
  //     adding data to the database failed!
  //   </div>';
  
  // }
  }
}

?>
        </div>
     

      <!--
          form here...........................
      -->
  <div class="container my-4">
      <h2>Add a Note</h2>
    <form action="/notes/index.php" method="POST">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="title" aria-describedby="emailHelp">
          <small id="emailHelp" class="form-text text-muted">Add the title to your notes</small>
        </div>
        <!-- <div class="form-group">
          <label for="exampleInputPassword1">Content</label>
          <input type="password" class="form-control" id="exampleInputPassword1">
        </div> -->
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
          

        <button type="submit" class="btn btn-primary">Add note</button>
      </form>
  </div>
  <div class="container">
  <table class="table" id="myTable">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Title</th>
      <th scope="col">Content</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
   
      <?php 
      $id = 0;
      $fetchs = "SELECT * FROM `notes`";
      $for_fetch = mysqli_query($connection,$fetchs);
        while($show = mysqli_fetch_assoc($for_fetch)){
          $id ++;
          echo  "<tr> 
          <th scope='row'>".$id."</th>
          <td>".$show['title']."</td>
          <td>".$show['content']."</td>
         
          <td> <button class='edit btn btn-primary' id=".$show['id'].">Edit</button>  <button class='delete btn btn-primary' id=d".$show['id'].">Delete</button> </td>
        </tr>";
        }
       
    
?>
  </tbody>
</table>


  </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
  $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script>

      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element)=>{element.addEventListener("click",(e)=>{
        console.log("edit", );
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        content = tr.getElementsByTagName("td")[1].innerText;
        console.log(title,content)
        contentEdit.value = content;
        titleEdit.value = title;
        idEdit.value = e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element)=>{element.addEventListener("click",(e)=>{
        console.log("edit", );
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        content = tr.getElementsByTagName("td")[1].innerText;
        ids = e.target.id.substr(1,)
     if(confirm("Do you want to delete!")){
       console.log("yes");
       window.location = `/notes/index.php?delete=${ids}`;
     }
      })
    })
      
    </script>
  </body>
  
</html>
