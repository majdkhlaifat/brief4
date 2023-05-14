$(document).ready(function(){
    $('#search-input').keyup(function(){
        var searchTerm = $(this).val();
        $.ajax({
            url: 'search.php',
            method: 'POST',
            data: {searchTerm: searchTerm},
            success: function(response){
                var products = JSON.parse(response);
                var html = '';
                products.forEach(function(product){
                    html += '<div class="col-sm-4 mb-3">';
                    html += '<div class="card">';
                    html += '<img src="' + product.img + '" class="card-img-top" alt="...">';
                    html += '<div class="card-body">';
                    html += '<h5 class="card-title">' + product.name + '</h5>';
                    html += '<p class="card-text">' + product.description + '</p>';
                    html += '<p class="card-text"><small class="text-muted">Price: ' + product.price + '</small></p>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                });
                $('product-container').html(html);
            }
        });
    });
});
