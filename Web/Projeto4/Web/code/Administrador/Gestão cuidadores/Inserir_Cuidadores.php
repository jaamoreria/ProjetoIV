<?php

include ("../../../BD.php");
?>

<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>


<span class="btns glyphicon glyphicon-plus" style="position: relative; float: right; margin-right: -2px" data-toggle="modal" data-target="#ModalInserir"></span>



<div class="modal fade" id="ModalInserir" tabindex="-1" role="dialog" aria-labelledby="ModalInserirLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="ModalInserirLabel">Inserir dados do cuidador</h4>
			</div>
			<div class="modal-body">
				<form name ="f1" id="f1" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
					<div class="form-group" id="nome">

						<label for="recipient-nome" class="control-label">Nome:</label>
						<input name="nome" type="text" class="form-control" id="recipient-nome" required>

						<label class="control-label" for="recipient-nome" id="vazio-nome" style="display:none;"><i class="fa fa-times-circle-o"></i> Campo vazio</label>
					</div>

					<div class="form-group" id="username">
						<label for="recipient-username" class="control-label">Username:</label>
						<input name="username" type="text" class="form-control" id="recipient-username" required>

						<label class="control-label" for="recipient-username" id="erro_username" style="display:none;"><i class="fa fa-times-circle-o"></i> Não disponível</label>
						<label class="control-label" for="recipient-username" id="sucesso_username" style="display:none;"><i class="fa fa-check"></i> Disponível</label>
						<label class="control-label" for="recipient-username" id="vazio-username" style="display:none;"><i class="fa fa-times-circle-o"></i> Campo vazio</label>

					</div>
					<div class="form-group" id="email">
						<label for="recipient-email" class="control-label">Email:</label>
						<input name="email" type="email" class="form-control" id="recipient-email" required>

						<label class="control-label" for="recipient-email" id="erro_email" style="display:none;"><i class="fa fa-times-circle-o"></i> Não disponível</label>
						<label class="control-label" for="recipient-email" id="sucesso_email" style="display:none;"><i class="fa fa-check"></i> Disponível</label>
						<label class="control-label" for="recipient-email" id="vazio-email" style="display:none;"><i class="fa fa-times-circle-o"></i> Campo vazio</label>
						<label class="control-label" for="recipient-email" id="incompleto-email" style="display:none;"><i class="fa fa-times-circle-o"></i> Formato errado</label>

					</div>
					<div class="form-group" id="telemovel">
						<label for="recipient-telemovel" class="control-label">Telemóvel:</label>
						<input name="telemovel" type="number" class="form-control" id="recipient-telemovel" required>

						<label class="control-label" for="recipient-telemovel" id="vazio-telemovel" style="display:none;"><i class="fa fa-times-circle-o"></i> Campo vazio</label>
						
					</div>
					<div class="form-group" id="password">
						<label for="recipient-password" class="control-label">Password:</label>
						<input name="password" type="password" class="form-control" id="recipient-password" required>
						<label class="control-label" for="recipient-password" id="vazio-pass1" style="display:none;"><i class="fa fa-times-circle-o"></i> Campo vazio</label>
					</div>
					<div class="form-group" id="password2">
						<label for="recipient-password2" class="control-label">Repetir password:</label>
						<input name="password2" type="password" class="form-control" id="recipient-password2" required>

						<label class="control-label" for="recipient-password2" id="erro_pass" style="display:none;"><i class="fa fa-times-circle-o"></i> A password não é igual</label>
						<label class="control-label" for="recipient-password2" id="sucesso_pass" style="display:none;"><i class="fa fa-check"></i> As passwords são iguais</label>
						<label class="control-label" for="recipient-password2" id="vazio-pass2" style="display:none;"><i class="fa fa-times-circle-o"></i> Campo vazio</label>
					</div>
					<input name="id" type="hidden" class="form-control" id="id_inserir">

					<button type="button" name="submeter_user" class="btn btn-success ajax"  id="sub">Registar</button>
					<button type="submit" name="clear" class="btn btn-danger" data-dismiss="modal" id="clean">Cancelar</button>
				</form>
			</div>
		</div>
	</div>
</div>





<script src="Validações/validação_inserir_cuidador.js"></script> <!-- Uso de uma validação manual, verificar disponibilidades de username etc, e verificar se os campos estão vazios, pois o required não funciona com o tipo de botão como "button" (Uso desse tipo para que ao submeter os dados, não fazer refresh inteiro da página, mas apenas parcialmente);-->





