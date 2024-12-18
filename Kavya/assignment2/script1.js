
    // form validation
    document.getElementById("registrationForm").addEventListener("submit", function(event) {
        
        // Check for required fields
        var requiredFields = document.querySelectorAll("input[required], select[required]");
        var formIsValid = true;

        requiredFields.forEach(function(field) {
            if (!field.value) {
                formIsValid = false;
                field.style.borderColor = "red"; // Highlight missing fields
            } else {
                field.style.borderColor = ""; // Reset border color
            }
        });

        
        if (!formIsValid) {
            alert("Please fill in all required fields!");
            event.preventDefault();
        }
    });

