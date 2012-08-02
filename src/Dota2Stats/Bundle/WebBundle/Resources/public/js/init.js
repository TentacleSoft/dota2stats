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

function restoreLogin(divWidth, divHeight) {
    $('div.login').addClass('closed');
    $('div.login-popup').hide();
    $('div.login').animate({width:divWidth, height:divHeight}, 'fast', function () {
        $('span.login-text').show();
    });
}

$(function () {
    /* Login */
    var loginWidth = $('div.login-popup').width(),
        loginHeight = $('div.login-popup').height();
    $('div.login-popup').hide();
    var loginDivWidth = $('div.login').width(),
        loginDivHeight = $('div.login').height();
    $('div.login').css('height', loginDivHeight).css('width', loginDivWidth);
    
    $('div.login.closed').click(function () {
        $('div.login').removeClass('closed');
        $('span.login-text').hide();
        $('div.login').animate({width:loginWidth, height:loginHeight}, 'fast', function () {
            $('div.login-popup').show();
        });
    });
    
    $('a.login-steam').live('click', function () {
        newWindow = window.open($(this).attr('href'),'','height=600,width=1000');
        if (window.focus) newWindow.focus();
        return false;
    });
    
    window.addEventListener("message", function(e) {
        console.log(e.data); //e.data is the string message that was sent.
    }, true);
    
    /* Match List */
    var matchesStart = 0;
    
    $('#body').css('height', $('#match_list').css('height'));
    
    $('.match').click({divWidth: loginDivWidth, divHeight: loginDivHeight}, function() {
        $('#details').html('Loading...');
        window.history.pushState(null, '', '/match/'+$(this).attr('id'));
        restoreLogin(loginDivWidth, loginDivHeight);
        $('#details').load($(this).attr('id')+'/details');
        $('#match_list').animate({'left': -1000}, 200, function () {
            $('#match_details').show();
        });
    });
    
    $('button#back').click({divWidth: loginDivWidth, divHeight: loginDivHeight}, function() {
        window.history.pushState(null, '', '/');
        restoreLogin(loginDivWidth, loginDivHeight);
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
