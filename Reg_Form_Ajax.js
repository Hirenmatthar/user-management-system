$(document).ready(function () {
    // Form submit event handler
    $("#regForm").on("submit", function (e) {
      e.preventDefault(); // Prevent the form from submitting traditionally

      // Validate form inputs (same validation as before)

      // Create an object to hold the form data
      var formData = {
        name: $("#name").val().trim(),
        role: $("#role").val(),
        email: $("#email").val().trim(),
        address: $("#address").val().trim(),
        phone: $("#phone").val().trim(),
        password: $("#password").val().trim(),
      };

      // Send the AJAX request
      $.ajax({
        url: "submit_reg.php", // PHP script to handle the form submission
        type: "POST",
        data: formData,
        success: function (response) {
          // Handle the response from the PHP script
          console.log(response);
          alert("Added Successfully!...");
          // You can update the page content or show a success message here
        },
        error: function (xhr, status, error) {
          // Handle errors, if any
          console.error(error);
          // You can show an error message or handle the error as needed
        },
      });
    });
  });