<script>
$(document).ready(function() {
  var table = $('#itemTable').DataTable({
    paging: false,
    dom: 'Bfrtip',
    buttons: [
      {
        text: '<button type="button" class="btn btn-secondary btn-sm">QR Codes</button>',
        action: function(e, dt, button, config) {
          // Create a new window for printing
          var printWindow = window.open('', '_blank');

          // Generate the HTML content for printing
          var contentHtml = '';
          table.column(0, { search: 'applied' }).data().each(function(value, index) {
            contentHtml += '<div> ' + value + '</div>';
            contentHtml += '<div> ' + table.column(1).data()[index] + '</div>';
            contentHtml += '<br>';
          });

          // Set the HTML content of the print window
          printWindow.document.open();
          printWindow.document.write('<html><body>' + contentHtml + '</body></html>');
          printWindow.document.close();

          // Print the QR code contents
          printWindow.print();
        }
      },
      {
        extend: 'csvHtml5',
        className: 'btn btn-secondary btn-sm',
        text: 'Export CSV'
      },
      {
        extend: 'excelHtml5',
        className: 'btn btn-secondary btn-sm',
        text: 'Export Excel'
      },
      {
        extend: 'pdfHtml5',
        className: 'btn btn-secondary btn-sm',
        text: 'Export PDF'
      },
      {
        extend: 'print',
        className: 'btn btn-secondary btn-sm',
        text: 'Print'
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