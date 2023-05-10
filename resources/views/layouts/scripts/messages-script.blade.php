<script>
$(document).ready(function() {
  $('#messagesButton').click(function() {
    // Make an AJAX request to fetch the messages
    $.ajax({
      url: '{{ route("item.getMessages") }}',
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        var messages = response.messages;

        // Clear the existing dropdown list
        $('#messagesList').empty();

        // Generate dropdown list items
        if (messages.length > 0) {
          for (var i = 0; i < messages.length; i++) {
            var message = messages[i];
            if (message.advice !== 'Device in optimal condition') {
              var listItem = '<li>' + message.item_name + ': ' + message.advice + '</li>';
              $('#messagesList').append(listItem);
            }
          }
        } else {
          var noMessageItem = '<li>No messages</li>';
          $('#messagesList').append(noMessageItem);
        }

        // Show the dropdown
        $('#messagesDropdown').dropdown('show');
      },
      error: function() {
        alert('Error occurred while fetching messages.');
      }
    });
  });

  $('#closeButton').click(function() {
    // Hide the dropdown
    $('#messagesDropdown').dropdown('hide');
    // Clear the existing dropdown list
    $('#messagesList').empty();
  });
});
</script>
<script>
  $(document).ready(function() {
    $('#refreshButton').click(function() {
        $.ajax({
            url: '{{ route("item.generateAdviceForAllItems") }}',
            type: 'GET',
            dataType: 'html',
            success: function(response) {
                // Display the advice message as an alert
                alert(response);

                // Reload the page to reflect the changes
                location.reload();
            },
            error: function() {
                alert('Error occurred while fetching advice.');
            }
        });
    });
});
</script>
