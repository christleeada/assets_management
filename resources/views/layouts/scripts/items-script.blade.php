<script>
  
  $(document).ready(function() {
  var table = $('#itemTable').DataTable({
    paging: true,
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'copy',
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'csv',
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'excel',
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'pdf',
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'print',
        exportOptions: {
          columns: ':visible'
        }
      }
    ]
  });

  function filterByCategory() {
    var categoryFilter = $('#filterDropdown').val();

    table.column(3).search(categoryFilter).draw();
  }

  // Event listener for the category filter dropdown
  $('#filterDropdown').change(function() {
    filterByCategory();
  });

  // Add date filtering functionality
  $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
    var startDate = $('#startDate').val();
    var endDate = $('#endDate').val();

    if (startDate === '' && endDate === '') {
      return true;
    }

    var dateAdded = moment(data[7], 'YYYY-MM-DD');

    if (startDate === '' && endDate !== '') {
      return dateAdded.isSameOrBefore(endDate);
    } else if (startDate !== '' && endDate === '') {
      return dateAdded.isSameOrAfter(startDate);
    } else {
      return dateAdded.isSameOrAfter(startDate) && dateAdded.isSameOrBefore(endDate);
    }
  });

  $('#applyFilter').click(function() {
    table.draw();
    $('#filterModal').modal('hide');
  });

  $('#clearFilter').click(function() {
    $('#filterDropdown').val(''); // Clear category filter
    $('#startDate').val('');
    $('#endDate').val('');
    table.draw();
  });
});    
</script>











