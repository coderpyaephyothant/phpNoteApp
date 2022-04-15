<?php
require 'config.php';
if(!empty($_POST)){
  $note_header = $_POST['note_header'];
  $note_body = $_POST['note_body'];
  $id = $_POST['id'];

if($_FILES['file']['name'] != null){
  $targetFile = 'images/'.($_FILES['file']['name']);
  $file = $_FILES['file']['name'];
  $imageType = pathinfo($targetFile,PATHINFO_EXTENSION);
  if ($imageType != 'png' && $imageType != 'jpg' && $imageType != 'jpeg'){
    echo" <script>alert('File image must be PNG/JPG or JPEG'...);</script>";
  }else{
    move_uploaded_file($_FILES['file']['tmp_name'],$targetFile);
    $pdo_statement = $pdo->prepare(" UPDATE note SET note_header='$note_header', note_body='$note_body', file='$file' WHERE id='$id'");
    $result = $pdo_statement -> execute(
      array(
        ':note_header' => $note_header,
        ':note_body' => $note_body,
        ':file' => $file,
      )
    );
    if ($result){
      echo "<script>alert('Successfully Updated with Image!');window.location.href='index.php';</script>";
    };
  };
}else{
  $pdo_statement = $pdo->prepare(" UPDATE note SET note_header='$note_header', note_body='$note_body' WHERE id='$id' ");
  $result = $pdo_statement -> execute(
    array(
      ':note_header' => $note_header,
      ':note_body' => $note_body)
  ); 
  if ($result){
    echo "<script>alert('Successfully Updated without Image!');window.location.href='index.php';</script>";
  };
}
} else {
  $pdo_statement = $pdo->prepare("SELECT * FROM note WHERE id=".$_GET['id']);
  $pdo_statement->execute();
  $result = $pdo_statement->fetchAll();
  // print"<pre>";
  // print_r($result); exit();
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>create Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body> <br>
    <div class="card">
      <div class="card-body">
        <h2>Update Notes</h2>

        <form class="" action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $result [0] ['id'] ?>">
          <div class="form-group">
            <label for="">Note Header</label>
            <input class="form-control" type="text" name="note_header" value="<?php echo $result [0] ['note_header'] ?>">
          </div>
          <div class="form-group">
            <label for="">Note Body</label>
            <input class="form-control" type="text" name="note_body" value="<?php echo $result [0] ['note_body'] ?>">
          </div>
          <div class="form-group">
            <label for="">File</label> <br>
            <img width="200px" src="images/<?php echo $result [0] ['file']  ?>" alt=""> <br> <br>
            <input  type="file" name="file" value="?>">
          </div> <br>
          <div class="form-group">
            <input class="btn btn-primary" type="submit" name="submit" value="Update">

            <a href="index.php" class="btn btn-success">Back</a>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
