// Ngilangin Alert
setTimeout(() => {
    document.querySelectorAll(".alert").forEach((el) => {
        el.classList.add("hide");
        setTimeout(() => el.remove(), 600);
    });
}, 3000);

// Cover Buku
document.addEventListener("DOMContentLoaded", function () {

    // REMOVE ERROR
    const inputs = document.querySelectorAll("input, textarea, select");

    inputs.forEach(input => {

        input.addEventListener("input", function () {

            this.classList.remove("is-invalid");

            let error = this.parentElement.querySelector(".text-danger");

            if (error) {

                error.style.transition = "0.2s";
                error.style.opacity = "0";

                setTimeout(() => error.remove(), 200);
            }

        });

    });

    // PREVIEW COVER
    const coverInput = document.querySelector('input[name="cover"]');
    const coverPreview = document.getElementById('coverPreview');
    const emptyCover = document.getElementById('emptyCover');

    coverInput.addEventListener('change', function (e) {

        const file = e.target.files[0];

        if (file) {

            coverPreview.src = URL.createObjectURL(file);

            coverPreview.classList.remove('d-none');

            emptyCover.classList.add('d-none');

        }

    });

});

// Ceklis Permission
$(document).ready(function () {
    if ($('.permission-page').length) {
        $('#check_all_view').on('change', function () {

            $('.permission-view')
                .prop('checked', $(this).prop('checked'))
                .trigger('change');
        });

        $('#check_all_create').on('change', function () {

            $('.permission-create')
                .prop('checked', $(this).prop('checked'))
                .trigger('change');
        });

        $('#check_all_edit').on('change', function () {

            $('.permission-edit')
                .prop('checked', $(this).prop('checked'))
                .trigger('change');
        });

        $('#check_all_delete').on('change', function () {

            $('.permission-delete')
                .prop('checked', $(this).prop('checked'))
                .trigger('change');
        });

        $('.permission-create, .permission-edit, .permission-delete')
            .on('change', function () {

                let row = $(this).closest('tr');

                if ($(this).is(':checked')) {

                    row.find('.permission-view')
                        .prop('checked', true);
                }
            });

        $('.permission-view').on('change', function () {

            let row = $(this).closest('tr');

            if (!$(this).is(':checked')) {

                row.find('.permission-create, .permission-edit, .permission-delete')
                    .prop('checked', false);
            }
        });

    }

});