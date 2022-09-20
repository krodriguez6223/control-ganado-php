<?php 

 session_start();
 $DateAndTime = date('m-d-Y h:i:s a', time());

//datos de usuario
$rol= $_SESSION['userData']['nombrerol'];
$nombrerol = $_SESSION['userData']['nombres']; 

//datos de res
$codigo = $data[0]['codigo'];
$nombreRes = $data[0]['nombres'];
$raza = $data[0]['raza'];
$fechaNac = $data[0]['fecha_nacimiento'];
$peso = $data[0]['peso'];
$categoria = $data[0]['categoria'];
$origen = $data[0]['origen'];
$lote = $data[0]['lote'];
$totalLitros = $data[0]['TotalLitros'];

	
 ?>
<!DOCTYPE html>
<html lang="es">
<head> 
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Factura</title>
	<style>
		table{
			width: 100%;
		}
		table td, table th{
			font-size: 12px;
		}
		h4{
			margin-bottom: 0px;
		}
		.text-center{
			text-align: center;
		}
		.text-right{
			text-align: right;
		}
		.wd33{
			width: 33.33%;
		}
		.tbl-cliente{
			border: 1px solid #CCC;
			border-radius: 8px;
			padding: 10px;
		}
		.wid05{
			width: 5%;
		}
		.widt18{
			width: 18%;

		}
		.wd10{
			width: 10%;
		}
		.wd15{
			width: 15%;
		}
		.wd30{
			width: 33.4%;
		}
		.wd40{
			width: 40%;
		}
		.wd55{
			width: 55%;
		}
		.tbl-detalle{
			border-collapse: collapse;
			margin: auto;
		}
		.tbl-detalle thead th{

			padding: 8px;
			background-color: #009688;
			color: #FFF;

		}
		.tbl-detalle tbody td{
			border-bottom: 1px solid #CCC;
			padding: 5px;
		}
		.tbl-detalle tfoot td{
			padding: 5px;
		}
	</style>
</head>
<body>
	
	<table class="tbl-hader">
		<tbody>
			<tr>
				<td class="wd33">
				
				</td>
				<td class="text-center wd33">
					<h4>HISTORIAL DE  PRODUCCION DE LA RES<strong></strong></h4>
					
				</td>
				<td class="text-right wd33">
					<p><strong></strong><br>
						Fecha: <?php echo "$DateAndTime";  ?> <br>
						Rol: <?php echo $rol ?><br>
						Nombre Usuario: <?php echo $nombrerol ?>  
					</p>
				</td>
			</tr>
		</tbody>
	</table>
	<br>

	 
<h4>Datos de la res: </h4><br>
	<table class="tbl-cliente">
		<tbody>
		
			<tr>

				<td class="wid05">Código:</td>
				<td class="widt18"><?php echo $codigo ?></td>
				<td class="wid05">Raza:</td>
				<td class="widt18"><?php echo $raza ?></td>
				<td class="wid05">Total litros:</td>
				<td class="widt18"><?php echo $totalLitros ?></td>
				<td class="wid05">Nac.:</td>
				<td class="widt18"><?php echo $fechaNac ?></td>
			</tr>
			<tr>
				<td>Nombre:</td>
				<td><?php echo $nombreRes ?></td>
				<td>Peso:</td>
				<td><?php echo $peso ?></td>
				<td>Categoria:</td>
				<td><?php echo $categoria ?></td>
				<td>Origen:</td>
				<td><?php echo $origen ?></td>
			</tr>

		</tbody>
	</table>
	<br>

	<table class="tbl-detalle">
		<thead>
			<tr>
				<th class="wd05">#</th>
				<th class="wd05 ">Codigo</th>
				<th class="wd05 ">Nombre ordeñador</th>
				<th class="wd05 ">Cantidad litros</th>
				<th class="wd05 ">Horario</th>
				<th class="wd05 ">Fecha ordeño</th>
				<th class="wd05 ">Observacion</th>
				<th class="wd05">Fecha registro</th>


			</tr>
		</thead>
		<tbody>
		<?php foreach ($data as $key => $value):?>

			<tr>
			
				<td ><?php echo $value['idProduccion']?></td>
				<td ><?php echo $value['codigo']?> </td>
				<td ><?php echo $value['nomOrdeniador']?> </td>
				<td ><?php echo $value['cantLitro']?> </td>
				<td ><?php echo $value['horario']?> </td>
				<td ><?php echo $value['fechaOrdenio']?> </td>
				<td ><?php echo $value['fechaObserv']?> </td>
				<td ><?php echo $value['fechaRegistro']?> </td>
			</tr>
			<?php endforeach; ?>
			
		</tbody>
		
	</table>

	
</body>
</html>