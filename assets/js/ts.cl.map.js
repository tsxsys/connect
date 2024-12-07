var assDataValue, contract_fetched_data, contract_data, assDataQuery, max, min, assetTotal, maxCode, code, cc, countryTotal, percentMin, percentMax;
assDataQuery = "../../includes/get.assData.php";
assDataValue = 'getAssData';
// contract_data = {};
$.ajax({
    type: 'GET',
    url: assDataQuery,
    data: {assDataValue: assDataValue},
    dataType: 'text',
    async: false,
    success: function (response) {
        contract_fetched_data = response;
    }
});
contract_data = JSON.parse('{ ' + contract_fetched_data + ' }');
$('#focus-single').click(function(){
    $('#map1').vectorMap('set', 'focus', {region: 'AU', animate: true});
});
$('#focus-multiple').click(function(){
    $('#map1').vectorMap('set', 'focus', {regions: ['AU', 'JP'], animate: true});
});
$('#focus-coords').click(function(){
    $('#map1').vectorMap('set', 'focus', {scale: 7, lat: 35, lng: 33, animate: true});
});
$('#focus-init').click(function(){
    $('#map1').vectorMap('set', 'focus', {scale: 1, x: 0.5, y: 0.5, animate: true});
});
function init_JQVmap() {
    "undefined" != typeof jQuery.fn.vectorMap && (console.log("init_JQVmap"), $("#world-map-assets").length && $("#world-map-assets").vectorMap({
        // map: 'world_mill_en',
        // panOnDrag: true,
        // focusOn: {
        //     x: 0.5,
        //     y: 0.5,
        //     scale: 2,
        //     animate: true
        // },
        // series: {
        //     regions: [{
        //         scale: ['#C8EEFF', '#0071A4'],
        //         normalizeFunction: 'polynomial',
        //         values: contract_data,
        //     }]
        // }
        map: "world_en",
        backgroundColor: null,
        color: "#ffffff",
        hoverOpacity: .7,
        selectedColor: "#666666",
        enableZoom: !0,
        showTooltip: !0,
        values: contract_data,
        scaleColors: ['#C8EEFF', '#2A3F54'],
        normalizeFunction: "polynomial",
        zoomOnScroll: true,
        panOnDrag: true,
        focusOn: {
            x: 0.5,
            y: 0.5,
            scale: 2,
            animate: true
        },
        onRegionClick: function (element, code, region) {
            var contract_q;
            if (typeof contract_q != 'undefined') {
                contract_q = contract_data[code];
            } else {
                contract_q = 0;
            }
            var message = 'You have '
                + contract_q
                + ' asset(s) in '
                + region
                + ' which has the code: '
                + code.toUpperCase();

            $("#asset-map-info").html(message);
        }
    }))
}

//MAP
$(document).ready(function() {
    init_JQVmap();
    max = 0,
        min = Number.MAX_VALUE,
        assetTotal = 0,
        maxCode = toString().MAX_VALUE,
        percentMin = 0,
        percentMax = 0;
    if ($.isEmptyObject(contract_data) == false) {
        countryTotal = Object.keys(contract_data).length;
        $.each(contract_data, function () {
            assetTotal += parseFloat(this) || 0;
        });
        //find maximum and minimum values
        for (cc in contract_data) {
            if (parseFloat(contract_data[cc]) > max) {
                max = parseFloat(contract_data[cc]);
                maxRegion = contract_data[cc];
            }
            if (parseFloat(contract_data[cc]) < min) {
                min = parseFloat(contract_data[cc]);
                minRegion = contract_data[cc];
            }
        }
        // $('#minAssetQuantity').alert(total+' '+ percent + '% '+maxCode);
        if (assetTotal > 1) {
            assetTotalText = assetTotal + " ASSETS";
        } else if (assetTotal == 1) {
            assetTotalText = assetTotal + " ASSET";
        }
        if (countryTotal > 1) {
            countryTotalText = countryTotal + " COUNTRIES";
        } else if (countryTotal == 1) {
            countryTotalText = countryTotal + " COUNTRY";
        }
        $('#totalContracts').text(assetTotalText + " IN " + countryTotalText);
        percentMin = ((min / assetTotal) * 100).toFixed(2);
        percentMax = ((max / assetTotal) * 100).toFixed(2);
        $('#minAssetQuantity').html("<td>" + minRegion + "</td><td class='fs15 fw700 text-right'>" + percentMin + "%</td>");
        $('#maxAssetQuantity').html("<td>" + maxRegion + "</td><td class='fs15 fw700 text-right'>" + percentMax + "%</td>");
    } else {
        $('#totalContracts').text('0 Contracts held');
        $('#minAssetQuantity').empty();
        $('#maxAssetQuantity').empty();
    }
});