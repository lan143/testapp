window.api = {};

window.api.sendQuery = function(type, url, params) {
    return $.ajax({
        type: type,
        url: '/api/' + url,
        headers: {
            "authorization": "Bearer tumvrtvrtyerty445t45"
        },
        data: params
    });
}

/**
 * @api {get} /promocodes/search Search promocodes by name
 * @apiName SearchPromocodes
 * @apiGroup Promocodes
 *
 * @apiParam {String} name Promocode name part.
 *
 * @apiSuccess {String} client_reward
 * @apiSuccess {String} date_start
 * @apiSuccess {String} date_end
 * @apiSuccess {String} status_name
 * @apiSuccess {Integer} tariff_zone.id
 * @apiSuccess {String} tariff_zone.name
 */
function searchPromocodes(name) {
    window.api.sendQuery('GET', 'promocodes/search', {
        name: name
    }).done(function(data) {
        $('#search-results').empty();

        console.log(data);

        for (var index in data) {
            var el = data[index];

            var html = 'client_reward: ' + el.client_reward + '<br>'
                    + 'date_start: ' + el.date_start + '<br>'
                    + 'date_end: ' + el.date_end + '<br>'
                    + 'status_name: ' + el.status_name + '<br>'
                    + 'tariff_zone: ' + el.tariff_zone.name + '<br><br>';

            $('#search-results').append(html);
        }
    });
}

/**
 * @api {post} /promocodes/activate Activate promocode by name and tariff zone
 * @apiName ActivatePromocode
 * @apiGroup Promocodes
 *
 * @apiParam {String} name Promocode name.
 * @apiParam {Integer} tariff_zone Promocode tariff zone id.
 *
 * @apiSuccess {String} client_reward
 */
function activatePromocode(name, tariff_zone) {
    window.api.sendQuery('POST', 'promocodes/activate', {
        name: name,
        tariff_zone: tariff_zone
    }).done(function(data) {
        alert('Promocode activated. client_reward: ' + data.client_reward);
    }).fail(function(jqXHR, textStatus) {
        alert('Failed activate promocode. Reason: ' + textStatus);
    });
}

$('input[name=search]').change(function() {
    searchPromocodes($(this).val());
});

$('form[name=activate]').submit(function(e) {
    e.preventDefault();

    activatePromocode($('input[name=name]').val(), $('select[name=tariff_code] option:selected').attr('value'));

    return false;
});