


var resultado;
var resposta1;
$("#recipient-email").keyup(function()
{  
  var name = $(this).val(); 
  
  if(name.length > 0)
  {  
   //$("#mail_error").html('A procurar...');
   
   $.ajax({

    type : 'POST',
    url  : 'Validações/check_mail.php',
    data : $(this).serialize(),
    success : function(data)
    {     

      resposta1=$.trim(data);


      if(resposta1=='Disponivel'){
        $("#erro_email").hide();
        $("#email").attr("class", "form-group has-success");
        $("#sucesso_email").show(); 


      }else{

        $("#sucesso_email").hide();
        $("#email").attr("class", "form-group has-error");
        $("#erro_email").show(); 

      }


    }
  });
   return false;
   
 }else{
   $("#email").attr("class", "form-group");
   $("#sucesso_email").hide();
   $("#erro_email").hide(); 

 }

});
var resposta2;
$("#recipient-username").keyup(function()
{  
  var name = $(this).val(); 
  
  if(name.length > 0)
  {  
   //$("#user_error").html('A procurar...');
   
   $.ajax({

    type : 'POST',
    url  : 'Validações/check_username.php',
    data : $(this).serialize(),
    success : function(data)
    {     




      resposta2=$.trim(data);
              //console.log($.trim(data));

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
}

});
var pass;
$("#recipient-password2").keyup(function()
{  
  var name = $(this).val(); 
  
  if(name.length > 0)
  {  
   //$("#user_error").html('A procurar...');
   
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
     $("#password").attr("class", "form-group has-success");
     $("#sucesso_pass").show();



   } else {
    $("#sucesso_pass").hide();
    pass=$.trim(data);
    $("#password").attr("class", "form-group has-error");
    $("#erro_pass").show(); 
  }


}
});
   return false;
   
 }else{
  $("#password").attr("class", "form-group");
  $("#sucesso_pass").hide();
  $("#erro_pass").hide();
}

});

 // this is the id of the submit button
 $("#sub").click(function(e) {

  if (resposta1=="Disponivel" && resposta2=="Disponivel" && pass=="true") {

            var url = "BD_Inserir_Cuidador.php"; // the script where you handle the form input.

            $.ajax({
             type: "POST",
             url: url,
           data: $("#f1").serialize(), // serializes the form's elements.

           success: function(data)
           {
             $('#ModalInserir').modal('hide');
             $("#sucesso_pass").hide();
             $("#sucesso_username").hide();
             $("#sucesso_email").hide();
             $("#username").attr("class", "form-group");
             $("#email").attr("class", "form-group");
             $("#password").attr("class", "form-group");
             

             $('#f1').trigger("reset");

             resposta1="Vazio";
             resposta2="Vazio";
             pass="Vazio";
             resultado="true";

             $( "#dados" ).load( "index.php #dados" );

           }
         });
   

          } else {

            resultado="false";
            
          }

        });
 

 






