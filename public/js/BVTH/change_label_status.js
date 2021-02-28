$(document).ready(function() {
    $('.bvth-status .bvth-checkbox').click(function() {
        $('.bvth-status .label-status').html('');
        
        if ($(this).val() == 0) {
            return $('.bvth-status .label-status').html('Hiện'), $(this).val(1);
        } else {
            return $('.bvth-status .label-status').html('Ẩn'), $(this).val(0);
        }
    });
});