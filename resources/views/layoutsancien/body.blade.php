<!--end switcher-->
	<!-- Bootstrap JS -->
	<!--plugins-->
    <script src="{{asset("template/assets/bootstrap/js/bootstrap.min.js")}}"></script>
    {{-- <script src="{{asset("template/assets/js/chart.min.js")}}"></script>
    <script src="{{asset("template/assets/js/bs-init.js")}}"></script>
    <script src="{{asset("template/assets/js/theme.js")}}"></script> --}}
    <script src="{{asset("template/assets/js/jquery.min.js")}}"></script>
    <script src="{{asset("template/assets/js/intlTelInput.js")}}"></script>
	<!--app JS-->
    <script>
          $(function() {
            $('#typetache').change(function() {
              switch(parseInt( $('#typetache').val())){
                  case 1:
                  $('#descriptionGroup').attr('style','')
                  $('#fileGroup').attr('style','display:none')
                  break;
                  case 2:
                  $('#descriptionGroup').attr('style','display:none')
                  $('#fileGroup').attr('style','')
                  break;
                  case 3:
                  $('#descriptionGroup').attr('style','')
                  $('#fileGroup').attr('style','')
                  break;
                  case 4:
                  $('#descriptionGroup').attr('style','')
                  $('#fileGroup').attr('style','')
                  break;
                  default:
                  $('#descriptionGroup').attr('style','display:none')
                  $('#fileGroup').attr('style','display:none')
                  break;
              }
            });

            $("#country").change(function(){
                 let country_id=this.value;
                 $.get("./get_states?country="+country_id, function(data){
                    $('#dep').attr('style','')
                    $('#vil').attr('style','display:none;')
                    $("#state").html(data);
                 })
               });

               $("#state").change(function(){
                let states_id=this.value;
                $.get("./get_cities?states="+states_id, function(data){
                    $('#dep').attr('style','')
                    $('#vil').attr('style','')
                    $("#citie").html(data);
                })
            });

               $("#countrylist").change(function(event){
                 let country_id=Array.from(event.target.selectedOptions).map(option => option.value);
                 let countryId = country_id.join("_");
                    $.get("./get_liste_states?country="+countryId , function(data){
                    $('#listdep').attr('style','')
                    $('#listvil').attr('style','display:none;')
                    $("#stateliste").html(data);
                 })
               });

                $("#stateliste").change(function(event){
                 let states_id=Array.from(event.target.selectedOptions).map(option => option.value);
                 let statesId = states_id.join("_");
                $.get("./get_liste_city?state="+statesId , function(data){
                    $('#listvil').attr('style','')
                    $('#listvil').attr('style','')
                    $("#citielist").html(data);
                 })
               });

               $("#centre,#countrylist,#stateliste,#citielist").change(function(event){
                    let centreId = $("#centre").val();
                    let payId = $("#countrylist").val();
                    let depId = $("#stateliste").val();
                    let vilId = $("#citielist").val();
                    let totalId = centreId + "_" + payId + "_" + depId + "_" + vilId;
                $.get("./get_total_vues?total="+totalId ,function(data){
                    console.log(data);
                    $('#total').attr('style','')
                    $("#total").html(data);
                 })
               });

        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {});

        // Événement "countrychange" en utilisant l'option "utilsScript"
        iti.promise.then(function() {
            input.addEventListener("countrychange", function(e) {
                var selectedCountry = iti.getSelectedCountryData();
                var countryCode = selectedCountry.dialCode;
                input.value = '+' + countryCode;
                });
            });
        });

    </script>
</body>

</html>
