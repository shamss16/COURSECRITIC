// document.getElementById('review-form').addEventListener('submit', function (event) {
//     event.preventDefault(); // Prevent the form from submitting the default way

//     const form = event.target;
//     const formData = new FormData(form);

//     fetch('submit.php', {
//         method: 'POST',
//         body: formData
//     })
//         .then(response => response.text())
//         .then(data => {
//             alert('Thank you for submitting your review!');
//             form.reset(); // Reset the form fields
//             window.location.href = 'submit.html'; // Redirect to the same page
//         })
//         .catch(error => {
//             console.error('Error:', error);
//             alert('Failed to submit review. Please try again.');
//         });
// });

document.getElementById('review-form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent the form from submitting the default way

    const form = event.target;
    const formData = new FormData(form);

    fetch('submit.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            alert('Thank you for submitting your review!');
            form.reset(); // Reset the form fields
            // window.location.href = 'submit.html'; // Removed redirection to the same page
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to submit review. Please try again.');
        });
});



