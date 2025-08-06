function onLinkMethod(e) {
    let a = $(e).children('a')[0];

    window.location.href = $(a).attr('href')
}

function onSearchMethod(){
    $('#container_search_method_item').html('')

    const value = toNonAccentVietnamese($('#input_search_method').val().toLowerCase())

    if (value){
        $('.container-search-method').show()
    }else{
        $('.container-search-method').hide()
    }

    let is_have_data = false

    $(".nav-item").each(function () {
        const parent = $(this);
        const element = parent.children('a')[0];

        if (element) {

            let span = $(element).children('span');

            if ($(span).html()){
                if (toNonAccentVietnamese($(span).html().toLowerCase()).includes(value)) {

                    $('#container_search_method_item').append(`<div class="item-search-method p-3" onclick="onLinkMethod(this)">
                            <a href="${$(element).attr('href')}" style="color: black;font-size: 21px;">
                                ${$(span).html()}
                            </a>
                        </div>`)

                    is_have_data = true;
                }
            }


        }
    });

    if (!is_have_data){
        $('#container_search_method_item').append(`<div class="item-search-method p-3">
                            <a href="#" style="color: red;font-size: 21px;">
                                Không có dữ liệu
                            </a>
                        </div>`)
    }
}

$(document).ready(function () {
    $(".nav-item").each(function () {
        const parent = $(this);
        parent.removeClass('active')
        const element = parent.children('a')[0];

        if (element) {
            if (window.location.href.includes($(element).attr('href'))) {
                parent.addClass('active')

                $('#container_slidebar').animate({scrollTop: parent.offset().top - 200}, '1500');

                return
            }
        }
    });


    $('#bg').on('click', function(e) {
        if (e.target === this) {
            $('.container-search-method').hide()
        }

    });


});
