(function () {
    showMessage = function (mode, msg) {
        classmode = 'alert-info';
        switch (mode) {
            case 'success':
                classmode = 'alert-success';
                break;
            case 'warning':
                classmode = 'alert-warning';
                break;
            case 'danger':
                classmode = 'alert-danger';
                break;
        }
        $('#alert-msg').html('<span class="success" >' + msg + '</span>').addClass(classmode);
        setTimeout(function () {
            $('#alert-msg').removeClass(classmode).html('');
        }, 3000)
    }

    getCourseCountPerPage = function (mode) {
        count = 5;
        switch (mode) {
            case 'admin':
                count = 5;
                break;
            case 'organisation':
                count = 3;
                break;
            case 'employee':
                count = 5;
                break;
        }
        return count;
    }
    formattedText = function (text) {
        return (text == null || text == '') ? '' : text.trim();
    }

    firstLettersCap = function (string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
    getUrlMenu = function () {
     
         return 'http://kiwings.tglobalsolutions.com/index.php?r=';
//         return 'http://kiwings/index.php?r=';
    }
})();