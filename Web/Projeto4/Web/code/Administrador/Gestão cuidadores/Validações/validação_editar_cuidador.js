var recipientusername;
var recipientemail;
//Key up do input nome 

$("#editar-nomeEdit").keyup(function()
{  

  var name = $(this).val(); 
  if(name.length > 0){

   $("#nomeEdit").attr("class", "form-group");
   $("#vazio-nomeEdit").hide();

 }

});


$("#editar-passwordEdit").keyup(function()
{  

  var name = $(this).val(); 
  if(name.length > 0){

   $("#passwordEdit").attr("class", "form-group input-group");
   $("#vazio-passEdit").hide();
   $('#ver').css('margin-top', '0px');

 }

});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Key up do input telemovel
$("#editar-telemovelEdit").keyup(function()
{  

  var name = $(this).val(); 
  if(name.length > 0){

   $("#telemovelEdit").attr("class", "form-group");
   $("#vazio-telemovelEdit").hide();

 }

});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

var resultado; //Variável para gerenciar se o pace.js é ativado
var resposta1Edit="Disponivel"; //Variável para retornar true ou false consoante a disponiblidade do email

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Verificação email 
$("#editar-emailEdit").keyup(function()
{  
  $("#vazio-emailEdit").hide();
  var name = $(this).val(); 

  if(name!=recipientemail){

    if(name.length > 0)
    {

      $("#vazio-emailEdit").hide();  
      var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
      if (testEmail.test(name)){

        $.ajax({

          type : 'POST',
          url  : 'Validações/check_mail.php',
          data : {"email":name},
          success : function(data)
          {     

            resposta1Edit=$.trim(data);


            if(resposta1Edit=='Disponivel'){
              $("#incompleto-emailEdit").hide(); 
              $("#erro_emailEdit").hide();
              $("#emailEdit").attr("class", "form-group has-success");
              $("#sucesso_emailEdit").show(); 


            }else{
              $("#incompleto-emailEdit").hide(); 
              $("#sucesso_emailv").hide();
              $("#emailEdit").attr("class", "form-group has-error");
              $("#erro_emailEdit").show(); 

            }


          }
        });

        return false;

      }else{
        $("#sucesso_emailEdit").hide();
        $("#erro_emailEdit").hide();
        $("#emailEdit").attr("class", "form-group has-error");
        $("#incompleto-emailEdit").show(); 
      }




    }else{
     $("#emailEdit").attr("class", "form-group");
     $("#sucesso_emailEdit").hide();
     $("#erro_emailEdit").hide();
     $("#incompleto-emailEdit").hide(); 
     $("#vazio-emailEdit").hide();

   }

 }else{
  $("#emailEdit").attr("class", "form-group");
  $("#sucesso_emailEdit").hide();
  $("#erro_emailEdit").hide();
  $("#incompleto-emailEdit").hide(); 
  $("#vazio-emailEdit").hide();
  resposta1Edit=='Disponivel';
}

});


/////////////////////////////////////////////////////////////////////////////////////////////////////////////



//Verificação username
var resposta2Edit="Disponivel"; //Varável para retornar true ou false consoante a disponiblidade do username
$("#editar-usernameEdit").keyup(function()
{  
  var name = $(this).val(); 
  if(name!=recipientusername){

    if(name.length > 0)
    {  
      $("#vazio-usernameEdit").hide();  
      $.ajax({

        type : 'POST',
        url  : 'Validações/check_username.php',
        data : {"username":name},
        success : function(data)
        {     




          resposta2Edit=$.trim(data);
          


          if(resposta2Edit=='Disponivel'){
            $("#erro_usernameEdit").hide();
            $("#usernameEdit").attr("class", "form-group has-success");
            $("#sucesso_usernameEdit").show(); 


          }else{
            $("#sucesso_usernameEdit").hide();
            $("#usernameEdit").attr("class", "form-group has-error");
            $("#erro_usernameEdit").show(); 

          }


        }
      });
      return false;

    }else{
      $("#usernameEdit").attr("class", "form-group");
      $("#sucesso_usernameEdit").hide();
      $("#erro_usernameEdit").hide();
      $("#vazio-usernameEdit").hide();

    }
  }else{
    $("#usernameEdit").attr("class", "form-group");
    $("#sucesso_usernameEdit").hide();
    $("#erro_usernameEdit").hide();
    $("#vazio-usernameEdit").hide();
    resposta2Edit=='Disponivel';
  }
});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////







/////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Ao clicar no botão submit, verificar se está tudo ok antes de submeter

$("#edit").click(function(e) {



  e.preventDefault();

  var controlo=true

  
  var nome
  var username
  var email
  var telefone
  var password
  var password2

  ///////////////// Parte da verificação se os campos estão vazios ///////////

  nome=$("#editar-nomeEdit").val();
  username=$("#editar-usernameEdit").val();
  email=$("#editar-emailEdit").val();
  telefone=$("#editar-telemovelEdit").val();
  password=$("#editar-passwordEdit").val();

  if(nome.length == 0){

    $("#nomeEdit").attr("class", "form-group has-error");
    $("#vazio-nomeEdit").show();
    controlo=false;

  }

  if(username.length == 0){

    $("#usernameEdit").attr("class", "form-group has-error");
    $("#vazio-usernameEdit").show();
    controlo=false;

  }

  if(email.length == 0){

    $("#emailEdit").attr("class", "form-group has-error");
    $("#vazio-emailEdit").show();
    controlo=false;

  }


  if(telefone.length == 0){
    $("#telemovelEdit").attr("class", "form-group has-error");
    $("#vazio-telemovelEdit").show();
    controlo=false;

  }

  if(password.length == 0){
    $("#passwordEdit").attr("class", "input-group form-group has-error");
    $("#vazio-passEdit").show();
    $('#ver').css('margin-top', '-24px');

    controlo=false;

  }

  


  ///////////////// Acaba a parte da verificação se os campos estão vazios ///////////



  if (resposta1Edit=="Disponivel" && resposta2Edit=="Disponivel" && controlo==true) {

    resultado="true";
    

    var url = "BD_Editar_Cuidadores.php"; 

    
    $.ajax({
     type: "POST",
     url: url,
     data: $("#f2").serialize(),

     success: function(data)
     {

      $.scojs_message('Utilizador editado com sucesso', $.scojs_message.TYPE_OK);
      //$('#ModalEdit').modal('toogle');
      
       /*$("#sucesso_passEdit").hide();
       $("#sucesso_usernameEdit").hide();
       $("#sucesso_emailEdit").hide();
       $("#usernameEdit").attr("class", "form-group");
       $("#emailEdit").attr("class", "form-group");
       $("#passwordEdit").attr("class", "form-group");


       //$('#f2').trigger("reset");

       resposta1Edit="Vazio";
       resposta2Edit="Vazio";*/

       //$('body').removeClass('modal-open');
       //$('.modal-backdrop').remove();
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

  $("#editar-nomeEdit").val("");
  $("#editar-usernameEdit").val("");
  $("#editar-emailEdit").val("");
  $("#editar-telemovelEdit").val("");
  $("#editar-passwordEdit").val("");



  $("#sucesso_emailEdit").hide();
  $("#erro_emailEdit").hide();
  $("#incompleto-emailEdit").hide(); 
  $("#vazio-emailEdit").hide();

  $("#sucesso_usernameEdit").hide();
  $("#erro_usernameEdit").hide();
  $("#vazio-usernameEdit").hide();

  $("#sucesso_passEdit").hide();
  $("#erro_passEdit").hide();



  $("#usernameEdit").attr("class", "form-group");
  $("#emailEdit").attr("class", "form-group");
  $("#passwordEdit").attr("class", "form-group");

});









