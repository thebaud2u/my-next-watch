jQuery(document).ready(function(){
    if($("#tgl-candidat").hasClass('toggle-fcn')) {
        $("#tgl-entreprise").addClass('text-gray-300');
        if(!($('.fonction-entreprise').hasClass('hidden'))) {
            $('.fonction-entreprise').addClass('hidden');
        }
    };
    if($("#tgl-candidat-pres").hasClass('toggle-pres')) {
        $("#tgl-entreprise-pres").addClass('text-gray-300');
        if(!($('.fonction-entreprise-pres').hasClass('hidden'))) {
            $('.fonction-entreprise-pres').addClass('hidden');
        }
    };
    $("#burger").click(function() {
        $('#nav-responsive').toggle('hidden');
        $('#close-reponsive-nav').toggle('hidden');
        $('#burger').toggle('hidden');
    });
    $("#close-reponsive-nav").click(function() {
        $('#nav-responsive').toggle('hidden');
        $('#close-reponsive-nav').toggle('hidden');
        $('#burger').toggle('hidden');
    });
    $("#tgl-candidat-pres").click(function(event) {
        event.preventDefault();
        $("#tgl-entreprise-pres").removeClass('toggle-pres');
        $(this).removeClass('text-gray-300');
        if(!($('#tgl-entreprise-pres').hasClass('text-gray-300'))) {
            $("#tgl-entreprise-pres").addClass('text-gray-300');
        }
        if(!($(this).hasClass("toggle-pres"))) {
            $(this).addClass('toggle-pres');
            if($('.fonction-candidat-pres').hasClass('hidden')) {
                $('.fonction-candidat-pres').removeClass('hidden');
            }
            if(!($('.fonction-entreprise-pres').hasClass('hidden'))) {
            $('.fonction-entreprise-pres').addClass('hidden');
            }
        };
    });
    $("#tgl-entreprise-pres").click(function(event) {
        event.preventDefault();
        $("#tgl-candidat-pres").removeClass('toggle-pres');
        $(this).removeClass('text-gray-300');
        if(!($('#tgl-candidat-pres').hasClass('text-gray-300'))) {
            $("#tgl-candidat-pres").addClass('text-gray-300');
        }
        if(!($(this).hasClass("toggle-pres"))) {
            $(this).addClass('toggle-pres');
            if($('.fonction-entreprise-pres').hasClass('hidden')) {
                $('.fonction-entreprise-pres').removeClass('hidden');
            }
            if(!($('.fonction-candidat-pres').hasClass('hidden'))) {
            $('.fonction-candidat-pres').addClass('hidden');
            }
        };
    });
    $("#tgl-candidat").click(function(event) {
        event.preventDefault();
        $("#tgl-entreprise").removeClass('toggle-fcn');
        $(this).removeClass('text-gray-300');
        if(!($('#tgl-entreprise').hasClass('text-gray-300'))) {
            $("#tgl-entreprise").addClass('text-gray-300');
        }
        if(!($(this).hasClass("toggle-fcn"))) {
            $(this).addClass('toggle-fcn');
            if($('.fonction-candidat').hasClass('hidden')) {
                $('.fonction-candidat').removeClass('hidden');
            }
            if(!($('.fonction-entreprise').hasClass('hidden'))) {
            $('.fonction-entreprise').addClass('hidden');
            }
        };
    });
    $("#tgl-entreprise").click(function(event) {
        event.preventDefault();
        $("#tgl-candidat").removeClass('toggle-fcn');
        $(this).removeClass('text-gray-300');
        if(!($('#tgl-candidat').hasClass('text-gray-300'))) {
            $("#tgl-candidat").addClass('text-gray-300');
        }
        if(!($(this).hasClass("toggle-fcn"))) {
            $(this).addClass('toggle-fcn');
            if($('.fonction-entreprise').hasClass('hidden')) {
                $('.fonction-entreprise').removeClass('hidden');
            }
            if(!($('.fonction-candidat').hasClass('hidden'))) {
            $('.fonction-candidat').addClass('hidden');
            }
        };
    });
});
$(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top
    }, 500);
});