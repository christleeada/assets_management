

<script>
    $(document).ready(function(){
        var table = $('#itemTable').DataTable({
            paging: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        modifier: {
                            search: 'none',
                            page: 'current'
                        }
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        modifier: {
                            search: 'none',
                            page: 'current'
                        }
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        modifier: {
                            search: 'none',
                            page: 'current'
                        }
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        modifier: {
                            search: 'none',
                            page: 'current'
                        }
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        modifier: {
                            search: 'none',
                            page: 'current'
                        }
                    }
                }
            ]
        });

        $('#filterDropdown').on('change', function() {
            var selectedCategory = $(this).val();
            table.column(3).search(selectedCategory).draw();
        });
    });
</script>
<style>
  
</style>


<script>
  //  $(document).ready(function() {
  //   $('#filterDropdown').change(function() {
  //     var selectedCategory = $(this).val();
  //     $('#itemTable tbody tr').each(function() {
  //       var categoryColumn = $(this).find('td:eq(3)').text();

  //       if (selectedCategory === '' || categoryColumn === selectedCategory) {
  //         $(this).show();
  //       } else {
  //         $(this).hide();
  //       }
  //     });
  //   });
  // });



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


<script>
 function printTable() {
  var table = document.getElementById("itemTable");
  var newWin = window.open('', '_blank');
  newWin.document.open();
  newWin.document.write('<html>  <head><link href="{{asset('asset/build/css/custom.min.css')}}" rel="stylesheet">');
  newWin.document.write('<style>');
  newWin.document.write('table {');
  newWin.document.write('  border-collapse: collapse;');
  newWin.document.write('  width: 100%;');
  newWin.document.write('}');
  newWin.document.write('th, td {');
  newWin.document.write('  border: 1px solid black;');
  newWin.document.write('  padding: 8px;');
  newWin.document.write('}');
  newWin.document.write('.header-row {');
  newWin.document.write('  background-color: #98EECC;');
  newWin.document.write('  font-weight: bold;');
  newWin.document.write('}');
  newWin.document.write('</style>');
  newWin.document.write('</head><body>');
  newWin.document.write(table.outerHTML);
  newWin.document.write('</body></html>');
  newWin.document.close();
  newWin.print();
}
</script>

<script src="{{asset('asset/vendors/jspdf/dist/jspdf.umd.min.js')}}"></script>
<script>
  function downloadPDF() {
    var table = document.getElementById("itemTable");
    var doc = new jsPDF();

    doc.autoTable({ html: table });

    // Save the PDF file
    doc.save("table.pdf");
  }
</script>
<script>
  function printCSV() {
    var table = document.getElementById("itemTable");
    var csvContent = "data:text/csv;charset=utf-8,";

    // Extract the column headers
    var headerRow = table.getElementsByTagName("thead")[0].rows[0];
    var headerData = [];
    var headerCells = headerRow.getElementsByTagName("th");
    for (var h = 0; h < headerCells.length; h++) {
      headerData.push(headerCells[h].innerText);
    }
    var header = headerData.join(",");
    csvContent += header + "\r\n";

    // Loop through each row of the table
    var rows = table.getElementsByTagName("tbody")[0].rows;
    for (var i = 0; i < rows.length; i++) {
      var rowData = [];
      var cells = rows[i].getElementsByTagName("td");
      for (var j = 0; j < cells.length; j++) {
        rowData.push(cells[j].innerText);
      }
      var row = rowData.join(",");
      csvContent += row + "\r\n";
    }

    // Create a download link and trigger the download
    var encodedUri = encodeURI(csvContent);
    var link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "table.csv");
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  }
</script>









