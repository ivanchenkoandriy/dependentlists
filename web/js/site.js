const app = (function ($) {
    let brandId = null;

    $(() => {
        $('#addcarform-model').prop('disabled', true);
    });

    return {
        setBrandId(newBrandId) {
            brandId = newBrandId;
            if (brandId) {
                $('#addcarform-model').prop('disabled', false);
            } else {
                $('#addcarform-model').prop('disabled', true);
            }

            $('#addcarform-model').val(null).trigger('change');
        },
        getBrandId() {
            return brandId;
        }
    };
})(jQuery);