var recipientimei;

//Key up do input nome 

$("#editar-nomeEdit").keyup(function()
{  

  var name = $(this).val(); 
  if(name.length > 0){

   $("#nomeEdit").attr("class", "form-group");
   $("#vazio-nomeEdit").hide();

 }

});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

$("#editar-nascEdit").keyup(function()
{  

  var name = $(this).val(); 
  if(name.length > 0){

   $("#nascEdit").attr("class", "form-group");
   $("#vazio-nascEdit").hide();

 }

});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Key up do input telemovel
$("#editar-descEdit").keyup(function()
{  

  var name = $(this).val(); 
  if(name.length > 0){

   $("#descEdit").attr("class", "form-group");
   $("#vazio-descEdit").hide();

 }

});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

var resultado; //Variável para gerenciar se o pace.js é ativado

//Verificação imei
var respostaEdit="Disponivel"; //Varável para retornar true ou false consoante a disponiblidade do imei
$("#editar-imeiEdit").keyup(function()
{  
  var name = $(this).val(); 
 
  if(name!=recipientimei){

    if(name.length > 0)
    {  
      $("#vazio-imeiEdit").hide();  
      $.ajax({

        type : 'POST',
        url  : 'Validar/check_imei.php',
        data : {"imei":name},
        success : function(data)
        {     




          respostaEdit=$.trim(data);
          


          if(respostaEdit=='Disponivel'){
            $("#erro_imeiEdit").hide();
            $("#imeiEdit").attr("class", "form-group has-success");
            $("#sucesso_imeiEdit").show(); 


          }else{
            $("#sucesso_imeiEdit").hide();
            $("#imeiEdit").attr("class", "form-group has-error");
            $("#erro_imeiEdit").show(); 

          }


        }
      });
      return false;

    }else{
      $("#imeiEdit").attr("class", "form-group");
      $("#sucesso_imeiEdit").hide();
      $("#erro_imeiEdit").hide();
      $("#vazio-imeiEdit").hide();

    }
  }else{
    $("#imeiEdit").attr("class", "form-group");
    $("#sucesso_imeiEdit").hide();
    $("#erro_imeiEdit").hide();
    $("#vazio-imeiEdit").hide();
    respostaEdit=='Disponivel';
  }
});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////







/////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Ao clicar no botão submit, verificar se está tudo ok antes de submeter

$("#edit").click(function(e) {



  e.preventDefault();

  var controlo=true

  
  var nome
  var imei
  var desc
  var nasc


  ///////////////// Parte da verificação se os campos estão vazios ///////////

  nome=$("#editar-nomeEdit").val();
  imei=$("#editar-imeiEdit").val();
  desc=$("#editar-descEdit").val();
  nasc=$("#editar-nascEdit").val();



  if(nome.length == 0){

    $("#nomeEdit").attr("class", "form-group has-error");
    $("#vazio-nomeEdit").show();
    controlo=false;

  }

  if(imei.length == 0){

    $("#imeiEdit").attr("class", "form-group has-error");
    $("#vazio-imeiEdit").show();
    controlo=false;

  }

  if(desc.length == 0){

    $("#descEdit").attr("class", "form-group has-error");
    $("#vazio-descEdit").show();
    controlo=false;

  }


  if(nasc.length == 0){
    $("#nascEdit").attr("class", "form-group has-error");
    $("#vazio-nascEdit").show();
    controlo=false;

  }



  ///////////////// Acaba a parte da verificação se os campos estão vazios ///////////



  if (respostaEdit=="Disponivel" && controlo==true) {

    resultado="true";
    

    var url = "BD_Editar_Monitorizados.php"; 

    
    $.ajax({
     type: "POST",
     url: url,
     data: $("#f2").serialize(),

     success: function(data)
     {
      
     // $.scojs_message('Utilizador editado com sucesso', $.scojs_message.TYPE_OK);
      //$('#ModalEdit').modal('toogle');
      
       /*$("#sucesso_passEdit").hide();
       $("#sucesso_imeiEdit").hide();
       $("#sucesso_descEdit").hide();
       $("#imeiEdit").attr("class", "form-group");
       $("#descEdit").attr("class", "form-group");
       $("#nascEdit").attr("class", "form-group");


       //$('#f2').trigger("reset");

       resposta1Edit="Vazio";
       resposta2Edit="Vazio";*/

       //$('body').removeClass('modal-open');
       //$('.modal-backdrop').remove();
      location.reload();
     }
   });


  } else {

    resultado="false"; // isto permite controlar o pace.js, caso esteja true, é utilizado o método .start do "Gerir cuidadores/index.php"

  }

});
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////Limpar formulário//////////////////////////////////////////
$("#clean").click(function(e) {

  $("#editar-nomeEdit").val("");
  $("#editar-imeiEdit").val("");
  $("#editar-descEdit").val("");
  $("#editar-telemovelEdit").val("");
  $("#editar-nascEdit").val("");



  $("#sucesso_descEdit").hide();
  $("#erro_descEdit").hide();
  $("#incompleto-descEdit").hide(); 
  $("#vazio-descEdit").hide();

  $("#sucesso_imeiEdit").hide();
  $("#erro_imeiEdit").hide();
  $("#vazio-imeiEdit").hide();

  $("#sucesso_nascEdit").hide();
  $("#erro_nascEdit").hide();



  $("#imeiEdit").attr("class", "form-group");
  $("#descEdit").attr("class", "form-group");
  $("#nascEdit").attr("class", "form-group");

});









