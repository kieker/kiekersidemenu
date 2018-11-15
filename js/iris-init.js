jQuery(document).ready(function($){
 $('#color-picker').iris({
 color: false,
    mode: 'hsl',
    controls: {
        horiz: 's', // horizontal defaults to saturation
        vert: 'l', // vertical defaults to lightness
        strip: 'h' // right strip defaults to hue
    },
    hide: true, // hide the color picker by default
    border: true, // draw a border around the collection of UI elements
    target: false, // a DOM element / jQuery selector that the element will be appended within. Only used when called on an input.
    width: 400, // the width of the collection of UI elements
    palettes: false // show a palette of basic colors beneath the square.
 });
 	  $('#color-picker').click(function() {
 $(this).find('.iris-picker').toggle(); //click came from somewhere else
});
});