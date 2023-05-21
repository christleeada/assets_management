
<script>
    $(document).ready(function(){
        $('#itemTable').DataTable();
    });

    setTimeout(function(){
        $('#alert').fadeOut('fast');
    }, 5000);


    

</script>
<script>
   $(document).ready(function() {
    $('#filterDropdown').change(function() {
      var selectedCategory = $(this).val();
      $('#itemTable tbody tr').each(function() {
        var categoryColumn = $(this).find('td:eq(3)').text();

        if (selectedCategory === '' || categoryColumn === selectedCategory) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    });
  });



  $(document).ready(function() {
    $('#applyFilter').click(function() {
      var startDate = $('#startDate').val();
      var endDate = $('#endDate').val();

      $('#itemTable tbody tr').each(function() {
        var dateAdded = $(this).find('td:eq(7)').text();

        if (startDate === '' && endDate === '') {
          $(this).show();
        } else if (startDate === '' && endDate !== '') {
          $(this).toggle(dateAdded <= endDate);
        } else if (startDate !== '' && endDate === '') {
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





