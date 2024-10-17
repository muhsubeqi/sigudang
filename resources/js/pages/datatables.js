
$.extend($.fn.DataTable.ext.classes, {
  sWrapper: "dataTables_wrapper dt-bootstrap5",
  sFilterInput: "form-control form-control-sm",
  sLengthSelect: "form-select form-select-sm"
})

$.extend(true, $.fn.DataTable.defaults, {
  responsive: true,
  pageLength: 10,
  lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
  autoWidth: false,
  buttons: [
      {
          extend: 'copyHtml5',
          text: '<i class="fa fa-copy"></i>',
          titleAttr: 'Copy',
          className: 'btn btn-sm',
      },
      {
          extend: 'csvHtml5',
          text: '<i class="fa fa-file-csv"></i>',
          titleAttr: 'Export to CSV',
          className: 'btn btn-sm',
      },
      {
          extend: 'excelHtml5',
          text: '<i class="fa fa-file-excel"></i>',
          titleAttr: 'Export to Excel',
          className: 'btn btn-sm',
      },
      {
          extend: 'pdfHtml5',
          text: '<i class="fa fa-file-pdf"></i>',
          titleAttr: 'Export to PDF',
          className: 'btn btn-sm',
      },
      {
          extend: 'print',
          text: '<i class="fa fa-print"></i>',
          titleAttr: 'Print',
          className: 'btn btn-sm',
      }
  ],
  dom: "<'row'<'col-12 d-flex flex-column flex-sm-row justify-content-between align-items-center mb-2'" +
  "<l>" + // Length menu
  "<B>" + // Buttons
  "<f>>" + // Search input
  ">",
  // "<'row'<'col-sm-12'<'table-responsive'tr>>>" +
  // "<'row'<'col-sm-12 col-md-5 p-0'i><'col-sm-12 col-md-7 p-0'p>>",
  language: {
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
  }
})
