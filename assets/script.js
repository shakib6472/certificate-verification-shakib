jQuery(document).ready(function ($) {
    $('#certsearchbutton').click(function (e) {
        $('.pre-loader').css('display', 'flex'); // Show the pre-loader
        $('.cvs .popup-section').css('display', 'none');
        $('.cvs .popup-section .success').css('display', 'none');
        $('.cvs .popup-section .error').css('display', 'none');
        e.preventDefault();
        var certId = $('#insertedcertID').val();
        if (certId.length < 1) {
            $('.pre-loader').css('display', 'none'); // Hide the pre-loader 
            alert('Please enter a certificate ID to search!');

        } else {
            $.ajax({
                type: 'POST',
                url: cvs_ajax.ajax_url, // WordPress AJAX URL provided via wp_localize_script
                data: {
                    action: 'verify_certificate', // Action hook to handle the AJAX request in your functions.php
                    certId: certId, // Pass the certificate ID to the backend
                },
                dataType: 'json',
                success: function (response) {
                    $('.pre-loader').css('display', 'none'); // Hide the pre-loader 
                    console.log(response);
                    // Handle success response
                    if (response.success) {
                        var certificateData = response.data;
                        $('#certificateID').text(certificateData.certificate_id);
                        $('#certificateName').text(certificateData.student_name);
                        $('#certificateDate').text(certificateData.certificate_date); 
                        url = cvs_ajax.home_url + 'tutor-certificate?cert_hash=' + certificateData.certificate_id + '&regenerate=1';
                        $('.view-certificate').attr('href', url);
                        $('.cvs .popup-section').css('display', 'block');
                        $('.cvs .popup-section .success').css('display', 'block');

                    } else {
                        // Handle error response
                        $('.cvs .popup-section').css('display', 'block');
                        $('.cvs .popup-section .error').css('display', 'block');
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    $('.pre-loader').css('display', 'none'); // Hide the pre-loader 
                    // Handle error
                    $('.cvs .popup-section').css('display', 'block');
                    $('.cvs .popup-section .error').css('display', 'block');
                }
            });
        }
    });
});