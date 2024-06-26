<!-- REQUIRED SCRIPTS -->

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/selectize@0.12.6/dist/js/standalone/selectize.min.js"></script>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

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


<!-- FLOT CHARTS -->
<script src="{{ asset('plugins/flot/jquery.flot.js') }}"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{ asset('plugins/flot/plugins/jquery.flot.resize.js') }}"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="{{ asset('plugins/flot/plugins/jquery.flot.pie.js') }}"></script>

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
        $('#search_filter').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('#result tr').filter(function() {
                $(this).toggle(
                    $(this).text().toLowerCase().indexOf(value) > -1
                );
            });
        });
    });
</script>

<script>
    $(document).ready(function() {

        if ($('#certify').is(':checked')) {
            $('#condition').show();
        } else {
            $('#condition').hide();
        }

        $('#certify').on('change', function() {
            console.log('hello');
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




        let index = $('.reponse').length;

        function addAnswer() {
            index++;
            let newAnswer = `

                <div class="form-group reponse">
                    <label for="awnser_${index}" class="answer_label">The response ${index}</label>
                <div class="position-relative">
                    <input name="awnser[]" type="text" class="form-control response" required id="Awnser_${index}"
                        aria-label="Text input with checkbox">

                    <i class="fa fa-trash position-absolute removeBtn" 
                    style="right: 12px; color: red; bottom: 12px; z-index: 1000;"
                    aria-hidden="true"></i>
                    </div>
                </div>
            `;
            $('#addBtn').remove();

            $('#container').append(newAnswer);
        }

        $(document).on('click', '#addBtn', function() {
            addAnswer();
            let addButton =
                `  <button id="addBtn" type="button" class="btn btn-primary">Add Response</button>
              `;
            $('#container').append(addButton);
        });

        $(document).on('click', '.removeBtn', function() {
            $(this).closest('.reponse').remove();
            index--;

            $('.reponse').each(function(index) {
                $(this).find('.answer_label').text(`Réponse ${index + 1}`);
            });
        });


        //add response on loop

        // Add response
        $(document).ready(function() {
            // Add response
            $(document).on('click', '.addBtn', function() {
                let quizId = $(this).data('quiz-id');
                let quizIndex = $(this).data('quiz-index');
                let container = $(`#container-${quizId}`);
                let index = container.data('index');

                index++;
                container.data('index', index);

                let newAnswer = `
                    <div class="form-group reponse">
                        <label for="answer_${quizId}_${index}" class="answer_label">Response ${index +1}</label>
                        <div class="position-relative">
                            <input name="answer[]" type="text" class="form-control response" id="answer_${quizId}_${index}" aria-label="Text input with checkbox">
                            <i class="fa fa-trash position-absolute removeBtn" style="right: 12px; color: red; bottom: 12px; z-index: 1000;" aria-hidden="true"></i>
                        </div>
                    </div>
                `;

                // Append the new answer and move the button to the end
                container.append(newAnswer);

                // Move the "Add Response" button to the end
                let addButton = $(this).detach();
                container.append(addButton);
            });

            // Remove response
            $(document).on('click', '.removeBtn', function() {
                let quizId = $(this).closest('.quiz-container').data('quiz-id');
                let container = $(`#container-${quizId}`);
                let index = container.data('index');

                $(this).closest('.reponse').remove();
                container.data('index', --index);

                // Update labels
                container.find('.reponse').each(function(index) {
                    $(this).find('.answer_label').text(`Response ${index + 1}`);
                });
            });
        });


        //Question type



        let Question = $('.Question').length;

        function addQuestion() {
            Question++;
            let newQuestion = `
                <div class="form-group response">
                <label for="Question_${Question}" class="Question_label">Question ${Question}</label>
                <div class="position-relative">
                    <input name="question[]" type="text" class="form-control Question" id="Question_${Question}" aria-label="Text input with checkbox" required>
                    <i class="fa fa-trash position-absolute removeQuestion" style="right: 12px; color: red; bottom: 12px; z-index: 1000;" aria-hidden="true"></i>
                </div>
                </div>
                `;
            $('#addQuestion').remove();
            $('#containerQuestion').append(newQuestion);
        }

        $(document).on('click', '#addQuestion', function() {
            addQuestion();
            let addButton =
                `<button id="addQuestion" type="button" class="btn btn-primary">Add Question</button>`;
            $('#containerQuestion').append(addButton);
        });

        $(document).on('click', '.removeQuestion', function() {
            $(this).closest('.form-group').remove();
            Question--;

            $('.Question').each(function(index) {
                $(this).closest('.form-group').find('.Question_label').text(
                    `Question ${index + 1}`);
            });
        });

    });

    // Function to fetch notifications from user notification route
    function fetchNotifications() {
        var notificationUrl = '{{ route('notification.user') }}';
        var allNotificationsUrl = '{{ route('notification.index') }}';

        if (notificationUrl.startsWith('http://') || allNotificationsUrl.startsWith('http://')) {
            notificationUrl = notificationUrl.replace('http://', 'https://');
            allNotificationsUrl = allNotificationsUrl.replace('http://', 'https://');
        }

        $.ajax({
            url: notificationUrl,
            method: 'GET',
            success: function(data) {
                var notificationsContainer = $('#dropdown-menu');
                var notificationCount = $('#notification-count');
                notificationsContainer.empty();

                notificationsContainer.append('<span class="dropdown-item dropdown-header">' + data.length +
                    ' Notifications</span>');
                notificationCount.append('<span class="badge badge-warning navbar-badge">' + data.length +
                    '</span>');

                // Define the max number of notifications to show
                var maxNotificationsToShow = 5;

                // Loop through notifications
                for (var i = 0; i < Math.min(data.length, maxNotificationsToShow); i++) {
                    var notification = data[i];
                    var itemTitle = notification.data.itemTitle
                    var truncatedTitle = itemTitle.length > 20 ? itemTitle.slice(0, 20) + '…' : itemTitle;
                    var url = '';

                    if (notification.data.itemType == 'content') {
                        url = '{{ route('content.show', ['content' => ':notification.data.itemId']) }}';
                        url = url.replace(':notification.data.itemId', notification.data.itemId);
                    } else if (notification.data.itemType == 'user') {
                        url = '{{ route('profile.edit', ['id' => ':notification.data.itemId']) }}';
                        url = url.replace(':notification.data.itemId', notification.data.itemId);
                    }

                    var notificationHtml = `
                    <div class="dropdown-divider"></div>
                    <div class="notification-item d-flex justify-content-between align-items-center p-2">
                        <a href="${url}" class="dropdown-item flex-grow-1 text-decoration-none text-dark">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle text-primary mr-2"></i> <!-- Optional icon -->
                                <div>
                                    <div class="font-weight-bold text-truncate">${notification.data.itemMessage}</div>
                                    <div class="small text-muted text-truncate">${truncatedTitle}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                `;
                    notificationsContainer.append(notificationHtml);
                }

                // Add a footer (optional)
                notificationsContainer.append(
                    '<div class="dropdown-divider"></div><a href=' + allNotificationsUrl +
                    ' class="dropdown-item dropdown-footer">See All Notifications</a>'
                );

            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }

    // Fetch notifications on page load
    $(document).ready(function() {
        fetchNotifications();
        setInterval(fetchNotifications, 10000);
    });
</script>


