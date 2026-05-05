setTimeout(() => {
    document.querySelectorAll(".alert").forEach((el) => {
        el.classList.add("hide");
        setTimeout(() => el.remove(), 600);
    });
}, 3000);
