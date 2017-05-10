//Key up do input nome 
$("#recipient-nome").keyup(function()
{  

  var name = $(this).val(); 
  if(name.length > 0){

   $("#nome").attr("class", "form-group");
   $("#vazio-nome").hide();

 }

});

$("#recipient-nasc").keyup(function()
{  

  var name = $(this).val(); 
  if(name.length > 0){

   $("#nasc").attr("class", "form-group");
   $("#vazio-nasc").hide();

 }

});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Key up do input descrição
$("#recipient-desc").keyup(function()
{  

  var name = $(this).val(); 
  if(name.length > 0){

   $("#desc").attr("class", "form-group");
   $("#vazio-desc").hide();

 }

});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

var resultado; //Variável para gerenciar se o pace.js é ativado

//Verificação imei
var resposta; //Varável para retornar true ou false consoante a disponiblidade do imei
$("#recipient-imei").keyup(function()
{  
  var name = $(this).val(); 
  
  if(name.length > 0)
  {  
    $("#vazio-imei").hide();  
    $.ajax({

      type : 'POST',
      url  : 'Validações/check_imei.php',
      data : $(this).serialize(),
      success : function(data)
      {     




        resposta=$.trim(data);


        if(resposta=='Disponivel'){
          $("#erro_imei").hide();
          $("#imei").attr("class", "form-group has-success");
          $("#sucesso_imei").show(); 


        }else{
          $("#sucesso_imei").hide();
          $("#imei").attr("class", "form-group has-error");
          $("#erro_imei").show(); 

        }


      }
    });
    return false;

  }else{
    $("#imei").attr("class", "form-group");
    $("#sucesso_imei").hide();
    $("#erro_imei").hide();
    $("#vazio-imei").hide();

  }

});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////



//Ao clicar no botão submit, verificar se está tudo ok antes de submeter

$("#sub").click(function(e) {

  var controlo=true

  
  var nome
  var imei
  var desc
  var nasc
  var password
  var password2

  ///////////////// Parte da verificação se os campos estão vazios ///////////

  nome=$("#recipient-nome").val();
  imei=$("#recipient-imei").val();
  desc=$("#recipient-desc").val();
  nasc=$("#recipient-nasc").val();
 

  if(nome.length == 0){

    $("#nome").attr("class", "form-group has-error");
    $("#vazio-nome").show();
    controlo=false;

  }

  if(imei.length == 0){

    $("#imei").attr("class", "form-group has-error");
    $("#vazio-imei").show();
    controlo=false;

  }

  if(desc.length == 0){

    $("#desc").attr("class", "form-group has-error");
    $("#vazio-desc").show();
    controlo=false;

  }



  if(nome.length == 0){

    $("#nome").attr("class", "form-group has-error");
    $("#vazio-nome").show();
    controlo=false;

  }

  if(nasc.length == 0){
    $("#nasc").attr("class", "form-group has-error");
    $("#vazio-nasc").show();
    controlo=false;

  }

  


  ///////////////// Acaba a parte da verificação se os campos estão vazios ///////////




  
  if (resposta=="Disponivel" && controlo==true) {

    resultado="true";

    
    var url = "BD_Inserir_Monitorizados.php"; 

    $.ajax({
     type: "POST",
     url: url,
     data: $("#f1").serialize(),

     success: function(data)
     {
       /*$('#ModalInserir').modal('hide');
       $("#sucesso_pass").hide();
       $("#sucesso_imei").hide();
       $("#sucesso_desc").hide();
       $("#imei").attr("class", "form-group");
       $("#desc").attr("class", "form-group");
       $("#password2").attr("class", "form-group");


       $('#f1').trigger("reset");


       resposta1="Vazio";
       resposta2="Vazio";
       pass="Vazio";


       //$( "#dados" ).load( "index.php #dados" );
       //$('table#example1').load ('index2.php', 'update=true');
       //$('body').removeClass('modal-open');
       //$('.modal-backdrop').remove();
       */
       
       location.reload();

       
       






     }
   });


  } else {

    resultado="false"; // isto permite controlar o pace.js, caso esteja true, é utilizado o método .start do "Gestão cuidadores/index.php"

  }

});
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////Limpar formulário//////////////////////////////////////////
$("#clean").click(function(e) {

  $("#recipient-nome").val("");
  $("#recipient-imei").val("");
  $("#recipient-desc").val("");
  $("#recipient-telemovel").val("");
  $("#recipient-password").val("");
  $("#recipient-password2").val("");



  $("#sucesso_desc").hide();
  $("#erro_desc").hide();
  $("#incompleto-desc").hide(); 
  $("#vazio-desc").hide();

  $("#sucesso_imei").hide();
  $("#erro_imei").hide();
  $("#vazio-imei").hide();

  $("#sucesso_pass").hide();
  $("#erro_pass").hide();
  $("#vazio-pass2").hide();



  $("#imei").attr("class", "form-group");
  $("#desc").attr("class", "form-group");
  $("#password2").attr("class", "form-group");

});









