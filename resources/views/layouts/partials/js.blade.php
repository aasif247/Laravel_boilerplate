{{--
    * Author           :         System Decoder
    * App Version      :         1.0.0
    * Email            :         contact@systemdecoder.com
    * Author URL       :         https://www.systemdecoder.com
--}}

<script type="text/javascript">
    application_url = "{{ env('APP_URL', 'https://www.systemdecoder.com') }}";
    notification_sound = {{ sd_application_setting('notification_sound') }};
</script>

<!-- Vendor js -->
<script src="{{ asset('admin_panel/js/vendor.min.js?v='. $version) }}"></script>

@php
    $business_date_format = sd_application_setting('date_format');
    $datepicker_date_format = str_replace('d', 'dd', $business_date_format);
    $datepicker_date_format = str_replace('m', 'mm', $datepicker_date_format);
    $datepicker_date_format = str_replace('Y', 'yyyy', $datepicker_date_format);
    $moment_date_format = str_replace('d', 'DD', $business_date_format);
    $moment_date_format = str_replace('m', 'MM', $moment_date_format);
    $moment_date_format = str_replace('Y', 'YYYY', $moment_date_format);
    $business_time_format = sd_application_setting('time_format');
    $moment_time_format = 'HH:mm';
    if($business_time_format == 12){
        $moment_time_format = 'hh:mm A';
    }
@endphp
<script type="text/javascript">
    let display_record_per_page = "{{ sd_application_setting('display_record_per_page') }}";
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        @if(config('app.debug') == false)
            $.fn.dataTable.ext.errMode = 'throw';
        @endif
    });

    let datepicker_date_format = "{{ $datepicker_date_format }}";
    let moment_date_format = "{{ $moment_date_format }}";
    let moment_time_format = "{{ $moment_time_format }}";
</script>


<script src="{{ asset('admin_panel/libs/datatables.net/js/jquery.dataTables.min.js?v='. $version) }}"></script>
<script src="{{ asset('admin_panel/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js?v='. $version) }}"></script>
<script src="{{ asset('admin_panel/libs/datatables.net-responsive/js/dataTables.responsive.min.js?v='. $version) }}"></script>
<script src="{{ asset('admin_panel/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js?v='. $version) }}"></script>
<script src="{{ asset('admin_panel/libs/datatables.net-buttons/js/dataTables.buttons.min.js?v='. $version) }}"></script>
<script src="{{ asset('admin_panel/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js?v='. $version) }}"></script>
<script src="{{ asset('admin_panel/libs/datatables.net-buttons/js/buttons.html5.min.js?v='. $version) }}"></script>
<script src="{{ asset('admin_panel/libs/datatables.net-buttons/js/buttons.flash.min.js?v='. $version) }}"></script>
<script src="{{ asset('admin_panel/libs/datatables.net-buttons/js/buttons.print.min.js?v='. $version) }}"></script>
<script src="{{ asset('admin_panel/libs/datatables.net-keytable/js/dataTables.keyTable.min.js?v='. $version) }}"></script>
<script src="{{ asset('admin_panel/libs/datatables.net-select/js/dataTables.select.min.js?v='. $version) }}"></script>
<script src="{{ asset('admin_panel/libs/pdfmake/build/pdfmake.min.js?v='. $version) }}"></script>
<script src="{{ asset('admin_panel/libs/pdfmake/build/vfs_fonts.js?v='. $version) }}"></script>
<!-- third party js ends -->

<!-- Picker-->
<script src="{{ asset('admin_panel/libs/pickers/js/pickadate/picker.js?v=' . $version) }}"></script>
<script src="{{ asset('admin_panel/libs/pickers/js/pickadate/picker.date.js?v=' . $version) }}"></script>
<script src="{{ asset('admin_panel/libs/pickers/js/daterange/moment.min.js?v=' . $version) }}"></script>
<script src="{{ asset('admin_panel/libs/pickers/js/daterange/daterangepicker.js?v=' . $version) }}"></script>

<script src="{{ asset('admin_panel/libs/dropify/js/dropify.min.js?v='. $version) }}"></script>

<script src="{{ asset('admin_panel/js/toastr.min.js?v=' . $version) }}"></script>

<script src="{{ asset('admin_panel/libs/moment/min/moment.min.js?v='. $version) }}"></script>

<script src="{{ asset('admin_panel/libs/sweetalert2/sweetalert2.all.min.js?v='. $version) }}"></script>

<script src="{{ asset('admin_panel/libs/select2/js/select2.full.min.js?v='. $version) }}"></script>

<!-- App js -->
<script src="{{ asset('admin_panel/js/app.min.js?v='. $version) }}"></script>

<script src="{{ asset('javascript/app.js?v=' . $version) }}"></script>

@yield('js_on_page')

{{-- Logout form --}}
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

@if(Session::has('message'))
    {{-- Toast JS --}}
    <script type="application/javascript">
        let type = "{{ Session::get('alert-type', 'info') }}";
        let audio = "";
        switch (type) {
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                audio = $('#infoToast')[0];
                if (audio !== undefined) {
                    audio.play();
                }
                break;
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                audio = $('#warningToast')[0];
                if (audio !== undefined) {
                    audio.play();
                }
                break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                audio = $('#successToast')[0];
                if (audio !== undefined) {
                    audio.play();
                }
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                audio = $('#errorToast')[0];
                if (audio !== undefined) {
                    audio.play();
                }
                break;
        }
    </script>
@endif

<div class="modal fade text-left w-100" data-controls-modal="dataModalShow" data-bs-backdrop="static" data-bs-keyboard="false" id="dataModalShow" tabindex="-1" role="dialog"></div>
