<?php 


$id=$_SESSION['monitorizado'];
$id_cuidador=$_SESSION['login_user_id'];

?>

<link rel="stylesheet" type="text/css" href="../../../../css/set1.css" />
<div class="row">

  <div class="col-md-4"> 

    <span class="input input--hoshi" style="margin-top: -5px !important;">
      <input class="input__field input__field--hoshi" type="text" id="input-5" placeholder="">
      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
        <span class="input__label-content input__label-content--hoshi">Localização</span>
      </label>
    </span>
    
  </div>

  <div class="col-md-8">
      <div class="form-group">
        <label>Filtros:</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
          <input type="text" class="form-control pull-right" id="reservationtime">
        </div>

      </div>
    </div>
  </div>



  <div class="row">
    <div class="col-md-12">  
      <div id="map2Div" style="height: 500px;">
      </div>
    </div>


  </div>








  <?php include("source_script.php") ?>
  <script>
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 10, timePicker24Hour: true, 
      locale: {

        startOfWeek: 'Segunda',
        separator : '  -  ',
        format: 'DD/MM/YYYY hh:mm',
        autoClose: false,
        "applyLabel": "Confirmar",
        "cancelLabel": "Cancelar",
        "fromLabel": "From",
        "toLabel": "To",
        "customRangeLabel": "Custom",
        "daysOfWeek": [
        "Dom",
        "Seg",
        "Ter",
        "Quar",
        "Qui",
        "Sext",
        "Sab"
        ],
        "monthNames": [
        "Janeiro",
        "Fevereiro",
        "Março",
        "Abril",
        "Maio",
        "Junho",
        "Julho",
        "Agosto",
        "Setembro",
        "Outubro",
        "Novembro",
        "Dezembro"
        ],
        "firstDay": 1

      }});
    </script>

