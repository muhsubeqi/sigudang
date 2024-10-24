
$.extend($.fn.DataTable.ext.classes, {
  sWrapper: "dataTables_wrapper dt-bootstrap5",
  sFilterInput: "form-control form-control-sm",
  sLengthSelect: "form-select form-select-sm",
})

$.extend(true, $.fn.DataTable.defaults, {
  responsive: true,
  language: {
    emptyTable: 'No matching records found',
    lengthMenu: "_MENU_",
    search: "_INPUT_",
    searchPlaceholder: "Search..",
    info: "Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",
    paginate: {
      first: '<i class="fa fa-angle-double-left"></i>',
      previous: '<i class="fa fa-angle-left"></i>',
      next: '<i class="fa fa-angle-right"></i>',
      last: '<i class="fa fa-angle-double-right"></i>'
    },
  },
  dom: "<'row'<'col-sm-12'P>>" +
    "<'.row flex-column flex-md-row align-items-center justify-content-between mb-2'" +
    "<'.col-auto d-flex justify-content-center justify-content-md-start mb-2 mb-md-0'lf>" +
    "<'.col-auto d-flex justify-content-center justify-content-md-end'B>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-5'i><'col-sm-7 d-flex justify-content-center justify-content-md-end'p>>",
  buttons: [
      {
        extend: 'colvis',
        text: '<i class="fa fa-eye"></i>',
        titleAttr: 'Column Visibility',
        className: 'btn btn-sm',
      },
      {
          extend: 'copyHtml5',
          text: '<i class="fa fa-copy"></i>',
          titleAttr: 'Copy',
          className: 'btn btn-sm',
          exportOptions: {
            columns: ':visible'
          },
      },
      {
          extend: 'csvHtml5',
          text: '<i class="fa fa-file-csv"></i>',
          titleAttr: 'Export to CSV',
          className: 'btn btn-sm',
          exportOptions: {
            columns: ':visible'
          },
      },
      {
          extend: 'excelHtml5',
          text: '<i class="fa fa-file-excel"></i>',
          titleAttr: 'Export to Excel',
          className: 'btn btn-sm',
          exportOptions: {
            columns: ':visible'
          },
      },
      {
          extend: 'pdfHtml5',
          text: '<i class="fa fa-file-pdf"></i>',
          titleAttr: 'Export to PDF',
          className: 'btn btn-sm',
          exportOptions: {
            columns: ':visible'
          },
      },
      {
          extend: 'print',
          text: '<i class="fa fa-print"></i>',
          titleAttr: 'Print',
          className: 'btn btn-sm',
          exportOptions: {
            columns: ':visible'
          },
      },
  ]
})
