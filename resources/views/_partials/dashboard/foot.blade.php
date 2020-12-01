<script src="{{ asset('assets/app-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/vendors/js/extensions/jquery.steps.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/vendors/js/ui/headroom.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/vendors/js/extensions/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/vendors/js/charts/echarts/echarts.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/vendors/js/charts/raphael-min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/vendors/js/charts/morris.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/js/core/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/js/scripts/pages/dashboard-crypto.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/js/scripts/pages/dashboard-sales.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/js/scripts/forms/wizard-steps.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/js/scripts/numeral/numeral.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/assets/vendors/jquery.min.js') }}"></script>
<script src="{{ asset('assets/assets/js/theme.js') }}"></script>
<script src="{{ asset('assets/assets/js/theme-vendors.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script>
    $('#getAmt').on('submit', function (e) {
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
                    window.location.href = "{{URL('/investment/success')}}?message="+response.message;
                } else {
                    console.log(response);
                    window.location.href = "{{URL('/investment/danger')}}?message="+response.message;
                }

            },
        });
    });
</script>
<script>
    function withdrawInv(investment) {
        var interstSofar;
        if(investment.oldInv == 1){
            interstSofar = investment.roi;
        }
        else{
            interstSofar = ((investment.diffDays / (investment.daySS-1)) * investment.roi);
        }

        $('#payOut').modal('show');

        $('#investmentId').val(investment.id);

        var rad = $('.rads');
        for (var i = 0; i < rad.length; i++) {
            rad[i].addEventListener('change', function() {
                if(this.value === "interest"){
                    $('#withAmt').text(numeral(parseInt(interstSofar)).format('0,0.00'))
                }else{
                    $('#withAmt').text(numeral(parseInt(interstSofar)+parseInt(investment.amount)).format('0,0.00'))
                }
            });
        }
    }
</script>
