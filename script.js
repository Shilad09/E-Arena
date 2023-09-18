$(document).ready(function(){

    const loadDataHome = function(){
        $.ajax({
            url: 'server/fetch-product.php',
            type: 'POST',
              success: function(data){
                  $('#product-details').html(data)
                }
              })
    }

    const loadDataProduct = function(){
        $.ajax({
            url: 'server/all.php',
            type: 'POST',
              success: function(data){
                  $('#all-pro-id').html(data)
                }
              })
    }

    $('#signup-form').on('submit', function(e){
        e.preventDefault();

        $('#usubmit').hide()
        $('#spinner').show()

        $.ajax({
            url: 'server/signup.php',
            type: 'POST',
            data: $('#signup-form').serialize(),
            success: function(data){
                if(data == 'email_exists'){
                    $('#spinner').hide()
                    $('#usubmit').show()
                    $('#alert-box').show().html('Email already exists, try with another email').fadeOut(3000);
                    $('#signup-form').trigger('reset')
                }
                else if(data == 'error'){
                    $('#alert-box').show().html('Error! please try again').fadeOut(3000);
                }
                else{
                    $('#signup-form').hide()
                    $('#otp-form').show()

                    const last_id = data;

                    $('#otp-form').on('submit', function(e){
                        e.preventDefault();
                        $.ajax({
                            url: 'server/auth.php',
                            type: 'POST',
                            data: {'last_id': last_id, 'uotp': $('#uotp').val()},
                            success: function(data){
                                if(data == 'error'){
                                    $('#alert-box').show().html('Error! please try again').fadeOut(3000);
                                }
                                else if(data == true){
                                    window.location.href = './login.html';
                                }else{
                                    $('#alert-box').show().html('Please enter a valid otp').fadeOut(3000);
                                }
                            }
                        })

                    })

                    
                }
            }
        })
    })

    $('#login-form').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url: 'server/login.php',
            type: 'POST',
            data: $('#login-form').serialize(),
            success: function(data){
                if(data == 1){
                    window.location.href = './index.html';
                }
                else{
                    $('#alert-box').show().html('Please enter a valid email and password').fadeOut(3000);
                }
            }
        })
    })

    $.ajax({
        url: 'server/check-session.php',
        type: 'POST',
        dataType: 'json',
        success: function(data){
            if(data.auth == true){
                $('#profile').mouseover(function(){
                    $('#hover-box-user').css({
                      'display': 'block',
                      'position': 'fixed',
                      'top': '10%',
                      'left': '75%',
                      'width': '25%',
                      'height': '50px',
                      'cursor': 'pointer'
                    });
                  })
              
                  $('#hover-box-user').mouseenter(function(){
                    $('#hover-box-user').css({
                      'display': 'block',
                      'position': 'fixed',
                      'top': '10%',
                      'left': '75%',
                      'width': '25%',
                      'height': '50px'
                    });
                  })
                  $('#hover-box-user').mouseleave(function(){
                    $('#hover-box-user').css({
                      'display': 'none',
                      'z-index': '100'
                    });
                  })

                if(data.admin == 1){
                    
                    $('#order_id').show().html('Admin panel');
                    $('#order_id').click(function(){
                        window.location.href = './product.html';
                    })
                }
                else{
                    $('#order_id').show().html(data.name + "'s lists");
                    $('#order_id').click(function(){
                        window.location.href = './user.html';
                    })
                }
            }
            else{
                $('#profile').mouseover(function(){
                    $('#hover-box-default').css({
                        'display': 'block',
                        'position': 'fixed',
                        'top': '10%',
                        'left': '75%',
                        'width': '25%',
                        'height': '50px',
                        'cursor': 'pointer'
                    });
                })

                    $('#hover-box-default').mouseenter(function(){
                    $('#hover-box-default').css({
                        'display': 'block',
                        'position': 'fixed',
                        'top': '10%',
                        'left': '75%',
                        'width': '25%',
                        'height': '50px'
                    });
                    })
                    $('#hover-box-default').mouseleave(function(){
                    $('#hover-box-default').css({
                        'display': 'none',
                        'z-index': '100'
                    });
                    })
            }
        }
    })

    $('#logout-btn').click(function(){
        $.ajax({
            url: 'server/logout.php',
            type: 'POST',
            success: function(data){
                if(data == 1){
                 window.location.reload();
                }
            }
        })
    })
    
    $('#p-img').on('change' ,function(e){
        const input = this;
        const reader = new FileReader();

        reader.readAsDataURL(input.files[0])

        reader.onload = () => {
            $('#preview').children('#preview-img').attr('src', reader.result)
        }
    })

    $('#product-form').on('submit', function(e){
        e.preventDefault();

        let input = new FormData(this);

        $.ajax({
            url: 'server/product.php',
            type: 'POST',
            data: input,
            contentType: false,
            processData: false,
            success: function(data){
                loadDataProduct()
                $('#product-form').trigger('reset')
                $('#preview').children('#preview-img').attr('src', 'images/dummy-image-square-300x300.jpg')
            }
        })
    })

    $('#user-email-form').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url: 'server/user-details.php',
            type: 'POST',
            data: $('#user-email-form').serialize(),
            success: function(data){
                $('#one-user-table').html(data)
            }
        })
    })

    $(document).on('click', '.card', function(){
        $('#pro-module').show();
        $('body').css('overflow', 'hidden');

        const id = $(this).data('id');
        $.ajax({
            url: 'server/fetch-box.php',
            type: 'POST',
            data: {'id': id},
            success: function(data){
                $('#module-box').html(data)
            }
        })
    })

    $(document).on('click', '#pro-module, .x, .y', function(e){
        e.stopPropagation();
    })

    $('#module-close-btn').click(function(e){
        $('#pro-module').hide();
        $('body').css('overflow-y', 'scroll');
    })

    $('#search-field').on('keyup', function(){
        $.ajax({
            url: 'server/search.php',
            type: 'POST',
            data: {'search_ele' : $('#search-field').val()},
            success: function(data){
                $('#product-details').html(data)
            }
        })
    })

    $(document).on('click', '#edit-btn', function(e){
        $.ajax({
            url: 'server/edit.php',
            type: 'POST',
            data: {'id' : $(this).data('id')},
            success: function(data){
                $('#one-details-parent').show()
                $('#one-details').html(data);
            }

        })
    })

    $('#one-details-close-btn').click(function(){
        $('#one-details-parent').hide()
    })

    $(document).on('submit', '#one-details-form', function(e){
        e.preventDefault();

        const input = new FormData(this);

        $.ajax({
            url: 'server/edit-update.php',
            type: 'POST',
            data: input,
            contentType: false,
            processData: false,
            success: function(data){
                console.log(data)
                $('#one-details-parent').hide()
                loadDataProduct();
            }
        })
    })

    $(document).on('click', '#delete-btn', function(e){
        if(confirm("Are you want to delete item? ")){
            $.ajax({
                url: 'server/delete.php',
                type: 'POST',
                data: {'id' : $(this).data('id')},
                success: function(data){
                    loadDataProduct()
                }
            })
        }
    })

    $(document).on('click', '#buy-btn', function(e){
        e.stopPropagation();
        const id = $(this).data('id');

        $.ajax({
            url: 'server/buy.php',
            type: 'POST',
            data: {'id' : id},
            success: function(data){
                if(data == 'not_logged_in'){
                    window.location.href = './login.html';
                }
                else{
                    $('#buy-box').show()
                    $('#buy-box-sub').html(data)
                }
            }
        })

        
    })

    $('#buy-box-close-btn').click(function(){
        $('#buy-box').hide();
    })

    $(document).on('submit', '#buyer-form', function(e){
        e.preventDefault();

        const buyer_num = $('#buyer-num').val()
        const buyer_add = $('#buyer-add').val()
        const prod_id = $('#buy-now-btn').data('id')

        $.ajax({
            url: 'server/payment.php',
            type: 'POST',
            data: {'product_name' : $('#product-name').html(), 'product_price' : $('#product-price-num').html(), 'buyer_num' : buyer_num, 'buyer_add' : buyer_add, 'prod_id': prod_id},
            success: function(data){
                // console.log(data)
                window.location.href = data;
            }
        })
    })
})