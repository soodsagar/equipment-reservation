




var one = document.querySelector('.powerange-slider-1');
var init_one = new Powerange(one, { min: 0, max: 100, start: 80, hideRange: true, klass: "slider-success" });

var two = document.querySelector('.powerange-slider-2');
var init_two = new Powerange(two, { min: 0, max: 100, start: 65, hideRange: true, klass: "slider-info" });

var three = document.querySelector('.powerange-slider-3');
var init_three = new Powerange(three, { min: 0, max: 100, start: 50, hideRange: true, klass: "slider-warning" });

var four = document.querySelector('.powerange-slider-4');
var init_four = new Powerange(four, { min: 0, max: 100, start: 35, hideRange: true, klass: "slider-danger" });



var five = document.querySelector('.powerange-slider-5');
five.onchange = function(){ $("#slider-value").html(five.value);}
var init_five = new Powerange(five, { min: 0, max: 100, start: 35, hideRange: true });

var six = document.querySelector('.powerange-slider-6');
six.onchange = function(){ $("#slider-value-decimal").html(six.value);}
var init_six = new Powerange(six, { min: 0.0, max: 100.0, start: 55.06, hideRange: true, decimal: true });

var seven = document.querySelector('.powerange-slider-7');
seven.onchange = function(){ $("#slider-value-step").html(seven.value);}
var init_seven = new Powerange(seven, { min: 0, max: 100, start: 80, hideRange: true, step: 10 });




var eight = document.querySelector('.powerange-slider-8');
eight.onchange = function(){ $(".slider-img-resize").css({'width': eight.value}) };
var init_eight = new Powerange(eight, { min: 20, max: 100, start: 30, hideRange: true  });

var nine = document.querySelector('.powerange-slider-9');
nine.onchange = function(){ $(".slider-img-opacity").css({'opacity': nine.value}) };
var init_nine = new Powerange(nine, { min: 0, max: 1, start: 1, hideRange: true, decimal: true  });

var ten = document.querySelector('.powerange-slider-10');
ten.onchange = function(){ $(".slider-img-rotate").css({'transform': 'rotate('+ten.value+'deg)', '-ms-transform': 'rotate('+ten.value+'deg)', '-webkit-transform': 'rotate('+ten.value+'deg)'}) };
var init_ten = new Powerange(ten, { min: 0, max: 360, start: 0, hideRange: true, decimal: true  });
