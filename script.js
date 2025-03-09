$(document).ready(function(){
    let vid =  $('.content video');

    $(vid).click(function(event){
        var clicked = (event.target.dataset.target);
        console.log(clicked);
        if($(this).attr('autoplay')){
            $(this).removeAttr('autoplay');
            $(this)[0].pause();
            $(clicked).addClass('show');
            $(clicked).removeClass('hide');
            
           

        }
        else{
            $(this).attr('autoplay', true);
            $(this)[0].play();
            $(clicked).addClass('hide');
        }
    });

    // onclick liked
    $('.fa-solid.fa-heart').click(function(){
        if($(this).hasClass('liked')){
            $(this).removeClass('liked');
            $(this).css('color','#FFF');
        }
        else{
            console.log('liked');
            $(this).css('color','red');
            $(this).addClass('liked');
        }

    });

    // onclick bookmark
    $('.fa-solid.fa-bookmark').click(function(){
        if($(this).hasClass('saved')){
            $(this).removeClass('saved');
            $(this).css('color','#FFF');
        }
        else{
            console.log('liked');
            $(this).css('color','yellow');
            $(this).addClass('saved');
        }

    });


});