<script type="text/javascript">
    function deleteConfirmation(id){
        swal({
            title: "Delete",
            text: "Are you sure you want to delete?",
            type: "error",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButton: !0
        }).then(function(e){
            if(e.value === true){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "{{ url('/management/categories') }}/" + id,
                    date: {_toke: CSRF_TOKEN},
                    dateType: 'JSON',
                    success: function (results){
                        if(results.success ===true){
                            swal("Done!", results.message, "success");
                        }else{
                            swal("Error!", results.message, "error");
                        }
                    }
                });
            }else{
                e.dismiss;
            }
        }, function(dismiss){
            return false;
        })
    }
</script>