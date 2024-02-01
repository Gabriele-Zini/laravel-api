import "./bootstrap";

import "~resources/scss/app.scss";
import * as bootstrap from "bootstrap";
import.meta.glob(["../img/**"]);

let buttons = document.querySelectorAll(".delete-btn");

buttons.forEach((deleteBtn) => {
    deleteBtn.addEventListener("click", function (event) {
        event.preventDefault();
        let projectTitle = this.getAttribute("data-title");
        console.log(projectTitle);

        let modalDeleteTitle = document.querySelectorAll(".project-name");

        modalDeleteTitle.forEach((element) => {
            element.innerHTML = projectTitle;
        });

        let deleteForm = this.closest("form");

        let confirmDelete = document.getElementById("confirm-delete");
        confirmDelete.addEventListener("click", function () {
            deleteForm.submit();
        });
    });
});

const previewImg = document.getElementById("preview-image");
console.log(previewImg);

let image = document.getElementById("cover_image");

if (image) {
    image.addEventListener("change", function () {
        let selectedFile = this.files[0];
        console.log(selectedFile);

        if (selectedFile) {
            let reader = new FileReader();
            reader.addEventListener("load", function () {
                previewImg.src = reader.result;
                previewImg.classList.remove("d-none");
            });
            reader.readAsDataURL(selectedFile);
        }
    });
}
