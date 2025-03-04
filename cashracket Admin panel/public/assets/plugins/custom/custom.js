function getQuestions(id) {
    $.ajax({
        type: "GET",
        url: $('#get-question').val()+'?quiz_id='+id,
        success: function (response) {
            $('.questions-data').html(response.data)
        },
    });
}

$('.view-withdraw').on('click', function() {
    $('.user_name').text($(this).data('name'))
    $('.points').text($(this).data('points'))
    $('.method').text($(this).data('method'))
    $('.account').text($(this).data('account'))
    $('.amount').text($(this).data('amount'))
    $('.created_at').text($(this).data('created_at'))
    var status = $(this).data('status');
    var statusText = '';
    if (status == 0) {
        statusText = `<div class="badge bg-danger">Rejected</div>`;
    } else if (status == 1) {
        statusText = `<div class="badge bg-primary">Processing</div>`;
    } else if (status == 2) {
        statusText = `<div class="badge bg-warning">Pending</div>`;
    } else if (status == 3) {
        statusText = `<div class="badge bg-success">Approved</div>`;
    }
    $('.status').html(statusText)
    $('#withdraw-view-modal').modal('show');
});

$('.type').on('change', function() {
    let val = $(this).val();
    if (val == 'video') {
        $('.video').removeClass('d-none');
        $('.video_link').addClass('d-none');
    } else {
        $('.video').addClass('d-none');
        $('.video_link').removeClass('d-none');
    }
});

$('#paid_status').on('change', function() {
    $('input[name="free_or_paid"]').val('');
    if ($(this).val() == 1) {
        $('.free_or_paid').removeClass('d-none');
    } else {
        $('.free_or_paid').addClass('d-none');
    }
});