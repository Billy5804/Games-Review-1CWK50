function getBaseUrl() {
    return window.location.protocol + "//" + window.location.host + "/Games-Review-1CWK50/";
}

function getUserDetails() {
    return fetch(getBaseUrl()+"getUserDetails")
    .then( res => res.json() )
    .then( data => {return data} )
}

function toggleSearch(e, imagePath) {
    e = e || window.event;
    e.preventDefault();
    if ($('#searchToggle').children().attr("src") != imagePath+"search.svg") {
        $('#searchBox, #searchButton').addClass('mw-0');
        $('#searchBox, #searchButton').addClass('invisible');
        $('#searchForm').addClass('mw-50px');
        $('#searchToggle').children().attr("src",imagePath+"search.svg");
    }
    else {
        $('#searchBox, #searchButton').removeClass('mw-0');
        $('#searchBox, #searchButton').removeClass('invisible');
        $('#searchForm').removeClass('mw-50px');
        $('#searchToggle').children().attr("src",imagePath+"close.svg");
    }
}

function openForm(e) {
    e = e || window.event;
    e.preventDefault();
    $('#chatSystem').removeClass('invisible');
}

function closeForm(e) {
    e = e || window.event;
    e.preventDefault();
    $('#chatSystem').addClass('invisible');
}

function elapsedTime(timestamp) {
    const since = new Date(timestamp).getTime(), //Convert the timestamp into epoch timestamp
        elapsed = new Date().getTime() - since; //Get the milleseconds elapsed timestamp to the current time
    
    if (elapsed >= 0) {
        // convert the milleseconds to years, months, days etc
        const years = Math.floor(elapsed / 31557600000),
            months = Math.floor(elapsed / 2629800000),
            days = Math.floor(elapsed / 86400000),
            hours = Math.floor(elapsed / 3600000),
            minutes = Math.floor(elapsed / 60000),
            seconds = Math.floor(elapsed / 1000);

        // return time passed using biggest time unit available
        if (years > 1) return (years + ' years ago');
        else if (years > 0) return (years + ' year ago');
        else if (months > 1) return (months + ' months ago');
        else if (months > 0) return (months + ' month ago');
        else if (days > 1) return (days + ' days ago');
        else if (days > 0) return (days + ' day ago');
        else if (hours > 1) return (hours + ' hours ago');
        else if (hours > 0) return (hours + ' hour ago');
        else if (minutes > 1) return (minutes + ' minutes ago');
        else if (minutes > 0) return (minutes + ' minute ago');
        else if (seconds > 9) return (seconds + ' seconds ago');
        else return ('A few seconds ago');
    }
    else {
        return ('Time is in the future')
    }
}

function setCookie(cookieName, cookieValue, validDays) {
    const milliseconds = validDays * 24 * 60 * 60 * 1000;
    let date = new Date();
    date.setTime(date.getTime() + milliseconds);
    const expires = date.toUTCString();
    document.cookie = encodeURIComponent(cookieName) + "=" + encodeURIComponent(cookieValue) + "; expires=" + expires + "; path=/";
}

function getCookie(cookieName) {
    cookieName = encodeURIComponent(cookieName) + "=";
    const cookies = document.cookie.split(';');
    return $.map(cookies, function (cookie) {
        cookie = cookie.replace(/^ +/gm, '');
        if (cookie.substring(0, cookieName.length) === cookieName) {
            return decodeURIComponent(cookie.substring(cookieName.length, cookie.length));
        }
    })[0];
}

function clearCookie(cookieName) {
    setCookie(cookieName, '', -1);
}