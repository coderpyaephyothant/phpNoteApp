<?php
require 'config.php';
if(!empty($_POST)){
  $note_header = $_POST['note_header'];
  $note_body = $_POST['note_body'];

if($_FILES['file']['name'] != null){
  $targetFile = 'images/'.($_FILES['file']['name']);
  $file = $_FILES['file']['name'];
  $imageType = pathinfo($targetFile,PATHINFO_EXTENSION);
  if ($imageType != 'png' && $imageType != 'jpg' && $imageType != 'jpeg'){
    echo" <script>alert('File image must be PNG/JPG or JPEG'...);</script>";
  }else{
    move_uploaded_file($_FILES['file']['tmp_name'],$targetFile);
    $pdo_statement = $pdo->prepare(" INSERT INTO  note (note_header,note_body,file) VALUES (:note_header,:note_body,:file)");
    $result = $pdo_statement -> execute(
      array(
        ':note_header' => $note_header,
        ':note_body' => $note_body,
        ':file' => $file,
      )
    );
    if ($result){
      echo "<script>alert('Successfully Uploaded with Image!');window.location.href='index.php';</script>";
    };
  };
}else{
  $pdo_statement = $pdo->prepare(" INSERT INTO  note(note_header,note_body) VALUES(:note_header,:note_body)");
  $result = $pdo_statement->execute(
    array(
      ':note_header'=>$note_header,
      ':note_body'=>$note_body,
    )
  );
  if ($result){
    echo "<script>alert('Successfully Uploaded without File Image!');window.location.href='index.php';</script>";
  }
}
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
        <h2>Create Notes</h2>
        <form class="" action="create.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="">Note Header</label>
            <input class="form-control" type="text" name="note_header" value="">
          </div>
          <div class="form-group">
            <label for="">Note Body</label>
            <input class="form-control" type="text" name="note_body" value="">
          </div>
          <div class="form-group">
            <label for="">File</label> <br>
            <input  type="file" name="file" value="">
          </div> <br>
          <div class="form-group">
            <input class="btn btn-primary" type="submit" name="submit" value="Submit">
            <a href="index.php" class="btn btn-success">Back</a>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
