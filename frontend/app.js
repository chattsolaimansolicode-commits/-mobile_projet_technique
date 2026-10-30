const form = document.querySelector("#form");
const list = document.querySelector("#list");
const showForm = document.querySelector("#show-form");
const submitBtn = document.querySelector("#submit-btn");
const toast = document.querySelector("#toast");

// Toast: show a message for 3 seconds
function showToast(message, type) {
    const color = type === "success" ? "bg-green-600" : "bg-red-600";

    toast.innerHTML = `
        <div class="${color} text-white px-4 py-3 rounded-lg shadow-lg">
            ${message}
        </div>
    `;

    setTimeout(() => {
        toast.innerHTML = "";
    }, 3000);
}

// Loading: disable the button while waiting for the server
function setLoading(isLoading) {
    submitBtn.disabled = isLoading;
    submitBtn.textContent = isLoading ? "Enregistrement..." : "Enregistrer";
}

showForm.addEventListener("click", () => {
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

    setLoading(true);

    fetch("../backend/api.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            name: document.querySelector("#name").value,
            description: document.querySelector("#description").value
        })
    })
    .then((response) => {
        if (!response.ok) {
            throw new Error("Nom incorrect, minimum 3 caractères");
        }
        return response.json();
    })
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
        showToast("Bien ajouté avec succès", "success");
    })
    .catch((error) => {
        showToast(error.message, "error");
    })
    .finally(() => {
        setLoading(false);
    });
});