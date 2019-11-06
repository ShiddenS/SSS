$.getScript('js/lib/tablesorter/jquery.tablesorter.min.js', function() {
    $('[data-ca-sortable-column="false"]').data('sorter', false);
    $('[data-ca-sortable="true"]').tablesorter({
        sortList: [[0,0]],
        emptyTo: 'emptyMin'
    });
});