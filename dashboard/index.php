<?php
require 'sessionValidation.php';
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Users</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="//cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css">
	<script src="//cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>
	<link rel="stylesheet" href="../stylesG.css">
	</head>
	<body>
		<a href="./sessionValidation.php?logHout">
			<button class="beautiful-button">Cerrar cesion</button>
		</a>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Usuarios registrados</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<a href="../addUser.php">
						<button type="button" class="btn btn-primary btn-lg btn-block">Agregar nuevo usuario</button>
					</a>

				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table table-striped" id="tableId">
						  <thead>
						    <tr>
						      <th>Id</th>
						      <th>Nombre</th>
						      <th>Apellido</th>
						      <th>Domicilio</th>
						      <th>Correo</th>
						      <th>Operaciones</th>
						    </tr>
						  </thead>
						  <tbody id="tbodyId">

						    <!-- <tr>
						      <th scope="row">1001</th>
						      <td>Mark Otto</td>
						      <td>Japan</td>
						      <td>$3000</td>
						      <td>$1200</td>
						      <td><a href="#" class="btn btn-success">Editar</a>
						      <a href="#" class="btn btn-danger">Eliminar</a></td>
						    </tr> -->

						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
		  <form>
			<input type="hidden" name="" id="idUser">
			<div class="form-group">
			  <label for="recipient-name" class="col-form-label">Nombre:</label>
			  <input type="text" class="form-control" id="recipient-name" required>
			</div>
			<div class="form-group">
				<label for="recipient-name" class="col-form-label">Apellido:</label>
				<input type="text" class="form-control" id="recipient-apellido" required>
			  </div>
			  <div class="form-group">
				<label for="recipient-name" class="col-form-label">Domicilio:</label>
				<input type="text" class="form-control" id="recipient-domicilio" required>
			  </div>
			  <div class="form-group">
				<label for="recipient-name" class="col-form-label">Correo:</label>
				<input type="email" class="form-control" id="recipient-correo" required>
			  </div>

		  </form>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelSave">Cancelar</button>
		  <button type="button" class="btn btn-primary" id="saveChanges">Guardar cambios</button>
		</div>
	  </div>
	</div>
  </div>

	<script src="./js/jquery.min.js"></script>
  <script src="./js/popper.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <script src="./js/main.js"></script>


  <script>
			$(document).ready(function() {

				let table;
				
				$.ajax({
			url: '../CONTROLLERS/userController.php',
			method: 'POST',
			data: {
				method: 'getUsers',
			},
			success: function(response) {
				switch (response.code) {
                    case 200:
						
						var data = response.data;

					$.each(data, function (index, item){

					var tableRow = $('<tr id="'+item.id+'">' +
                        '<th scope="row">'+item.id+'</th>' +
                        '<td>'+item.name+'</td>' +
                        '<td>'+item.apellido+'</td>' +
                        '<td>'+item.domicilio+'</td>' +
                        '<td>'+item.correo+'</td>' +
                        '<td>' +
								'<input type="button" '+ 
								'class="btn btn-success editar editRow" value="Editar" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"> ' +
								'<input type="button" id="D'+item.id+'" class="btn btn-danger" value="Eliminar">' +
							'</td>' +
						'</tr>');
						$('#tbodyId').append(tableRow);
							// $("#E"+item.id).on('click', function(event) {
							// 	$("#recipient-name").val(item.name)
							// 	$("#recipient-apellido").val(item.apellido)
							// 	$("#recipient-domicilio").val(item.domicilio)
							// 	$("#recipient-correo").val(item.correo)
							// 	$("#idUser").val(item.id)
							// })

							$("#D"+item.id).on('click', function(event) {
								$.ajax({
									url: '../CONTROLLERS/userController.php',
									method: 'POST',
									data: {
										method: 'desactive',
										id: item.id,
									},
									success: function(response){
										switch (response.code) {
											case 200:
											var row = $("#"+item.id); 
											table.row(row).remove().draw(false); 
												break;
											default:
												break;
										}
										console.log("Response: ",response.code);
									},
									error: function(xhr, status, error){
										console.error(xhr.responseText);
									}
								});
							});
						});
						table = new DataTable('#tableId');

						$(".editRow").on('click', function(event) {
							var row = $(this).closest('tr');
							var th = row.find('th');
							var tds = row.find('td');
							console.log(tds.eq(0).text());

							$("#recipient-name").val(tds.eq(0).text());
							$("#recipient-apellido").val(tds.eq(1).text());
							$("#recipient-domicilio").val(tds.eq(2).text());
							$("#recipient-correo").val(tds.eq(3).text());
							$("#idUser").val(th.text());
						})

                    break;
                            
                    default:
                    	break;
                    }
                    console.log("Response: ",response.code);
			},
			error: function(xhr, status, error) {
				console.error(error);
			}
		});

		
		


		$("#saveChanges").on('click', function(event) {
							console.log("pressed");
							$.ajax({
									url: '../CONTROLLERS/userController.php',
									method: 'POST',
									data: {
										method: 'updateUser',
										id: $('#idUser').val(),
										name: $('#recipient-name').val(),
										apellido: $('#recipient-apellido').val(),
										domicilio: $('#recipient-domicilio').val(),
										correo: $('#recipient-correo').val()
									},

									success: function(response){
										switch (response.code) {
											case 200:

												if (response.sms == "ok") {
													var row = $("#"+$('#idUser').val()); 
													table.cell(row, 1).data($('#recipient-name').val()); // Assuming apellido is in the third column (index 2)
													table.cell(row, 2).data($('#recipient-apellido').val()); // Assuming domicilio is in the fourth column (index 3)
													table.cell(row, 3).data($('#recipient-domicilio').val()); // Assuming correo is in the fifth column (index 4)
													table.cell(row, 4).data($('#recipient-correo').val()); // Assuming correo is in the fifth column (index 4)
	
													table.draw();
													$("#cancelSave").click(); 

												}

											break;
											default:
												break;
										}
										console.log("Response: ",response);
									},
									error: function(xhr, status, error){
										console.error(xhr.responseText);
									}
								});
						})

	})
  </script>
	</body>
</html>

