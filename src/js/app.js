function handleFormSubmission(formId) {
    const form = document.getElementById(formId);
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission behavior

        const formData = new FormData(this); // Collect form data
        const actionUrl = form.action;
        // Use fetch to send form data to the server
        fetch(actionUrl, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                return response.text();
            } else {
                throw new Error('Network response was not ok.');
            }
        })
        .then(data => {
            // Show success message and reset the form
            //document.getElementById('statusMessage').textContent = 'Your message was successfully submitted!';
            form.reset(); // Reset the form after successful submission
        })
        .catch(error => {
            // Show error message if the submission fails
            //document.getElementById('statusMessage').textContent = 'There was a problem with your submission. Please try again later.';
        });
    });
}

// Usage: Call the function to handle form submission
handleFormSubmission('contact-form');
