
const form = document.querySelector("#form");
const list = document.querySelector("#list");
const showForm = document.querySelector("#show-form");

showForm.addEventListener("click", () =>{
    form.classList.toggle("hidden");
});

fetch("../backend/api.php")
    .then((response) => response.json())
    .then((properties) => {
        properties.forEach((property) => {
            list.innerHTML += `
                <li class="bg-white border rounded-lg p-4 shadow-sm">
                    <strong>${property.name}</strong>
                    <p class="text-sm text-gray-500">
                        ${property.description}
                    </p>
                </li>
            `;
        });
    });

form.addEventListener("submit", (e) => {
    e.preventDefault();

    fetch("../backend/api.php", {
        method: "POST",

        headers: {
            "Content-Type": "application/json",
        },

        body: JSON.stringify({
            name: document.querySelector("#name").value,
            description: document.querySelector("#description").value,
        }),
    })

    .then((response) => response.json())

    .then((property) => {
        list.innerHTML += `
            <li class="bg-white border rounded-lg p-4 shadow-sm">
                <strong>${property.name}</strong>
                <p class="text-sm text-gray-500">
                    ${property.description}
                </p>
            </li>
        `;

        form.reset();
        form.classList.add("hidden");
    });
});
