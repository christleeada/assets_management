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
            if (message.advice !== ' ') {
              var listItem = '<li class="recent-item list-group-item" onclick="window.location.href = \'' + message.link + '\'" data-item-id="' + message.id + '">' + message.item_name + ': ' + message.advice + '</li>';

              $('#messagesList').append(listItem);
            }
          }
        } else {
          var noMessageItem = '<li>No notifications</li>';
          $('#messagesList').append(noMessageItem);
        }

        // Show the dropdown
        $('#messagesDropdown').dropdown('show');
      },
      error: function() {
        
      }
    });
  });

  $('#closeButton').click(function() {
    // Hide the dropdown
    $('#messagesDropdown').dropdown('hide');
    // Clear the existing dropdown list
    $('#messagesList').empty();
  });

  $('#refreshButton').click(function() {
    $.ajax({
        type: 'GET',
        dataType: 'html',
        success: function(response) {
            // Remove the alert and directly reload the page
            location.reload();
        }
    });
});

});
</script>
