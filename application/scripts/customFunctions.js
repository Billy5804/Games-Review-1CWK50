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