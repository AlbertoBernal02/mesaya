import './bootstrap';


document.addEventListener("DOMContentLoaded", function () {
    fetch('/categories')
        .then(response => response.json())
        .then(data => {
            let select = document.getElementById("categories_id");
            select.innerHTML = '<option value="">Selecciona una categoría</option>';
            data.forEach(category => {
                let option = document.createElement("option");
                option.value = category.id;
                option.textContent = category.name;
                select.appendChild(option);
            });
        })
        .catch(error => console.error("Error al cargar las categorías:", error));
});

