<?php
require_once __DIR__ . '/includes/auth.php';
// ensure the session is started before any output
init_session();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jeweluxe - Contact Us</title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
 
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <script src="js/validation.js"></script>
 
  <link href="styles.css" rel="stylesheet">
  <style>
    /* Custom focus highlighting */
    .form-control:focus {
      border-color: #007bff !important;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
    }
    
    /* Required field validation styling */
    .form-control.is-invalid {
      border-color: #dc3545;
    }
    
    .invalid-feedback {
      display: block;
      width: 100%;
      margin-top: 0.25rem;
      font-size: 0.875em;
      color: #dc3545;
    }
    
    /* Remove browser validation styling */
    .form-control:invalid {
      box-shadow: none !important;
    }
    
    .form-control:valid {
      box-shadow: none !important;
    }
    
    /* Hide browser validation messages */
    .form-control::-webkit-validation-bubble {
      display: none !important;
    }
    
    /* Contact info styling */
    .contact-info-card {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-radius: 15px;
      padding: 2rem;
      margin-bottom: 2rem;
    }
    
    .contact-info-card i {
      font-size: 2rem;
      margin-bottom: 1rem;
      color: #ffd700;
    }
    
    .contact-form-card {
      background: white;
      border-radius: 15px;
      padding: 2rem;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
  <div class="main-content">

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
  <a class="navbar-brand text-start" href="home.php">← Jeweluxe</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
          <li class="nav-item"><span class="nav-link active" style="cursor:default;">Contact Us</span></li>
          <li class="nav-item"><a class="nav-link" href="cart.php">🛒 Cart</a></li>
          <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#accountModal">👤 Account</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="text-center text-white py-5 bg-dark" style="background:url(Video/wallpaper.jpg) center/cover no-repeat;">
    <div class="container">
      <h1 class="display-4">Contact Jeweluxe</h1>
      <p class="lead">Get in touch with us for any inquiries or support!</p>
    </div>
  </header>

  <section class="container py-5">
    <div class="row">
    
      <div class="col-lg-4 mb-4">
        <div class="contact-info-card text-center">
          <i class="fas fa-envelope"></i>
          <h4>Email Us</h4>
          <p class="mb-3">Send us an email and we'll respond within 24 hours</p>
          <a href="mailto:jeweluxe@gmail.com" class="btn btn-warning">
            <i class="fas fa-envelope me-2"></i>jeweluxe@gmail.com
          </a>
        </div>
        
        <div class="contact-info-card text-center">
          <i class="fas fa-clock"></i>
          <h4>Business Hours</h4>
          <p class="mb-2"><strong>Monday - Friday:</strong> 9:00 AM - 6:00 PM</p>
          <p class="mb-2"><strong>Saturday:</strong> 10:00 AM - 4:00 PM</p>
          <p class="mb-0"><strong>Sunday:</strong> Closed</p>
        </div>
        
        <div class="contact-info-card text-center">
          <i class="fas fa-headset"></i>
          <h4>Customer Support</h4>
          <p class="mb-3">Our dedicated team is here to help you with any questions about our jewelry collection</p>
          <p class="mb-0"><strong>Response Time:</strong> Within 24 hours</p>
        </div>
      </div>
      
 
      <div class="col-lg-8">
        <div class="contact-form-card">
          <h3 class="mb-4 text-center">
            <i class="fas fa-paper-plane me-2"></i>Send us a Message
          </h3>
          
          <form id="contactForm">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName" class="form-label">First Name *</label>
                <input type="text" class="form-control" id="contactFirstName" placeholder="Enter your first name" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName" class="form-label">Last Name *</label>
                <input type="text" class="form-control" id="contactLastName" placeholder="Enter your last name" required>
              </div>
            </div>
            
            <div class="mb-3">
              <label for="contactEmail" class="form-label">Email Address *</label>
              <input type="email" class="form-control" id="contactEmail" placeholder="Enter your email address" required>
            </div>
            
            <div class="mb-3">
              <label for="contactSubject" class="form-label">Subject *</label>
              <select class="form-select" id="contactSubject" required>
                <option value="">Select a subject</option>
                <option value="general">General Inquiry</option>
                <option value="order">Order Support</option>
                <option value="product">Product Question</option>
                <option value="shipping">Shipping & Delivery</option>
                <option value="return">Returns & Exchanges</option>
                <option value="custom">Custom Jewelry Request</option>
                <option value="other">Other</option>
              </select>
            </div>
            
            <div class="mb-3">
              <label for="contactMessage" class="form-label">Message *</label>
              <textarea class="form-control" id="contactMessage" rows="6" placeholder="Please describe your inquiry in detail..." required></textarea>
            </div>
            
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="agreeContact" required>
              <label class="form-check-label" for="agreeContact">
                I agree to the <a href="#" class="text-primary">Privacy Policy</a> and consent to Jeweluxe contacting me regarding my inquiry.
              </label>
            </div>
            
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-paper-plane me-2"></i>Send Message
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>


  <footer class="bg-light text-dark text-center py-3">
    <p class="mb-0">© 2025 Jeweluxe | Exquisite Jewelry for You</p>
  </footer>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  

  <script>
    $(document).ready(function() {
      // Contact Form Validation and Submission
      $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        
        // Mark form as submitted for validation tracking
        $(this).data('submitted', true);
        
        let isValid = true;
        const firstName = $('#contactFirstName').val().trim();
        const lastName = $('#contactLastName').val().trim();
        const email = $('#contactEmail').val().trim();
        const subject = $('#contactSubject').val();
        const message = $('#contactMessage').val().trim();
        
        // Clear previous validation
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        
        // Validate First Name
        if (!firstName) {
          $('#contactFirstName').addClass('is-invalid');
          $('#contactFirstName').after('<div class="invalid-feedback">This field is required</div>');
          isValid = false;
        }
        
        // Validate Last Name
        if (!lastName) {
          $('#contactLastName').addClass('is-invalid');
          $('#contactLastName').after('<div class="invalid-feedback">This field is required</div>');
          isValid = false;
        }
        
        // Validate Email
        if (!email) {
          $('#contactEmail').addClass('is-invalid');
          $('#contactEmail').after('<div class="invalid-feedback">This field is required</div>');
          isValid = false;
        } else {
          const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (!emailRegex.test(email)) {
            $('#contactEmail').addClass('is-invalid');
            $('#contactEmail').after('<div class="invalid-feedback">Please enter a valid email address</div>');
            isValid = false;
          }
        }
        
        // Validate Subject
        if (!subject) {
          $('#contactSubject').addClass('is-invalid');
          $('#contactSubject').after('<div class="invalid-feedback">Please select a subject</div>');
          isValid = false;
        }
        
        // Validate Message
        if (!message) {
          $('#contactMessage').addClass('is-invalid');
          $('#contactMessage').after('<div class="invalid-feedback">This field is required</div>');
          isValid = false;
        } else if (message.length < 10) {
          $('#contactMessage').addClass('is-invalid');
          $('#contactMessage').after('<div class="invalid-feedback">Message must be at least 10 characters long</div>');
          isValid = false;
        }
        
        // Validate Privacy Policy Agreement
        if (!$('#agreeContact').is(':checked')) {
          $('#agreeContact').addClass('is-invalid');
          if (!$('#agreeContact').siblings('.invalid-feedback').length) {
            $('#agreeContact').after('<div class="invalid-feedback">You must agree to the privacy policy</div>');
          }
          isValid = false;
        } else {
          $('#agreeContact').removeClass('is-invalid');
          $('#agreeContact').siblings('.invalid-feedback').remove();
        }
        
        if (isValid) {
          // Simulate sending message
          $('#contactForm button[type="submit"]').text('Sending...').prop('disabled', true);
          
          setTimeout(() => {
            alert('Message sent successfully! We will get back to you within 24 hours.');
            $('#contactForm')[0].reset();
            $('#contactForm button[type="submit"]').text('Send Message').prop('disabled', false);
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            // Reset form submission tracking
            $('#contactForm').removeData('submitted');
          }, 2000);
        }
      });
      
      // Auto-trim spaces on input
      $('input[type="text"], input[type="email"], textarea').on('blur', function() {
        $(this).val($(this).val().trim());
      });
      
      // Disable browser validation messages
      $('input[required]').on('invalid', function(e) {
        e.preventDefault();
      });
    });
  </script>

</body>
</html>