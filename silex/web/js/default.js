function loadMatches(start) {
    var matches = $('.match').addClass('hidden');
    for (i = start; i < start+5; i++) {
        $(matches[i]).removeClass('hidden');
    }
    
    if (start <= 0) $('button#less').attr('disabled', true);
    else $('button#less').attr('disabled', false);
    if (start >= 20) $('button#more').attr('disabled', true);
    else $('button#more').attr('disabled', false);
}

$(document).ready(function () {
    var matchesStart = 0;
    
    $('#body').css('height', $('#match_list').css('height'));
    
    $('.match').click(function() {
        window.history.pushState(null, '', '/match/'+$(this).attr('id'));
        $('#match_list').animate({'left': -2000}, 200);
        $('html, body').animate({ scrollTop: 0 }, 'fast');
        $('#details').html('Loading...');
        $('#details').load($(this).attr('id')+'/details');
        $('#match_details').show();
    });
    
    $('button#back').click(function() {
        window.history.pushState(null, '', '/');
        $('#match_details').hide();
        $('#match_list').show();
        $('#match_list').animate({'left': 0}, 200);
    });
    
    $('button#more').click(function() {
        matchesStart += 5;
        loadMatches(matchesStart);
    });
    
    $('button#less').click(function() {
        matchesStart -= 5;
        loadMatches(matchesStart);
    });
});
