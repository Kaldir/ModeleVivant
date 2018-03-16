// FORM TOGGLER
$(document).ready(function() {
	$(".fsContent").hide();
    $(".sbsToggler").click(function() {
    $(this).siblings(".fsContent").slideToggle(); // this fait référence à l'élément sur lequel a eu lieu l'événement (donc ici le click)
    });
});

// SIDEBAR TOGGLER
$(document).ready(function() {
    $(".sbsTogglerSidebar").click(function() {
    $(this).next(".fsContentSidebar").slideToggle();
    });
});

// MARKET TOGGLER
$(document).ready(function() {
    $(".sbsTogglerResponsive").click(function() {
    $(this).next(".fsContentResponsive").slideToggle();
    });
});