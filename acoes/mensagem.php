<?php

if (isset($_SESSION['mensagem'])) {
	switch ($_SESSION['mensagem']){
		case "Atualizado com sucesso":
			?>
			<script>
			//mensagem
				window.onload = function(){
					swal ( " Atulizado com sucesso! ","")  ;
				}
			</script>
		<?php
		break;
		case "erro ao atualizar":
			?>
			<script>
			//mensagem
				window.onload = function(){
					swal ( " erro ao atualizar! ","")  ;
				}
			</script>
		<?php		
		break;
	} 
}
$_SESSION['mensagem'] = null;
?>

