<?php
  require 'config.php';
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Note Application</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <link rel="stylesheet" href="style.css">
   </head>
   <body>
     <?php
     $pdo_statement = $pdo -> prepare(" SELECT * FROM note ORDER BY id DESC");
     $pdo_statement-> execute();
     $result =$pdo_statement->fetchAll();
     // print"<pre>";
     // print_r($result);exit();
      ?>
     <br>
     <h2>Note Application Home Page</h2> <br>
     <div class="">
       <a href="create.php" class="btn btn-primary">Create Note</a>
     </div>
      <br>
     <table class="table table-bordered">
       <thead>
         <tr>
           <th>Note-ID</th>
           <th>Note Title</th>
           <th>Note Body</th>
           <th>Image</th>
           <th>Date</th>
           <th>Action</th>
         </tr>
       </thead>
       <?php
       $i = 1;
       if (!empty($result)){
         foreach ($result as $value) {
           ?>
           <tbody>
             <td><?php echo $i?></td>
             <td><?php echo $value['note_header']; ?></td>
             <td><?php echo $value['note_body']; ?></td>
             <td>
               <img width="150px" src="images/<?php echo $value['file']; ?>" alt="">
             </td>
             <td><?php echo date('d-m-Y',strtotime($value['time'])) ; ?></td>
             <td>
               <a style="margin:5px" href="edit.php?id=<?php echo $value['id']; ?>" class="btn btn-primary">Edit Note</a>  &nbsp; &nbsp; &nbsp;
               <a style="margin:5px" href="delete.php?id=<?php echo $value['id']; ?>" class="btn btn-danger">Delete Note</a>
             </td>
           </tbody>
           <?php
           $i ++;
         }
       }
        ?>
     </table>
   </body>
 </html>
