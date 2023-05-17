<script>
    $(document).ready(function(){
        $('#itemTable').DataTable();
    });

    setTimeout(function(){
        $('#alert').fadeOut('fast');
    }, 5000);

</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        new Magnifier({
            magnifier: ".magnifier",
            container: ".magnifier-container",
            cursor: "crosshair",
            zoom: 2,
            zoomable: true
        });
    });
</script>





