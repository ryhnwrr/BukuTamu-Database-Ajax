function showForm(formID) {
    document.querySelectorAll(".form").forEach(form => form.classList.remove("active"));
    document.getElementById(formID).classList.add("active");
}