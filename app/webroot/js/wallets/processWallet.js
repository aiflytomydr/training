var Wallets = function () {

    var processAddWallet = function () {
        $('#btnWalletAdd').click(function () {
            $(this).val('Please waitting...');
            $(this).attr('disabled', true);
            $('#WalletAddForm').submit();
        });
    };

    var previewIcon = function () {

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var fileType = input.files[0]['type'];

                if (fileType !== 'image/jpeg'
                        && fileType !== 'image/jpg'
                        && fileType !== 'image/gif'
                        && fileType !== 'image/png') {
                    return false;
                }

                reader.onload = function (e) {
                    $('.wl-icon-preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#WalletIcon").change(function () {
            readURL(this);
        });
    };

    return{
        init: function () {
            processAddWallet();
            previewIcon();
        }
    };
}();

