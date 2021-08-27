/*
    Name: ylc-carousel
    Description: jQuery plugin to animate the carousel
    Version: 1.1.2
    Written By: Brandon Ho
*/

jQuery(function($) {
	function carousel_show_another_link(direction) {
        var ul = $('#carousel ul');
        var current = -parseInt(ul[0].style.marginLeft) / 100;
        var new_link = current + direction;
        var links_number = ul.children('li').length;
        if (new_link >= 0 && new_link < links_number) {
            ul.animate({'margin-left': -(new_link * 100) + '%'});
        }
    }
    function carousel_previous_link() {
        carousel_show_another_link(-1);
        return false;
    }
    function carousel_next_link() {
        carousel_show_another_link(1);
        return false;
    }
    $(function() {
		$('#carousel ul li a.carousel-prev').click(carousel_previous_link);
        $('#carousel ul').css('margin-left', 0);
        $('#carousel ul li a.carousel-next').click(carousel_next_link);
	});
});