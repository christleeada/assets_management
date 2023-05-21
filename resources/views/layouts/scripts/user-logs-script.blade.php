<script>
    $(document).ready(function() {
  $('#userlogsTable').DataTable({
    order: [[4, 'desc']] // Sort by the 5th column (index 4) in descending order
  });
});

    setTimeout(function(){
        $('#alert').fadeOut('fast');
    }, 5000);

    



</script>
<script>
 



 $(document).ready(function() {
  $('#applyFilter').click(function() {
    var startDate = Date.parse($('#startDate').val()); // Parse startDate as a timestamp
    var endDate = Date.parse($('#endDate').val()); // Parse endDate as a timestamp

    $('#userlogsTable tbody tr').each(function() {
      var timestamp = $(this).find('td:eq(4)').text();
      var dateAdded = Date.parse(timestamp); // Parse dateAdded as a timestamp

      if (isNaN(startDate) && isNaN(endDate)) {
        $(this).show();
      } else if (isNaN(startDate) && !isNaN(endDate)) {
        $(this).toggle(dateAdded <= endDate);
      } else if (!isNaN(startDate) && isNaN(endDate)) {
        $(this).toggle(dateAdded >= startDate);
      } else {
        $(this).toggle(dateAdded >= startDate && dateAdded <= endDate);
      }
    });

    // Close the modal after applying the filter
    $('#filterModal').modal('hide');
  });
});

</script>
