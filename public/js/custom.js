setTimeout(() => {
    document.querySelectorAll(".alert").forEach((el) => {
        el.classList.add("hide");
        setTimeout(() => el.remove(), 600);
    });
}, 3000);

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