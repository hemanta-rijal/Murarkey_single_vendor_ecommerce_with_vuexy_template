function locationInfo() {
    this.url = '/location-info';
    this.getCities = function (id) {
        $(".cities option:gt(0)").remove();
        var data = {
            type: 'get-cities',
            id: id
        };
        $('.cities').find("option:eq(0)").html("Please wait..");
        $.post(this.url, data, function (data) {
            $('.cities').find("option:eq(0)").html("Select City");
            $.each(sortProperties(data['result']), function (key, val) {
                var option = $('<option />');
                option.attr('value', val[0]);
                option.text(val[1]);
                $('.cities').append(option);
            });
            $(".cities").prop("disabled", false);
        });
    };


    this.getStates = function (id) {
        $(".states option:gt(0)").remove();
        $(".cities option:gt(0)").remove();
        var data = {
            type: 'get-states',
            id: id
        };
        $('.states').find("option:eq(0)").html("Please wait..");
        $.post(this.url, data, function (data) {
            $('.states').find("option:eq(0)").html("Select Province");
            $.each(sortProperties(data['result']), function (key, val) {

                var option = $('<option />');
                option.attr('value', val[0]);
                var hidden = $('[name=hidden_state_id]');

                if (hidden.val() && hidden.val() == val[0]) {
                    option.attr('selected', 'selected');
                }

                option.text(val[1]);
                $('.states').append(option);
            });
            $(".states").prop("disabled", false);
        });
    };

    this.getCountries = function () {
        var method = "post";
        var localThis = this;
        var data = {
            type: 'get-countries'
        };
        $('.countries').find("option:eq(0)").html("Please wait..");
        $.post(this.url, data, function (data) {
            $('.countries').find("option:eq(0)").html("Select Country");

            $.each(data['result'], function (key, val) {
                var option = $('<option />');
                var hidden = $('[name=hidden_country_id]');

                option.attr('value', key);

                if (hidden.val() && hidden.val() == key) {
                    option.attr('selected', 'selected');
                    localThis.getStates(key);
                }
                option.text(val);
                $('.countries').append(option);
            });
            $(".countries").prop("disabled", false);
        });
    };

}

$(function () {
    var loc = new locationInfo();
    loc.getCountries();
    $(".countries").on("change", function (ev) {
        var countryId = $("option:selected", this).val();
        if (countryId != '') {
            loc.getStates(countryId);
        }
        else {
            $(".states option:gt(0)").remove();
        }
    });
    $(".states").on("change", function (ev) {
        var stateId = $("option:selected", this).val();
        if (stateId != '') {
            loc.getCities(stateId);
        }
        else {
            $(".cities option:gt(0)").remove();
        }
    });
});

function sortObject(o) {
    console.log(o.toArray());

    return o.sort(function(a,b) {return (a.name > b.name) ? 1 : ((b.name > a.name) ? -1 : 0);} );
}

function sortProperties(obj, isNumericSort)
{
    isNumericSort=isNumericSort || false; // by default text sort
    var sortable=[];
    for(var key in obj)
        if(obj.hasOwnProperty(key))
            sortable.push([key, obj[key]]);
    if(isNumericSort)
        sortable.sort(function(a, b)
        {
            return a[1]-b[1];
        });
    else
        sortable.sort(function(a, b)
        {
            var x=a[1].toLowerCase(),
                y=b[1].toLowerCase();
            return x<y ? -1 : x>y ? 1 : 0;
        });
    return sortable; // array in format [ [ key1, val1 ], [ key2, val2 ], ... ]
}
