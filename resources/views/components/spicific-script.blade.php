<!-- Page specific script -->
<script>
    $(function() {
        $(".example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        // Example 2: Add custom class
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "initComplete": function(settings, json) {
                $(this).closest('.dataTables_wrapper').addClass('custom-datatable');
            }
        });
    });
</script>
