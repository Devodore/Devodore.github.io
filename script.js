$('body').css('background-color','#2C3E50FF')
$('.mobile .material-icons').click(function() {
    $('aside').css('left','0');
    $('aside').css('transition', 'ease 0.2s')
    $('.opacity').css('display','initial');
    });

$('.opacity').click(function()
{
	$('aside').css('left','-200px');
	$(this).css('display','none');
})
