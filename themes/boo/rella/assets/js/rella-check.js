(function($) {


    function removeParam(key, sourceURL) {
        var rtn = sourceURL.split("?")[0],
            param,
            params_arr = [],
            queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
        if (queryString !== "") {
            params_arr = queryString.split("&");
            for (var i = params_arr.length - 1; i >= 0; i -= 1) {
                param = params_arr[i].split("=")[0];
                if (param === key) {
                    params_arr.splice(i, 1);
                }
            }
            rtn = rtn + "?" + params_arr.join("&");
        }
        return rtn;
    }

    $(document).ready(function() {
        if ($('').getParameterByName('refresh')) {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'rella_set_refresh_code',
                    code: $().getParameterByName('refresh'),
                },
                beforeSend: function() {
                    $('#rella-smily-loader').addClass('is-active');
                },
            }).done(function(res) {
                $('#rella-license').html('Loading');
                var href = window.location.href;
                var newhref = removeParam('refresh', href);
                window.location.href = newhref;
            })
        }
        $('#rella-logout-envato').click(function(e) {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'rella_log_out',
                },
                beforeSend: function() {
                    $('#rella-smily-loader').addClass('is-active');
                },
            }).done(function(res) {
                location.reload();
            })
        })
    })
})(jQuery);
