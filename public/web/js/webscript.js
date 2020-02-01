var ratedIndex = -1;
uID = 0;
$("#review-message").hide();


$('#form-review').bind("submit", function(event) {
    event.preventDefault();

    var me = $(this);

    $.ajax({
        url: "{{URL::TO('vendor-review')}}",
        type: "POST",
        data: me.serialize(),
        dataType: 'json',
        success: function(response) {

            $("#review-message").show();
            $('#review-message').append('<div  id="rad" class="alert-success">' + response.message + '</div>');
            $('#review-message').delay(500).show(10, function() {
                $(this).delay(1000).hide(10, function() {
                    $('#rad').remove();
                });
            })

        }
    });
});

$(document).ready(function() {
    $("#alert-success").hide();



    resetStarColors();

    if (localStorage.getItem('ratedIndex') != null) {
        setStars(parseInt(localStorage.getItem('ratedIndex')));
        uID = localStorage.getItem('uID');
    }

    $('.fa-star').on('click', function() {
        ratedIndex = parseInt($(this).data('index'));
        localStorage.setItem('ratedIndex', ratedIndex);
        saveTotheDB()
    });

    $('.fa-star').mouseover(function() {
        resetStarColors();

        var currentIndex = parseInt($(this).data('index'));

        setStars(currentIndex);
    });

    $('.fa-star').mouseleave(function() {
        resetStarColors();

        if (ratedIndex != -1)
            setStars(ratedIndex);

    });
});

function setStars(max) {
    for (var i = 0; i <= max; i++)
        $('.fa-star:eq(' + i + ')').css('color', 'green');
}

function saveTotheDB() {
    $.ajax({
        url: "{{URL::TO('vendor-rating')}}",
        method: "GET",
        dataType: 'json',
        data: {
            save: 1,
            uID: uID,
            ratedIndex: ratedIndex,
            vendor_id: {
                { $id } }
        },
        success: function(r) {
            uID = r.id;
            localStorage.setItem('uID', uID);

            $("#alert-success").show();
            $('#alert-success').append('<div  id="mad" class="alert-success">Thank you for the rating!!!</div>');
            $('#alert-success').delay(500).show(10, function() {
                $(this).delay(1000).hide(10, function() {
                    $('#mad').remove();
                });
            })
        }
    })
}

function resetStarColors() {
    $('.fa-star').css('color', '#ffb200');
}