/* functions */

/*globals $*/

$(function() {
	"use strict";
	prettyPrint();


    console.log("tessst");
    function validateForm(){
        console.log("test");
        var fname = document.forms["eqpform"]["fname"].value;
        var lname = document.forms["eqpform"]["lname"].value;
        var email = document.forms["eqpform"]["email"].value;
        var course = document.forms["eqpform"]["course"].value;
        var location = document.forms["eqpform"]["location"].value;

        if (fname == null || lname == null || email == null || course == null || location == null){
            alert("test1");
            return false;
        }
        if (fname == "" || lname == "" || email == "" || course == "" || location == ""){
            alert("test2");
            return false;
        }
        else{
            return false;
        }

    }


});

$(document).on("click", "#checkMark", function(e) {
	iosOverlay({
		text: "Success!",
		duration: 2e3,
		icon: "img/check.png"
	});
	return false;
});

$(document).on("click", "#cross", function(e) {
	iosOverlay({
		text: "Error!",
		duration: 2e3,
		icon: "img/cross.png"
	});
	return false;
});

$(document).on("click", "#loading", function(e) {
	var opts = {
		lines: 13, // The number of lines to draw
		length: 11, // The length of each line
		width: 5, // The line thickness
		radius: 17, // The radius of the inner circle
		corners: 1, // Corner roundness (0..1)
		rotate: 0, // The rotation offset
		color: '#FFF', // #rgb or #rrggbb
		speed: 1, // Rounds per second
		trail: 60, // Afterglow percentage
		shadow: false, // Whether to render a shadow
		hwaccel: false, // Whether to use hardware acceleration
		className: 'spinner', // The CSS class to assign to the spinner
		zIndex: 2e9, // The z-index (defaults to 2000000000)
		top: 'auto', // Top position relative to parent in px
		left: 'auto' // Left position relative to parent in px
	};
	var target = document.createElement("div");
	document.body.appendChild(target);
	var spinner = new Spinner(opts).spin(target);
	iosOverlay({
		text: "Loading",
		duration: 2e3,
		spinner: spinner
	});
	return false;
});

$(document).on("click", "#loadToSuccess", function(e) {
	var opts = {
		lines: 13, // The number of lines to draw
		length: 11, // The length of each line
		width: 5, // The line thickness
		radius: 17, // The radius of the inner circle
		corners: 1, // Corner roundness (0..1)
		rotate: 0, // The rotation offset
		color: '#FFF', // #rgb or #rrggbb
		speed: 1, // Rounds per second
		trail: 60, // Afterglow percentage
		shadow: false, // Whether to render a shadow
		hwaccel: false, // Whether to use hardware acceleration
		className: 'spinner', // The CSS class to assign to the spinner
		zIndex: 2e9, // The z-index (defaults to 2000000000)
		top: 'auto', // Top position relative to parent in px
		left: 'auto' // Left position relative to parent in px
	};
	var target = document.createElement("div");
	document.body.appendChild(target);
	var spinner = new Spinner(opts).spin(target);
	var overlay = iosOverlay({
		text: "Loading",
		spinner: spinner
	});

	window.setTimeout(function() {
		overlay.update({
			icon: "img/check.png",
			text: "Success"
		});
	}, 3e3);

	window.setTimeout(function() {
		overlay.hide();
	}, 5e3);

	return false;
});