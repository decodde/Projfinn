<script>
    var KTAppOptions = {"colors":{"state":{"brand":"#5d78ff","dark":"#282a3c","light":"#ffffff","primary":"#5867dd","success":"#34bfa3","info":"#36a3f7","warning":"#ffb822","danger":"#fd3995"},"base":{"label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],"shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};
</script>

<script src="{{ asset('assets/admin/vendors/global/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/demo1/scripts.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/vendors/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script>
<script src="http://maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
<script src="{{ asset('assets/admin/vendors/custom/gmaps/gmaps.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/demo1/pages/dashboard.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/demo1/pages/custom/apps/user/list-datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/assets/vendors/jquery.min.js') }}"></script>
<script>
    $('#type').click(function(){
        $d_val = $('#type').val();
        if($d_val == "debit"){
            $('#porfolio').show();
        }else {
            $('#porfolio').hide();
        }
    })
</script>
<script>
    $('#getValidation').on('submit', function (e) {
        e.preventDefault();

        var that = $(this), url = that.attr('action'), type = that.attr('method');
        var csrf = $('#_token');
        // var amount = $('#amount').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrf.val(),
            }
        });

        $('#inactiveBtn').show();
        $('#activeBtn').hide();

        $.ajax({
            url: url,
            type: type,
            data: new FormData(this),
            contentType: false,
            processData: false,

            success: function (response) {
                $('#inactiveBtn').hide();
                $('#activeBtn').show();
                if (response.error === false) {
                    $('#errorSuccess').show();
                    $('#errorSuccessMessage').text(response.message);
                    $('#first_name').val(response.data.first_name);
                    $('#last_name').val(response.data.last_name);
                    setTimeout(function() {
                        $('#errorSuccess').fadeOut('slow');
                    }, 1000);
                } else {
                    $('#errorDanger').show();
                    $('#errorDangerMessage').text(response.message);
                    setTimeout(function() {
                        $('#errorDanger').fadeOut('slow');
                    }, 1000);
                }

            }
        });
    });
</script>
