<?php
require 'dashboard/sessionValidation.php';
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Add user</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="./style.css">
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
<link rel="stylesheet" href="./stylesG.css">
</head>
<body>
<!-- partial:index.partial.html -->

<a href="./dashboard/sessionValidation.php?logHout">
   <button class="beautiful-button">Cerrar cesion</button>
</a>
<div class="container">
  

      <div class="text">
         Registrar usuario
      </div>

      <form action="#">
         <div class="form-row">
            <div class="input-data">
               <input type="text" id="name" required>
               <div class="underline"></div>
               <label for="">Nombre</label>
            </div>
            <div class="input-data">
               <input type="text" id="apellido" required>
               <div class="underline"></div>
               <label for="">Apellidos</label>
            </div>
         </div>
         <div class="form-row">
            <div class="input-data">
               <input type="text" id="domicilio" required>
               <div class="underline"></div>
               <label for="">Domicilio</label>
            </div>
            <div class="input-data">
               <input type="email" id="correo" required>
               <div class="underline"></div>
               <label for="">Correo electronico</label>
            </div>
         </div>
         <div class="form-row">
         <div class="input-data textarea">
            
            <div class="form-row submit-btn">
               <div class="input-data">
                  <div class="inner"></div>
                  <input type="button" id="save" value="Guardar">
               </div>
               <a class="input-data" href="dashboard/index.php" >
                  <div class="inner"></div>
                  <input type="button" id="save" value="Ver usuarios">
               </a>
            </div>
               
      </form>
      </div>
   <script src="./validations.js"></script>   
  <script>
   
   $("#save").on('click', function() {
      var name = $('#name').val();
      var apellido = $('#apellido').val();
      var domicilio = $('#domicilio').val();
      var correo = $('#correo').val();
      if (validateName(name) && validateLastName(apellido) && 
      validateAddress(domicilio) && validateEmail(correo)) {
         $.ajax({
            url: 'CONTROLLERS/userController.php',
            method: 'POST',
            data: {
               method: 'addUser',
               name: name,
               apellido: apellido,
               domicilio: domicilio,
               correo: correo
            },
            success: function(response) {
               switch(response.code){
                  case 200:
                     if(response.data == "ok"){
                        $('#name').val("")
                        $('#apellido').val("")
                        $('#domicilio').val("")
                        $('#correo').val("")
                     }
                  break;
               }
            },
            error: function(xhr, status, error) {
               console.error(error);
            }
         });

      }else{
         console.log("Error");
      }

      



})
  </script>

<script src="./dashboard/js/jquery.min.js"></script>
<script src="./dashboard/js/popper.js"></script>
<script src="./dashboard/js/bootstrap.min.js"></script>
<script src="./dashboard/js/main.js"></script>
</body>
</html>
