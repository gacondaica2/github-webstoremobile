$(document).ready(function() {
    $(document).on('click' , '.cart-plus-item', function() {
        var id =$(this).data('id')
        alert(id)
        addTocart(id)
    })

    $(document).on('click' , '.cart-mines-item', function() {
        var id =$(this).data('id')
        minesItemCart(id)
    })
    function addTocart(id) {
        $.ajax({
            url: '/home/danh-muc/cart/plus/' + id,
            success: function(response) {
               
            }
        })
    }

    function minesItemCart(id) {
        $.ajax({
            url: '/home/danh-muc/cart/mines/' + id,
            success: function(response) {
               
            }
        })
    }
})