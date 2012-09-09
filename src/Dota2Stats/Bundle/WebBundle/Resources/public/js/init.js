function loadMatches(start) {
    var matches = $('.match').addClass('hidden');
    for (var i = start; i < start+5; i++) {
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
        $('div#background').hide();
    });
}

/**
 * Loads the data for the new page and switches the page
 * to it.
 * @param {String} url
 * @return {Object} data
 */
function pageData(url) {
    $.get(url, function(data) {
        switchPage(data);
        return data;
    })
}

/**
 * Switches body page to the specified data.
 * @param {Object} data
 */
function switchPage(data) {
    $('#body').addClass('closePage');
    _.delay(function() {
        $('#body').html(data);
        $('#body').toggleClass('closePage openPage');
    }, 200);
}

function switchBackPage(data) {
    $('#body').addClass('closePage');
    _.delay(function() {
        $('#body').html(data);
        $('#body').toggleClass('closePage openPage');
    }, 200);
}

$(function () {
    var popped = ('state' in window.history), initialURL = location.href;

    var initialData = $('#body').html();

    /* Login */
    var loginWidth = $('div.login-popup').width(),
        loginHeight = $('div.login-popup').height();
    $('div.login-popup').hide();
    var loginDivWidth = $('div.login').width(),
        loginDivHeight = $('div.login').height();
    $('div.login').css('height', loginDivHeight).css('width', loginDivWidth);
    
    $('div.login.closed').click(function() {
        $('div.login').removeClass('closed');
        $('span.login-text').hide();
        $('div.login').animate({width:loginWidth, height:loginHeight}, 'fast', function() {
            $('div.login-popup').show();'prova'
            $('div#background').show(function() {
                $('div#background').click({divWidth: loginDivWidth, divHeight: loginDivHeight}, function() {
                    restoreLogin(loginDivWidth, loginDivHeight);
                });
            });
        });
    });
    
    $('a.login-steam').live('click', function() {
        var newWindow = window.open($(this).attr('href'),'','height=600,width=1000');
        if (window.focus) newWindow.focus();
        
        var timer = setInterval(function(elrogerestonto) {
            if (newWindow.closed) {
                clearInterval(timer);
                $('.login-text').load('/login').show();
            }
        }, 500);
        
        return false;
    });

    $(window).bind('popstate', function(event) {
        console.log(event);
        if (event.originalEvent.state) {
            switchBackPage(event.state.data);
        } else {
            switchBackPage(initialData);
        }
    });
    
    /* Match List */
    var matchesStart = 0;
    
    $('#body').css('height', $('#match_list').css('height'));
    
    $('.match').live('click', function() {
        var url = '/match/' + $(this).attr('id') + '/';
        history.pushState(
            pageData(url),
            'Match ' + $(this).attr('id'),
            url
        );
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
