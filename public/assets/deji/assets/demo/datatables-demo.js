// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#dataTable').DataTable(
        {searching: false, paging: true, info: true}
    );
});

$(document).ready(function() {
    $('#dataTableActivity').DataTable({
        "order": [[ 0, 'desc' ]]
    });
});
