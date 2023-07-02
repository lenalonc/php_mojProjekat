function prikazi() {
  var x = document.getElementById("pregled");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

$('#btn-pretraga').click(function () {

  var para = document.querySelector('#myInput');
  console.log(para);
  var style = window.getComputedStyle(para);
  console.log(style);
  if (!(style.display === 'inline-block') || ($('#myInput').css("visibility") ==  "hidden")) {
      console.log('block');
      $('#myInput').show();
      document.querySelector("#myInput").style.visibility = "";
  } else {
     document.querySelector("#myInput").style.visibility = "hidden";
  }
});


$('#btn-obrisi').click(function(){
  console.log("Brisanje");

  const checked = $('input[type=radio]:checked');

  req = $.ajax({
      url: 'handler/delete.php',
      type:'post',
      data: {'id':checked.val()}
  });

  req.done(function(res, textStatus, jqXHR){
      if(res=="Success"){
         checked.closest('tr').remove();
         alert('Obrisan termin');
      }else {
      console.log("Termin nije obrisan "+res);
      alert("Termin nije obrisan ");

      }
      console.log(res);
  });

});

$('#dodajForm').submit(function(){
  event.preventDefault();
  
  const $form =$(this);
  const $input = $form.find('input, select, button, textarea');

  const serijalizacija = $form.serialize();
  console.log(serijalizacija);

  $input.prop('disabled', true);

  req = $.ajax({
      url: 'handler/add.php',
      type:'post',
      data: serijalizacija
  });

  req.done(function(res, textStatus, jqXHR){
      if(res=="Success"){
          alert("Termin je uspešno zakazan");
          location.reload(true);
      }else console.log("Termin nije zakazan "+res);
      console.log(res);
  });

  req.fail(function(jqXHR, textStatus, errorThrown){
      console.error('Sledeca greska se desila> '+textStatus, errorThrown)
  });
});



$("#btn-izmeni").click(function () {
  const checked = $("input[name=checked-donut]:checked");

  request = $.ajax({
    url: "handler/get.php",
    type: "post",
    data: { id: checked.val() },
    dataType: "json",
  });

  request.done(function (response, textStatus, jqXHR) {
    console.log("Popunjena");
    
    $("#usluga").val(response[0]["usluga"]);
    console.log(response[0]["usluga"]);

    $("#klijent").val(response[0]["klijent"].trim());
    console.log(response[0]["klijent"].trim());
    $("#cena").val(response[0]["cena"].trim());
    console.log(response[0]["cena"].trim());
    $("#datum").val(response[0]["datum"].trim());
    console.log(response[0]["datum"].trim());
    $("#id").val(checked.val());

    
  });

  request.fail(function (jqXHR, textStatus, errorThrown) {
    console.error("The following error occurred: " + textStatus, errorThrown);
  });
});

$('#izmeniForm').submit(function () {
  event.preventDefault();
 
  const $form = $(this);
  const $inputs = $form.find('input, select, button');
  const serializedData = $form.serialize();
  console.log(serializedData);
  
  $inputs.prop('disabled', true);

  // Kreirajte AJAX zahtev za UPDATE handler
  request = $.ajax({
      url: "handler/update.php",
      type: "post",
      data: serializedData,
  });

  request.done(function (response, textStatus, jqXHR) {
    console.log("resp: "+response);
      if (response === "Success") {
          alert("Termin je uspešno izmenjen");
          location.reload(true);
          //$('#izmeniForm').reset();
      } else {
        console.log('Nije uspelo')
        //alert("Termin nije izmenjen");
      }
      console.log(response);
  });

  request.fail(function (jqXHR, textStatus, errorThrown) {
      console.error('The following error occurred: ' + textStatus, errorThrown);
  });

  //$('#izmeniModal').modal('hide');
});

// $('#btnIzmeni').submit(function () {
//   $('#dodajModal').modal('toggle');
//   return false;
// });

$('#btn-dodaj').on('click', function() {
  event.preventDefault(); // Da se spreči podrazumevano ponašanje obrasca
  
  request = $.ajax({
    url: "handler/getTret.php",
    type: "post",
    dataType: "json",
    });
    request.done(function (response, textStatus, jqXHR) {
      console.log("Ajax uspeh:", response);
      console.log('a');
      if (response.length > 0) {
        console.log(response.length);
        var select = $("#uslugaa");
        console.log(select);
        select.empty(); // Uklanja postojeće opcije
        for (var i = 0; i < response.length; i++) {
          console.log('ciklus: '+response[i]);
          var option = $("<option>", {
            value: response[i],
            text: response[i]
          });
          select.append(option);
        }
      }
      else{
        console.log('nesto nije okej');
      }
    });
        request.fail(function (jqXHR, textStatus, errorThrown) {
          console.error("The following error occurred: " + textStatus, errorThrown);
        });
      
      });



  

