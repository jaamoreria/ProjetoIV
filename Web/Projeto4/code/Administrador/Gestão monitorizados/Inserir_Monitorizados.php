<?php

include ("../../../BD.php");
?>
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>


<span class="btns glyphicon glyphicon-plus" style="position: relative; float: right; margin-right: -2px" data-toggle="modal" data-target="#ModalInserir"></span>



<div class="modal fade" id="ModalInserir" tabindex="-1" role="dialog" aria-labelledby="ModalInserirLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="ModalInserirLabel">Inserir dados do monitorizado</h4>
			</div>
			<div class="modal-body">
				<form name ="f1" id="f1" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
					<div class="form-group" id="nome">

						<label for="recipient-nome" class="control-label">Nome:</label>
						<input name="nome" type="text" class="form-control" id="recipient-nome" required>

						<label class="control-label" for="recipient-nome" id="vazio-nome" style="display:none;"><i class="fa fa-times-circle-o"></i> Campo vazio</label>
					</div>

					<div class="form-group" id="imei">
						<label for="recipient-imei" class="control-label">IMEI:</label>
						<input name="imei" type="text" class="form-control" id="recipient-imei" required>

						<label class="control-label" for="recipient-imei" id="erro_imei" style="display:none;"><i class="fa fa-times-circle-o"></i> Já utilizado</label>
						<label class="control-label" for="recipient-imei" id="sucesso_imei" style="display:none;"><i class="fa fa-check"></i> Disponível</label>
						<label class="control-label" for="recipient-imei" id="vazio-imei" style="display:none;"><i class="fa fa-times-circle-o"></i> Campo vazio</label>

					</div>
					<div class="form-group" id="desc">
						<label for="recipient-desc" class="control-label">Descrição:</label>
						<input name="desc" type="text" class="form-control" id="recipient-desc" required>

						<label class="control-label" for="recipient-desc" id="vazio-desc" style="display:none;"><i class="fa fa-times-circle-o"></i> Campo vazio</label>
						

					</div>
					<div class="form-group" id="nasc">
						<label for="recipient-nasc" class="control-label">Data de nascimento:</label>
						<input name="nasc" type="text" class="form-control" id="recipient-nasc" required data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">

						<label class="control-label" for="recipient-nasc" id="vazio-nasc" style="display:none;"><i class="fa fa-times-circle-o"></i> Campo vazio</label>
						
					</div>
					
					<input name="id" type="hidden" class="form-control" id="id_inserir">

					<button type="button" name="submeter_user" class="btn btn-success ajax"  id="sub">Registar</button>
					<button type="submit" name="clear" class="btn btn-danger" data-dismiss="modal" id="clean">Cancelar</button>
				</form>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    
    
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    
  });
</script>


<script src="Validações/validação_inserir_monitorizado.js"></script> <!-- Uso de uma validação manual, verificar disponibilidades de username etc, e verificar se os campos estão vazios, pois o required não funciona com o tipo de botão como "button" (Uso desse tipo para que ao submeter os dados, não fazer refresh inteiro da página, mas apenas parcialmente);-->





