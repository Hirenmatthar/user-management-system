$(document).ready(function() {
    $('form').submit(function(event) {
        var errors = false;
        
        // Clear any previous error messages
        $('.error-message').remove();
        
        // Validate SKU field
        var productSku = $('input[name="product_sku"]').val();
        if (productSku.trim() === '') {
            $('<span class="error-message">SKU is required.</span>').insertAfter($('input[name="product_sku"]'));
            errors = true;
        }
        
        // Validate Name field
        var productName = $('select[name="product_name"]').val();
        if (productName === '') {
            $('<span class="error-message">Name is required.</span>').insertAfter($('select[name="product_name"]'));
            errors = true;
        }
        
        // Validate Category field
        var productCategory = $('select[name="product_category"]').val();
        if (productCategory === '') {
            $('<span class="error-message">Category is required.</span>').insertAfter($('select[name="product_category"]'));
            errors = true;
        }
        
        // Validate Price field
        var productPrice = $('input[name="product_price"]').val();
        if (productPrice.trim() === '') {
            $('<span class="error-message">Price is required.</span>').insertAfter($('input[name="product_price"]'));
            errors = true;
        }
        
        // Validate Product Image field
        var productImg = $('input[name="product_img"]').val();
        if (productImg.trim() === '') {
            $('<span class="error-message">Product Image is required.</span>').insertAfter($('input[name="product_img"]'));
            errors = true;
        }
        
        // Prevent form submission if there are errors
        if (errors) {
            event.preventDefault();
        }
    });
});
