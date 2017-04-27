<?php

include ("../../../BD.php");
?>




<span class="btns glyphicon glyphicon-plus" style="position: relative; float: right; margin-right: -2px" data-toggle="modal" data-target="#ModalInserir"></span>



<div class="modal fade" id="ModalInserir" tabindex="-1" role="dialog" aria-labelledby="ModalInserirLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="ModalInserirLabel">Inserir dados do cuidador</h4>
			</div>
			<div class="modal-body">
				<form id="f1" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
					<div class="form-group">
						<label for="recipient-nome" class="control-label">Nome:</label>
						<input name="nome" type="text" class="form-control" id="recipient-nome" required>
					</div>
					<div class="form-group" id="username">
						<label for="recipient-username" class="control-label">Username:</label>
						<input name="username" type="text" class="form-control" id="recipient-username" required>
						<label class="control-label" for="recipient-username" id="erro_username" style="display:none;"><i class="fa fa-times-circle-o"></i> Não disponível</label>
						<label class="control-label" for="recipient-username" id="sucesso_username" style="display:none;"><i class="fa fa-check"></i> Disponível</label>

					</div>
					<div class="form-group" id="email">
						<label for="recipient-email" class="control-label">Email:</label>
						<input name="email" type="email" class="form-control" id="recipient-email" required>
						<label class="control-label" for="recipient-email" id="erro_email" style="display:none;"><i class="fa fa-times-circle-o"></i> Não disponível</label>
						<label class="control-label" for="recipient-email" id="sucesso_email" style="display:none;"><i class="fa fa-check"></i> Disponível</label>
					</div>
					<div class="form-group" id="telemovel">
						<label for="recipient-telemovel" class="control-label">Telemóvel:</label>
						<input name="telemovel" type="number" class="form-control" id="recipient-telemovel" required>
						
					</div>
					<div class="form-group">
						<label for="recipient-password" class="control-label">Password:</label>
						<input name="password" type="password" class="form-control" id="recipient-password" required>
					</div>
					<div class="form-group" id="password">
						<label for="recipient-password2" class="control-label">Repetir password:</label>
						<input name="password2" type="password" class="form-control" id="recipient-password2" required>
						<label class="control-label" for="recipient-password2" id="erro_pass" style="display:none;"><i class="fa fa-times-circle-o"></i> A password não é igual</label>
						<label class="control-label" for="recipient-password2" id="sucesso_pass" style="display:none;"><i class="fa fa-check"></i> As passwords são iguais</label>
					</div>
					<input name="id" type="hidden" class="form-control" id="id_inserir">

					<button type="button" name="submeter_user" class="btn btn-success ajax"  id="sub">Registar</button>
					<button type="submit" name="a" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				</form>
			</div>
		</div>
	</div>
</div>




<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="Validações/validação_inserir_cuidador.js"></script>









