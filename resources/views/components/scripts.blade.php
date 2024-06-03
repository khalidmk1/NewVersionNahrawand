<!-- REQUIRED SCRIPTS -->

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/selectize@0.12.6/dist/js/standalone/selectize.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>



<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- BS-Stepper -->
<script src="{{ asset('plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<!-- dropzonejs -->
<script src="{{ asset('plugins/dropzone/min/dropzone.min.js') }}"></script>


<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>







<!-- Include the necessary library/plugin for "tags input" functionality -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>


<script>
    $(function() {
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

        //Initialize Select2 Elements
        $('.select2').select2();
        $('.select3').select2();

       

        $('input[name="tags[]"]').tagsinput();

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        //Date and time picker
        $('#DateStart').datetimepicker({
            icons: {
                time: 'far fa-clock'
            }
        });
        //Date and time picker
        $('#DateEnd').datetimepicker({
            icons: {
                time: 'far fa-clock'
            }
        });

    })

    //Add text editor
    $('#compose-textarea').summernote()



    $(document).ready(function() {

        //search live for goals

        $('#souscategory_goals').on('change', function() {
            var sousCategorieId = $(this).val();
            $.ajax({
                url: '/dashboard/objectives/' + sousCategorieId,
                method: 'GET',
                success: function(response) {
                    var objectiveSelect = $('#objective_option');
                    objectiveSelect.empty();

                    console.log(response);

                    $.each(response, function(index, objective) {
                        objectiveSelect.append($('<option>', {
                            value: objective.id,
                            text: objective.name
                        }));
                    });

                    objectiveSelect.trigger('change');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching goals:', error);
                }
            });
        });




    });
</script>

<script>
    $(document).ready(function() {
        $('#condition').hide();

        $('#certifier_formation').on('change', function() {
            var certifier = $(this).val()
            console.log(certifier);
            if ($(this).is(':checked')) {
                $('#condition').slideDown();
            } else {
                $('#condition').slideUp();
            }
        });

        // Store the HTML content of the sections
        var conferenceHTML = $('#conference').html();
        var podcastHTML = $('#podcast').html();
        var formationHTML = $('#formation').html();
        var quicklyHTML = $('#quickly').html();

        // Remove all the sections
        $('#conference, #podcast, #formation , #quickly').remove();

        // Retrieve the selected value from local storage
        var selectedCoursType = localStorage.getItem('selectedCoursType');

        // If a value is found, show the corresponding section
        if (selectedCoursType) {
            $('#' + selectedCoursType).slideDown();
            $('#create_btn').show();
        }

        $('#create_btn').hide();

        // Handle change event for the select element
        $('#cours_type').on('change', function() {
            var typeCours = $(this).val();

            localStorage.setItem('selectedCoursType', typeCours);

            if (typeCours == 'select') {
                $('#create_btn').hide();
            } else {
                $('#create_btn').show();
            }

            // Hide all the sections
            $('#conference, #podcast, #formation , #quickly').slideUp('slow');



            // Remove the existing sections to avoid duplication
            $('#conference, #podcast, #formation , #quickly').remove();

            // Append the corresponding section back to the DOM
            if (typeCours === 'conference') {
                $('.appendedSection').append('<section id="conference">' + conferenceHTML +
                    '</section>');
            } else if (typeCours === 'podcast') {
                $('.appendedSection').append('<section id="podcast">' + podcastHTML + '</section>');
            } else if (typeCours === 'formation') {
                $('.appendedSection').append('<section id="formation">' + formationHTML + '</section>');
            } else if (typeCours === 'quickly') {
                $('.appendedSection').append('<section id="quickly">' + quicklyHTML + '</section>');
            }

            // Re-initialize the select2 instances
            $('.selectize').selectize();

            // Show the selected section
            $('#' + typeCours).hide().slideDown();
        });
    });
</script>