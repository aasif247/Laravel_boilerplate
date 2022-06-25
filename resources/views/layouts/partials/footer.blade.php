{{--
    * Author           :         System Decoder
    * App Version      :         1.0.0
    * Email            :         contact@systemdecoder.com
    * Author URL       :         https://www.systemdecoder.com
--}}
<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                &copy;Copyright {{ \Carbon\Carbon::now()->format('Y') }} | All right Reserved
            </div>
            <div class="col-md-6">
                <div class="text-md-end footer-links d-none d-sm-block">
                    Developed By <a href="{{ config('admin.developer_url') }}" class="link_confirmation" target="_blank">{{ config('admin.developer_by') }}</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->
