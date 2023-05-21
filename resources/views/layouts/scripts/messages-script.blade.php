<script>
$(document).ready(function() {
  // Preload popover content during page load
  $.ajax({
    url: '{{ route("item.getMessages") }}',
    type: 'GET',
    dataType: 'json',
    success: function(response) {
      var messages = response.messages;

      // Clear the existing notifications list
      $('#messagesList').empty();

      // Generate notifications list items
      if (messages.length > 0) {
        for (var i = 0; i < messages.length; i++) {
          var message = messages[i];
          if (message.advice !== ' ') {
            var listItem = '<li class="recent-item list-group-item" data-item-id="' + message.id + '">' +
                            '<a href="' + message.link + '">' + message.item_name + '</a>: ' + message.advice +
                            '</li>';

            $('#messagesList').append(listItem);
          }
        }
      } else {
        var noMessageItem = '<li>No notifications</li>';
        $('#messagesList').append(noMessageItem);
      }
    },
    error: function() {
      // Show error message
      $('#messagesList').html('<li>Error fetching notifications.</li>');
    }
  });

  // Initialize popover with fade animation and bottom placement
  $('#messagesButton').popover({
  html: true,
  content: function() {
    return $('#messagesPopoverContent').html();
  },
  placement: 'bottom'
});

});





</script>