    <script src="../../../../code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="../../../../cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="../../../../cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="../../../../cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="../../../../cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="../../../../cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="../../../../cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="../../../../cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="../../../../cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="../../../../cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <!-- particles js -->
    <script src="{{asset('velson/libs/particles.js/particles.js')}}"></script>
    <!-- particles app js -->
    <script src="{{asset('velson/js/pages/particles.app.js')}}"></script>
    <!-- validation init -->
    <script src="{{asset('velson/js/pages/form-validation.init.js')}}"></script>
    <script src="assets/js/pages/password-addon.init.js"></script>
    <!-- password create init -->
    <script src="{{asset('velson/js/pages/passowrd-create.init.js')}}"></script>
    <script src="{{asset('velson/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('velson/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('velson/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('velson/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('velson/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('velson/js/plugins.js')}}"></script>
    <!-- add for template -->
    <script src="{{asset("template/assets/js/jquery.min.js")}}"></script>
    <script src="{{asset("template/assets/js/intlTelInput.js")}}"></script>
    <script src="path/to/intl-tel-input/js/intlTelInput.min.js"></script>
    <script src="assets/libs/multi.js/multi.min.js"></script>
    <!-- autocomplete js -->
    <script src="assets/libs/%40tarekraafat/autocomplete.js/autoComplete.min.js"></script>

    <!-- apexcharts -->
    <script src="{{asset('velson/libs/apexcharts/apexcharts.min.js')}}"></script>

    <!-- Vector map-->
    <script src="{{asset('velson/libs/jsvectormap/js/jsvectormap.min.js')}}"></script>
    <script src="{{asset('velson/libs/jsvectormap/maps/world-merc.js')}}"></script>

    <!--Swiper slider js-->
    <script src="{{asset('velson/libs/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('velson/js/pages/profile.init.js')}}"></script>

    <!-- glightbox js -->
    <script src="{{asset('velson/libs/glightbox/js/glightbox.min.js')}}"></script>

    <!-- isotope-layout -->
    <script src="{{asset('velson/libs/isotope-layout/isotope.pkgd.min.js')}}"></script>

    <script src="{{asset('velson/js/pages/gallery.init.js')}}"></script>

    <!-- Dashboard init -->
    <script src="{{asset('velson/js/pages/dashboard-ecommerce.init.js')}}"></script>

    <!-- ckeditor -->
    <script src="{{asset('velson/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>

    <!-- dropzone js -->
    <script src="{{asset('velson/libs/dropzone/dropzone-min.js')}}"></script>
    <!-- project-create init -->
    <script src="{{asset('velson/js/pages/project-create.init.js')}}"></script>
    <!-- list.js min js -->
    <script src="{{asset('velson/libs/list.js/list.min.js')}}"></script>

    <!--list pagination js-->
    <script src="{{asset('velson/libs/list.pagination.js/list.pagination.min.js')}}"></script>

    <!-- ecommerce-order init js -->
    <script src="{{asset('velson/js/pages/ecommerce-order.init.js')}}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{asset('velson/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('velson/js/app.js')}}"></script>


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
                $('#descriptionGroup').attr('style','')
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
              document.querySelector("#selectedCountry").textContent = selectedCountry.name;
                document.querySelector("#dialCode").textContent = '+' + countryCode;
              input.value = '+' + countryCode;
              });
          });
      });

        function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("table_id");
            tr = table.getElementsByTagName("tr");
            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        const today = new Date().toISOString().split('T')[0];
        const dateValidationInput = document.getElementById('dateValidation');
        const dateValidationInputFin = document.getElementById('dateValidationInputFin');
        dateValidationInput.min = today;
        dateValidationInputFin.min = today;
  </script>
@stack('scripts')
