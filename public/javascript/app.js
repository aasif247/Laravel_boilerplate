/*
     * Author           :         System Decoder
     * App Version      :         1.0.0
     * Email            :         contact@systemdecoder.com
     * Author URL       :         https://www.systemdecoder.com
*/

// Default jquery ajax setup
$.ajaxSetup({
    beforeSend: function (jqXHR, settings) {
        if (!is_online()) {
            toastr.error("You're not connected to a Network");
            return false;
        }
        if (settings.url.indexOf('http') === -1) {
            // application_url is application url
            settings.url = application_url + '/' + settings.url;
        }
    },
});

function is_online() {
    return window.navigator.onLine;
}

// Default file input
$('.dropify').dropify({
    messages: {
        default: "Drop File Here",
        replace: "Replace File",
        remove: "Remove File",
        error: "Error File"
    }
});

//Default Datatable Structure
jQuery.extend($.fn.dataTable.defaults, {
    processing: true,
    serverSide: true,
    responsive: true,
    fixedHeader: true,
    iDisplayLength: display_record_per_page,
    order: [[1, 'desc']],
    lengthMenu: [[display_record_per_page, display_record_per_page * 3, display_record_per_page * 6, display_record_per_page * 9, display_record_per_page * 12, display_record_per_page * 15, display_record_per_page * 30, -1], [display_record_per_page, display_record_per_page * 3, display_record_per_page * 6, display_record_per_page * 9, display_record_per_page * 12, display_record_per_page * 15, display_record_per_page * 30, "All"]],
    language: {
        paginate: {
            previous: "<i class='mdi mdi-chevron-left'>",
            next: "<i class='mdi mdi-chevron-right'>"
        }
    },
    drawCallback: function() {
        $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
    }
});

//Default settings for daterange Picker
let ranges = {};
ranges['Today'] = [moment(), moment()];
ranges['Yesterday'] = [moment().subtract(1, 'days'), moment().subtract(1, 'days')];
ranges['Last 7 Days'] = [moment().subtract(6, 'days'), moment()];
ranges['Last 15 Days'] = [moment().subtract(14, 'days'), moment()];
ranges['Last 30 Days'] = [moment().subtract(29, 'days'), moment()];
ranges["Last 3 Months"] = [moment().subtract(3, 'month'), moment()];
ranges["Last 6 Months"] = [moment().subtract(3, 'month'), moment()];
ranges["Last 9 Months"] = [moment().subtract(9, 'month'), moment()];
ranges['This Month'] = [moment().startOf('month'), moment().endOf('month')];
ranges["Last Month"] = [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')];
ranges['This Year'] = [moment().startOf('year'), moment().endOf('year')];
ranges["Last Year"] = [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')];

let defaultDateRangeSettings = {
    ranges: ranges,
    startDate: moment().startOf('year'),
    endDate: moment().endOf('year'),
    locale: {
        cancelLabel: 'Clear',
        applyLabel: 'Apply',
        customRangeLabel: 'Custom Date Range',
        format: moment_date_format,
        toLabel: '~',
    },
};

// Default Delete
$(document).on('click', '.delete_button', function () {
    if (notification_sound === 1) {
        let audio = $('#sureAudio')[0];
        if (audio !== undefined) {
            audio.play();
        }
    }
    swal({
        title: 'Are you sure?',
        text: "You can't revert this action!",
        confirmButtonText: 'Yes, delete it!',
        icon: 'warning',
        buttons: true,
        focusConfirm: true,
        dangerMode: true,
        showCancelButton: true,
    }).then(willDelete => {
        if (willDelete.value === true) {
            let href = $(this).data('href');
            let tname = $(this).data('tname');
            let data = $(this).serialize();
            $.ajax({
                method: 'DELETE',
                url: href,
                dataType: 'json',
                data: data,
                success: function (result) {
                    if (result.success === true) {
                        toastr.success(result.msg);
                        let table_name = $('#' + tname).DataTable();
                        table_name.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
                error: function (response) {
                    let errors = response.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        toastr.error(value[0]);
                    });
                }
            });
        }
    });
});

// Default status change
$(document).on('click', '.status_change_button', function () {
    if (notification_sound === 1) {
        let audio = $('#sureAudio')[0];
        if (audio !== undefined) {
            audio.play();
        }
    }
    swal({
        title: 'Are you sure?',
        text: "You can't revert this action!",
        confirmButtonText: 'Yes, Change status!',
        icon: 'warning',
        buttons: true,
        focusConfirm: true,
        dangerMode: true,
        showCancelButton: true,
    }).then(willChange => {
        if (willChange.value === true) {
            let href = $(this).data('href');
            let tname = $(this).data('tname');
            let data = $(this).serialize();
            $.ajax({
                method: 'POST',
                url: href,
                dataType: 'json',
                data: data,
                success: function (result) {
                    if (result.success === true) {
                        toastr.success(result.msg);
                        let table_name = $('#' + tname).DataTable();
                        table_name.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
                error: function (response) {
                    let errors = response.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        toastr.error(value[0]);
                    });
                }
            });
        }
    });
});

//Play notification sound on success, error and warning
if (notification_sound === 1) {
    toastr.options.onShown = function () {
        if ($(this).hasClass('toast-success')) {
            let audio = $('#successToast')[0];
            if (audio !== undefined) {
                audio.play();
            }
        } else if ($(this).hasClass('toast-error')) {
            let audio = $('#errorToast')[0];
            if (audio !== undefined) {
                audio.play();
            }
        } else if ($(this).hasClass('toast-warning')) {
            let audio = $('#warningToast')[0];
            if (audio !== undefined) {
                audio.play();
            }
        } else if ($(this).hasClass('toast-info')) {
            let audio = $('#infoToast')[0];
            if (audio !== undefined) {
                audio.play();
            }
        }
    };
}

//Ask for confirmation for links
$(document).on('click', 'a.link_confirmation', function (e) {
    e.preventDefault();
    swal({
        title: 'Are you sure?',
        text: "You are redirect to this another website!",
        confirmButtonText: 'Yes, go to link!',
        icon: 'warning',
        buttons: true,
        focusConfirm: true,
        dangerMode: true,
        showCancelButton: true,
    }).then(confirmed => {
        if (confirmed.value === true) {
            window.location.href = $(this).attr('href');
        }
    });
});

// default modal
$(document).on('click', '.btn-modal', function (e) {
    e.preventDefault();
    let container = $(this).data('container');
    $.ajax({
        url: $(this).data('href'),
        dataType: 'html',
        success: function (result) {
            $(container).html(result).modal('show');
        },
    });
});
