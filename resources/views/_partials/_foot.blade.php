<script src="{{ asset('assets/app-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/vendors/js/ui/headroom.min.js') }}" type="text/javascript"></script>
<<script src="{{ asset('assets/app-assets/vendors/js/extensions/jquery.steps.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/js/core/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/js/scripts/forms/form-login-register.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/js/scripts/forms/wizard-steps.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/js/scripts/chosen.jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app-assets/js/scripts/custom.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $("#businessTerms").modal('show');
    });
    $('#riqu').click(function() {
        $('#rqContinue').prop('disabled', !this.checked)
    });
</script>