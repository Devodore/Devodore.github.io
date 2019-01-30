i = 100;
j = 2;

function animateCharacters(i){
    setTimeout(function(){
        $('#character0').css('margin-right', i+'%');
        i--;
        if(i>=0){
            animateCharacters(i);
        } else {
            $('#character0').css('margin-right', '0%');
        }
        console.log(2/i);

    }, i/2);
}

function countDown(j){
    setTimeout(function(){
        $('.countDown').html(j);
        j--;
        if(j>=0){
            countDown(j);
        } else {
            $('.countDown').html(0);
        }

    }, 1000);
}

function revealHealth(l){
    setTimeout(function(){
        $('.characters h2').css( 'opacity', l);
        l+=0.1;
        if(l<1){
            revealHealth(l);
        } else {
            $('.characters h2').css( 'opacity', 1);
        }
    }, 50);
}

setTimeout(function(){
    revealHealth(0);
}, 3000);

animateCharacters(i);
$('.countDown').html(j);
countDown(j);

function inspectLife(element){
    if($(element+' h2 span').html()<=0){
        $(element+' img').css('display', 'none');
        $(element+' a').css('display', 'block');
        $(element+' a img').css('display', 'block');
    }
}

setTimeout(function(){
    inspectLife('#character0');
}, 4000);

setTimeout(function(){
    inspectLife('#character1');
}, 4000);
