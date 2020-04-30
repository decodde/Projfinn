<script src="{{ asset('assets/app-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
<<script src="{{ asset('assets/app-assets/vendors/js/extensions/jquery.steps.min.js') }}" type="text/javascript"></script>
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
<script type="text/javascript">

    $("a[href$='#next']").click(function() {
        let units = $('#units').val();
        let uA = $('#unitAmount').val();
        console.log(units);

        let n = numeral(uA * units);

        $('#amountInput').val(uA * units);

        $('#unitsS').text(units +" units");
        $('#amount').text(n.format('0,0'));
    });
</script>
