// Lightweight auth behavior: preview & inline feedback
$(document).ready(function() {
  // Live preview for non-sensitive fields
  function updatePreview() {
    const first = $('#firstName').val().trim();
    const last = $('#lastName').val().trim();
    const email = $('#registerEmail').val().trim();
    const username = $('#username').val().trim();

    if (first || last || email || username) {
      $('#registerPreview').show();
      $('#previewFirstLast').text((first || '') + (first && last ? ' ' : '') + (last || ''));
      $('#previewEmail').text(email ? 'Email: ' + email : '');
      $('#previewUsername').text(username ? 'Username: ' + username : '');
    } else {
      $('#registerPreview').hide();
    }
  }

  $('#firstName, #lastName, #registerEmail, #username').on('input', updatePreview);

  // Show inline feedback messages
  function showFeedback(message, type) {
    // type: 'success' | 'danger' | 'info'
    const cls = type === 'success' ? 'alert-success' : (type === 'danger' ? 'alert-danger' : 'alert-info');
    $('#registerFeedback').html('<div class="alert ' + cls + ' small mb-0">' + message + '</div>');
  }

  // Intercept form submit to show feedback (server integration will replace this)
  $('#registerForm').on('submit', function(e) {
    // If a server endpoint exists, normal submit will proceed; otherwise, prevent and simulate
    const action = $(this).attr('action');
    if (!action || action === '#' || action === '') {
      e.preventDefault();
    }

    // simple client-side check (duplicate of existing validation)
    const firstName = $('#firstName').val().trim();
    const lastName = $('#lastName').val().trim();
    const email = $('#registerEmail').val().trim();
    const username = $('#username').val().trim();
    const password = $('#registerPassword').val();
    const confirmPassword = $('#confirmPassword').val();
    const agree = $('#agreeTerms').is(':checked');

    if (!firstName || !lastName || !email || !username || !password || !confirmPassword) {
      showFeedback('Please fill in all required fields.', 'danger');
      return false;
    }
    if (password.length < 8) {
      showFeedback('Password must be at least 8 characters long.', 'danger');
      return false;
    }
    if (password !== confirmPassword) {
      showFeedback('Passwords do not match.', 'danger');
      return false;
    }
    if (!agree) {
      showFeedback('You must agree to the Terms and Conditions.', 'danger');
      return false;
    }

    // If action points to a server handler, allow form submit to proceed (so server can handle)
    if (action && action !== '#' && action !== '') {
      // Let the browser submit the form normally to the server
      showFeedback('Submitting registration to server...', 'info');
      return true; // allow submit
    }

    // Otherwise simulate success
    $('#registerForm button[type="submit"]').text('Creating Account...').prop('disabled', true);
    setTimeout(function() {
      showFeedback('Account created successfully! You can now sign in.', 'success');
      $('#registerForm')[0].reset();
      $('#registerPreview').hide();
      $('#registerForm button[type="submit"]').text('Create Account').prop('disabled', false);
    }, 1200);

    e.preventDefault();
    return false;
  });

  // AJAX login: intercept login form if present
  $(document).on('submit', '#loginForm', function(e) {
    e.preventDefault();
    const $form = $(this);
    const url = $form.attr('action') || 'login_handler.php';
    const data = $form.serialize();

    // disable form while submitting
    $form.find('button[type="submit"]').prop('disabled', true).text('Signing in...');

    $.ajax({
      url: url,
      method: 'POST',
      data: data,
      dataType: 'json'
    }).done(function(resp) {
      if (resp && resp.success) {
        // Update modal body to show signed-in UI
        const display = $('<div class="text-center py-3">'
          + '<h5>Signed in as</h5>'
          + '<p class="lead">' + $('<div>').text(resp.user.display).html() + '</p>'
          + '<div class="d-grid gap-2">'
          + '<a class="btn btn-outline-secondary" href="logout.php">Sign Out</a>'
          + '</div>'
          + '</div>');

        const $modalBody = $form.closest('.modal-body');
        $modalBody.html(display);
      } else {
        const msg = (resp && resp.error) ? resp.error : 'Login failed';
        // show small inline alert above form
        $form.prepend('<div class="alert alert-danger small mb-3">' + $('<div>').text(msg).html() + '</div>');
      }
    }).fail(function() {
      $form.prepend('<div class="alert alert-danger small mb-3">An error occurred while signing in.</div>');
    }).always(function() {
      $form.find('button[type="submit"]').prop('disabled', false).text('Sign In');
    });
  });
});
