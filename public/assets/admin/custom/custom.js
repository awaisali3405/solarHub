// =========Left Sidebar==========

$(document).on('click', '#sidebar li', function() {
	$(this).addClass('active').siblings().removeClass('active')
});

// ===========Left Menu Sidebar Dropdown Toggle===============

$('.sub-menu ul').hide();
$(".sub-menu a").click(function() {
	$(this).parent(".sub-menu").children('ul').toggle("2000");
	$(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
});

// ==============Sidebar Toggle===============

$(document).ready(function(){
	$(".sidebarCollapse").click(function(){
		$(".left-menu").toggleClass('hide');
		$(".font-hide").toggleClass('hi');
		$('.content-wrapper').toggleClass('hid');
	})
});

// ==============Datatable===============

// $(document).ready(function() {
//     $('#example').DataTable();
// } );

// =============Tooltips===============

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

// =================Popovers=================

var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})

// ===============Select2===================

// $('document').ready(function(){
// 	$('.select2').select2();
// });












