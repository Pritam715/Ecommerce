$(document).ready(function () {
    $('.category_checkbox ,.brand_checkbox').on('click', function () {

        var ids = [];
        var brands = [];


        var counter = 0;
        $('#catFilters').empty();
        $('.category_checkbox').each(function () {
            if ($(this).is(":checked")) {
                ids.push($(this).attr('id'));
                $('#catFilters').append(`<div class="alert fade show alert-color _add-secon" role="alert"> ${$(this).attr('attr-name')}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> </div>`);
                counter++;
            }
        });
        $('.brand_checkbox').each(function () {
            if ($(this).is(":checked")) {
                brands.push($(this).attr('id'));
                $('#catFilters').append(`<div class="alert fade show alert-color _add-secon" role="alert"> ${$(this).attr('attr-name')}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> </div>`);
                counter++;
            }
        });



        $('._t-item').text('(' + ids.length + ' items)');

        if (counter == 0) {
            $('.causes_div').empty();
            $('.causes_div').append('No Data Found');
        } else {
            fetchCauseAgainstCategory(ids, brands);
        }
    });




});


function fetchCauseAgainstCategory(id, brand) {

    $('.causes_div').empty();
    console.log(id);
    console.log(brand);
    $.ajax({
        type: 'GET',
        url: 'get_causes_against_category',
        data: { 'id': id, 'brand': brand },
        // url: 'get_causes_against_category/' + id,

        success: function (response) {
            var response = JSON.parse(response);
            // console.log(response);
            display = response;

            if (response.length == 0) {
                $('.causes_div').append('No Data Found');
            } else {
                $.each(display, function (i, member) {
                    $('.causes_div').append(`
                    <li>
                    <figure>
                      <a class="aa-product-img" href="dp/${display[i].slug}"><img src="Images/Product/${display[i].product_image}" width="100%"  class="image-size" alt="polo shirt img"></a>
                      <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                      <figcaption>
                        <h4 class="aa-product-title"><a href="#">${display[i].product_name}</a></h4>
                        <span class="aa-product-price">${display[i].product_price}</span>
                        <p class="aa-product-descrip">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam accusamus facere iusto, autem soluta amet sapiente ratione inventore nesciunt a, maxime quasi consectetur, rerum illum.</p>
                      </figcaption>
                    </figure>                         
                    <div class="aa-product-hvr-content">
                      <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                      <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                      <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
                    </div>
                    <!-- product badge -->
                    <span class="aa-badge aa-sale" href="#">SALE!</span>
                  </li>
                    `);
                });
            }
        }
    });
}