/*
     * Author           :         System Decoder
     * App Version      :         1.0.0
     * Email            :         contact@systemdecoder.com
     * Author URL       :         https://www.systemdecoder.com
*/

// Select
$('#product_status, #category_id, #created_by, #product_category_id').select2({
    placeholder: "Please Select",
    width: '100%'
});

$('select > optgroup').attr('label', 'Select any');

// Product List
$(document).on('change', '#product_status, #category_id, #created_by', function () {
    product_dt.draw();
});

$('.showCalRanges').daterangepicker(defaultDateRangeSettings, function () {
    product_dt.draw();
});

let product_dt = $('#product_datatable').DataTable({
    ajax: {
        url: 'products',
        data: function (d) {
            d.status = $('#product_status').val();
            d.category_id = $('#category_id').val();
            d.created_by = $('#created_by').val();
            if ($('.showCalRanges').val()) {
                d.start_date = $('.showCalRanges').data('daterangepicker').startDate.format('YYYY-MM-DD');
                d.end_date = $('.showCalRanges').data('daterangepicker').endDate.format('YYYY-MM-DD');
            }
        }
    },
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false},
        {data: 'product_photo_path', name: 'product_photo_path', orderable: false, searchable: false},
        {data: 'product_name', name: 'product_name'},
        {data: 'category_name', name: 'categories.category_name'},
        {data: 'sku', name: 'sku'},
        {data: 'product_price', name: 'product_price'},
        {data: 'status', name: 'status', orderable: false, searchable: false},
        {data: 'name', name: 'users.name'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});
