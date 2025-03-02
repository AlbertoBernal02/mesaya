"use strict";

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete-button").forEach(button => {
        button.addEventListener("click", function () {
            let deleteUrl = this.getAttribute("data-url");
            let deleteForm = document.getElementById("deleteForm");
            deleteForm.setAttribute("action", deleteUrl);
        });
    });
});

