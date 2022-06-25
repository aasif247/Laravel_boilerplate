/*
     * Author           :         System Decoder
     * App Version      :         1.0.0
     * Email            :         contact@systemdecoder.com
     * Author URL       :         https://www.systemdecoder.com
*/

$('.showCalRanges').daterangepicker(defaultDateRangeSettings, function () {
    user_dt.draw();
});

let user_dt = $('#user_datatable').DataTable({
    ajax: {
        url: 'users',
        data: function (d) {
            if ($('.showCalRanges').val()) {
                d.start_date = $('.showCalRanges').data('daterangepicker').startDate.format('YYYY-MM-DD');
                d.end_date = $('.showCalRanges').data('daterangepicker').endDate.format('YYYY-MM-DD');
            }
        }
    },
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false},
        {data: 'name', name: 'name'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});
