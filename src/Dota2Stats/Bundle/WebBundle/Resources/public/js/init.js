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
    /* Match List */
    var matchesStart = 0;
    
    $('#body').css('height', $('#match_list').css('height'));
    
    $('.match').click(function() {
        $('#details').html('Loading...');
        window.history.pushState(null, '', '/match/'+$(this).attr('id'));
        $('#details').load($(this).attr('id')+'/details');
        $('#match_list').animate({'left': -1000}, 200);
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
    
    /* Login */
    var loginHeight = $('form.login').height(),
        loginWidth = $('form.login').width();
    $('form.login').hide();
    var loginDivHeight = $('div.login').height(),
        loginDivWidth = $('div.login').width();
    $('div.login').css('height', loginDivHeight).css('width', loginDivWidth);
    
    $('div.login.closed').click(function () {
        $('div.login').removeClass('closed');
        $('span.login-text').hide();
        $('div.login').animate({width:loginWidth, height:loginHeight}, 'fast', function () {
            $('form.login').show();
            /*$('*:not(.login)').one('click', function () {
                $('div.login').addClass('closed');
                $('form.login').hide();
                $('div.login').animate({width:loginDivWidth, height:loginDivHeight}, 'fast', function () {
                    $('span.login-text').show();
                });
            });*/
        });
    });
});
