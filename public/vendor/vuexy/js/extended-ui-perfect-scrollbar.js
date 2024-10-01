/**
 * Perfect Scrollbar
 */
'use strict';

document.addEventListener('DOMContentLoaded', function () {
  (function () {
    const verticalExample = document.getElementById('vertical-example'),
      horizontalExample = document.querySelector('.dataTables_scrollBody'),
      horizVertExample = document.getElementById('both-scrollbars-example');

    // Vertical Example
    // --------------------------------------------------------------------
    if (verticalExample) {
      new PerfectScrollbar(verticalExample, {
        wheelPropagation: false
      });
    }

    // Horizontal Example
    // --------------------------------------------------------------------
    if (horizontalExample) {
      let scrollBar = new PerfectScrollbar(horizontalExample, {
        wheelPropagation: false,
        suppressScrollY: true,
      });
      setTimeout(()=>{
         /* horizontalExample.classList.add('ps--active-x');
          let width = document.querySelector('.dataTables_scrollBody table.datatable').style.width
          document.querySelector('.dataTables_scrollBody .ps__rail-x').style.width = width;
          let thumb_width = (document.querySelector('.dataTables_scrollBody').style.width * width)/width;
          document.querySelector('.dataTables_scrollBody .ps__rail-x .ps__thumb-x').style.width = thumb_width;*/
          scrollBar.update();
      },5000)

    }

    // Both vertical and Horizontal Example
    // --------------------------------------------------------------------
    if (horizVertExample) {
      new PerfectScrollbar(horizVertExample, {
        wheelPropagation: false
      });
    }
  })();
});
