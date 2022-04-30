<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add-Patrimoine | Gestion de Parimoine</title>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>


  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css')  }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css')  }}">

  <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css')  }}">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Proposer un Patrimoine</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <form action="saveP" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
      <section class="content">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Generalite</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="inputName">Nom :</label>
                  <input type="text" id="nompat" name="nompat" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputDescription">Description :</label>
                  <textarea id="inputDescription" name="descpat" class="form-control" rows="4"></textarea>
                </div>
                <div class="form-group">
                  <label for="inputStatus">Type de Patrimoine</label>
                  <select id="inputStatus" class="form-control custom-select" name="typepat">
                    <option selected disabled>Select one</option>
                    <option>Maison d'habitation</option>
                    <option>Monument</option>
                    <option>Imeuble</option>
                    <option>Route</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputClientCompany">Entreprise realisateur</label>
                  <input type="text" id="inputClientCompany" class="form-control" name="entpat">
                </div>
                <div class="form-group">
                  <label for="inputProjectLeader">Chef d'equipe</label>
                  <input type="text" id="inputProjectLeader" class="form-control" name="chfequippat">
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">Image</label>
                  <div class="input-group">
                      <div class="custom-file">
                      <input type="file" name="imgpat" class="form-control" for="exampleInputFile"/>
                      </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputFile">Plan de construction</label>
                  <div class="input-group">
                      <div class="custom-file">
                      <input type="file" name="planfilepat" class="form-control" for="exampleInputFile"/>
                      </div>
                  </div>
                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-6">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Coordonnees</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="inputProjectLeader">Pays</label>
                  <input type="text" id=" " class="form-control" name="payspat">
                </div>
                <div class="form-group">
                  <label for="inputProjectLeader">Ville</label>
                  <input type="text" id=" " class="form-control" name="villepat">
                </div>
                <!-- Date range -->
                <div class="form-group">
                  <label>Echeance de realisation:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" id="reservation"  name="echeancepat">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEstimatedBudget">latitude</label>
                  <input type="number" step="any" id="lat" class="form-control" name="lat">
                </div>
                <div class="form-group">
                  <label for="inputSpentBudget">Longitude</label>
                  <input type="number" step="any" id="lng" class="form-control" name="lng">
                </div>
                <!-- maps -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div id="map" style="height:400px; width: 100%;" class="my-3"></div>
          </div>
          
        </div>
        
        <script>
           // Initialize and add the map
          function initMap() {
            // The location of Uluru
            const uluru = { lat: -25.344, lng: 131.031 };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
              zoom: 4,
              center: uluru,
              scrollwheel: true,
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
              position: uluru,
              map: map,
              draggable: true
            });

            google.maps.event.addListener(marker,'position_changed',
                    function (){
                        let lat = marker.position.lat()
                        let lng = marker.position.lng()
                        $('#lat').val(lat)
                        $('#lng').val(lng)
                })

                google.maps.event.addListener(map,'click',
                function (event){
                    pos = event.latLng
                    marker.setPosition(pos)
                })
          }

          // window.initMap = initMap;
        </script>
        
        <script async
            src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap">
        </script>

        <div class="row">
          <div class="col-12">
            <a href="#" class="btn btn-secondary">Annuler</a>
            <input type="submit" value="Soumettre" class="btn btn-success float-right">
          </div>
        </div>
      </section>
    </form>
    <!-- /.content -->
  </div>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js')  }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')  }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js')  }}"></script>
<!-- date-range-picker -->

<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js')  }}"></script>
<script src="{{ asset('assets/plugins/moment/moment.min.js')  }}"></script>
<script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js')  }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js')  }}"></script>
<script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')  }}"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'DD/MM/YYYY hh:mm A'
      }
    });
    

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script>
</body>
</html>
