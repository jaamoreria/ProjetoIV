//Key up do input nome 
$("#recipient-nome").keyup(function()
{  

  var name = $(this).val(); 
  if(name.length > 0){

   $("#nome").attr("class", "form-group");
   $("#vazio-nome").hide();

 }

});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Key up do input telemovel
$("#recipient-telemovel").keyup(function()
{  

  var name = $(this).val(); 
  if(name.length > 0){

   $("#telemovel").attr("class", "form-group");
   $("#vazio-telemovel").hide();

 }

});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

var resultado; //Variável para gerenciar se o pace.js é ativado
var resposta1; //Variável para retornar true ou false consoante a disponiblidade do email

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Verificação email 
$("#recipient-email").keyup(function()
{  
  $("#vazio-email").hide();
  var name = $(this).val(); 
  
  if(name.length > 0)
  {
    $("#vazio-email").hide();  
    var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    if (testEmail.test(name)){

      $.ajax({

        type : 'POST',
        url  : 'Validações/check_mail.php',
        data : $(this).serialize(),
        success : function(data)
        {     

          resposta1=$.trim(data);


          if(resposta1=='Disponivel'){
            $("#incompleto-email").hide(); 
            $("#erro_email").hide();
            $("#email").attr("class", "form-group has-success");
            $("#sucesso_email").show(); 


          }else{
            $("#incompleto-email").hide(); 
            $("#sucesso_email").hide();
            $("#email").attr("class", "form-group has-error");
            $("#erro_email").show(); 

          }


        }
      });

      return false;

    }else{
      $("#sucesso_email").hide();
      $("#erro_email").hide();
      $("#email").attr("class", "form-group has-error");
      $("#incompleto-email").show(); 
    }




  }else{
   $("#email").attr("class", "form-group");
   $("#sucesso_email").hide();
   $("#erro_email").hide();
   $("#incompleto-email").hide(); 
   $("#vazio-email").hide();

 }

});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////



//Verificação username
var resposta2; //Varável para retornar true ou false consoante a disponiblidade do username
$("#recipient-username").keyup(function()
{  
  var name = $(this).val(); 
  
  if(name.length > 0)
  {  
    $("#vazio-username").hide();  
    $.ajax({

      type : 'POST',
      url  : 'Validações/check_username.php',
      data : $(this).serialize(),
      success : function(data)
      {     




        resposta2=$.trim(data);


        if(resposta2=='Disponivel'){
          $("#erro_username").hide();
          $("#username").attr("class", "form-group has-success");
          $("#sucesso_username").show(); 


        }else{
          $("#sucesso_username").hide();
          $("#username").attr("class", "form-group has-error");
          $("#erro_username").show(); 

        }


      }
    });
    return false;

  }else{
    $("#username").attr("class", "form-group");
    $("#sucesso_username").hide();
    $("#erro_username").hide();
    $("#vazio-username").hide();

  }

});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Verificação password do primeiro campo, caso seja alterado esse campo quando já introduzido password no campo 2, fazer verificação na mesma

var pass1;
$("#recipient-password").keyup(function()
{  
  var name = $(this).val(); 
  
  if(name.length > 0)
  { 

    $("#password").attr("class", "form-group");
    $("#vazio-pass1").hide();
    $("#vazio-pass2").hide(); 
    $.ajax({

      url: "Validações/check_password.php",
      dataType : "json",
      "method" : "GET",
      data : {
       "a" :$("#recipient-password").val(),
       "aa" :$("#recipient-password2").val()
     },
     success : function(data)
     {     
      if (data) {
       $("#erro_pass").hide();
       pass=$.trim(data);
       $("#password2").attr("class", "form-group has-success");
       $("#sucesso_pass").show();



     } else {
      $("#sucesso_pass").hide();
      pass=$.trim(data);
      $("#password2").attr("class", "form-group has-error");
      $("#erro_pass").show(); 
    }


  }
});
    return false;

  }else{
    $("#password2").attr("class", "form-group");
    $("#sucesso_pass").hide();
    $("#erro_pass").hide();
  }

});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////


//verificação da password do segundo input
var pass;
$("#recipient-password2").keyup(function()
{  
  var name = $(this).val(); 
  
  if(name.length > 0)
  {  

    $("#password2").attr("class", "form-group");
    $("#vazio-pass2").hide();
    $.ajax({

      url: "Validações/check_password.php",
      dataType : "json",
      "method" : "GET",
      data : {
       "a" :$("#recipient-password").val(),
       "aa" :$("#recipient-password2").val()
     },
     success : function(data)
     {     
      if (data) {
       $("#erro_pass").hide();
       pass=$.trim(data);
       $("#password2").attr("class", "form-group has-success");
       $("#sucesso_pass").show();



     } else {
      $("#sucesso_pass").hide();
      pass=$.trim(data);
      $("#password2").attr("class", "form-group has-error");
      $("#erro_pass").show(); 
    }


  }
});
    return false;

  }else{
    $("#password2").attr("class", "form-group");
    $("#sucesso_pass").hide();
    $("#erro_pass").hide();
  }

});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Ao clicar no botão submit, verificar se está tudo ok antes de submeter

$("#sub").click(function(e) {

  var controlo=true

  
  var nome
  var username
  var email
  var telefone
  var password
  var password2

  ///////////////// Parte da verificação se os campos estão vazios ///////////

  nome=$("#recipient-nome").val();
  username=$("#recipient-username").val();
  email=$("#recipient-email").val();
  telefone=$("#recipient-telemovel").val();
  password=$("#recipient-password").val();
  password2=$("#recipient-password2").val();

  if(nome.length == 0){

    $("#nome").attr("class", "form-group has-error");
    $("#vazio-nome").show();
    controlo=false;

  }

  if(username.length == 0){

    $("#username").attr("class", "form-group has-error");
    $("#vazio-username").show();
    controlo=false;

  }

  if(email.length == 0){

    $("#email").attr("class", "form-group has-error");
    $("#vazio-email").show();
    controlo=false;

  }



  if(nome.length == 0){

    $("#nome").attr("class", "form-group has-error");
    $("#vazio-nome").show();
    controlo=false;

  }

  if(telefone.length == 0){
    $("#telemovel").attr("class", "form-group has-error");
    $("#vazio-telemovel").show();
    controlo=false;

  }

  if(password.length == 0){

    $("#password").attr("class", "form-group has-error");
    $("#vazio-pass1").show();
    controlo=false;

  }

  if(password2.length == 0){

    $("#password2").attr("class", "form-group has-error");
    $("#vazio-pass2").show();
    controlo=false;

  }


  ///////////////// Acaba a parte da verificação se os campos estão vazios ///////////





  if (resposta1=="Disponivel" && resposta2=="Disponivel" && pass=="true" && controlo==true) {

    resultado="true";


    var url = "BD_Inserir_Cuidador.php"; 

    $.ajax({
     type: "POST",
     url: url,
     data: $("#f1").serialize(),

     success: function(data)
     {
       $('#ModalInserir').modal('hide');
       $("#sucesso_pass").hide();
       $("#sucesso_username").hide();
       $("#sucesso_email").hide();
       $("#username").attr("class", "form-group");
       $("#email").attr("class", "form-group");
       $("#password2").attr("class", "form-group");


       $('#f1').trigger("reset");

       resposta1="Vazio";
       resposta2="Vazio";
       pass="Vazio";


       $( "#dados" ).load( "index.php #dados" );

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
  $("#recipient-username").val("");
  $("#recipient-email").val("");
  $("#recipient-telemovel").val("");
  $("#recipient-password").val("");
  $("#recipient-password2").val("");



  $("#sucesso_email").hide();
  $("#erro_email").hide();
  $("#incompleto-email").hide(); 
  $("#vazio-email").hide();

  $("#sucesso_username").hide();
  $("#erro_username").hide();
  $("#vazio-username").hide();

  $("#sucesso_pass").hide();
  $("#erro_pass").hide();
  $("#vazio-pass2").hide();



  $("#username").attr("class", "form-group");
  $("#email").attr("class", "form-group");
  $("#password2").attr("class", "form-group");

});









