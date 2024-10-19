
$.extend($.fn.DataTable.ext.classes, {
  sWrapper: "dataTables_wrapper dt-bootstrap5",
  sFilterInput: "form-control form-control-sm",
  sLengthSelect: "form-select form-select-sm",
})

$.extend(true, $.fn.DataTable.defaults, {
  responsive: true,
  pageLength: 10,
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
