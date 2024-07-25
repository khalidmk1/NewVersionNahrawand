<script>
    $(document).ready(function() {

                $(".make_permission").off('change').on('change' ,function(e) {
                    e.preventDefault()

                    var roleId = $(this).attr("data-roleId");
                    var permissionId = $(this).attr("data-permissionId");
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


                    $.ajax({
                        url: '/dashboard/role/' + roleId + '/' + permissionId,
                        method: 'POST',
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        },
                        success: function(response) {
                            console.log(response);

                        },
                        error: function(error) {
                            console.log(error);
                        }

                    })

                });
            })
</script>
