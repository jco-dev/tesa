$(document).ready(function () {

    $('#tbl-listado-roles').DataTable({
        responsive: true,
        processing: true,
        select: false,
        serverSide: true,
        paging: false,
        ajax: {
            url: 'listado-roles-ajax',
            type: 'GET'
        },
        language: {
            url: 'assets/plugins/custom/datatables/lang/es.json'
        },
        dom:
            "<'row'" +
            "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
            "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            ">" +
    
            "<'table-responsive'tr>" +
    
            "<'row'" +
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            ">"

    });
});