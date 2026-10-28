/*
Web Development Assignment
Group 5
Members:
	Muhammad Noorur Rashiq bin Abuzar (B20250386)
	Muhammad Haziq Syazani bin Hasroni (B20250360)
	Awangku Ahmad Rasyid bin Pg Saiful Rizal (B20250033)
*/

document.addEventListener("DOMContentLoaded", function () {
    // 1. Admin Dashboard: Confirmation prompt before deleting customer records
    const deleteLinks = document.querySelectorAll(".delete-btn");
    
    deleteLinks.forEach(function (link) {
        link.addEventListener("click", function (event) {
            const confirmed = confirm("Are you sure you want to permanently delete this customer record?");
            if (!confirmed) {
                event.preventDefault(); // Stop the deletion if the user cancels
            }
        });
    });

    // 2. Contact/Order Form Validation (if present on the page)
    const orderForm = document.querySelector("form.order-form, form.contact-form");
    
    if (orderForm) {
        orderForm.addEventListener("submit", function (event) {
            const quantityInput = document.querySelector("input[name='quantity']");
            const emailInput = document.querySelector("input[name='email']");

            // Validate quantity is at least 1
            if (quantityInput && quantityInput.value < 1) {
                alert("Please select a quantity of at least 1.");
                quantityInput.focus();
                event.preventDefault();
                return;
            }

            // Simple email '@' symbol check
            if (emailInput && !emailInput.value.includes("@")) {
                alert("Please enter a valid email address containing '@'.");
                emailInput.focus();
                event.preventDefault();
                return;
            }
        });
    }
});