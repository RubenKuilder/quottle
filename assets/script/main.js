// Main Javascript file
$( document ).ready(function() {
    //Pagination---
    var forgotPassPage = false;
    var registerPage = false;
    var createPage = false;
    var profilePage = false;
    var singlePage = false;
    var singleProfilePage = false;
    
    $('.stockphotos-container .stockphoto:first-child').find('input').prop( "checked", true );
    $('.stockphotos-container .stockphoto:first-child').find('img').css({'opacity':'1'});

    $('.show-register').click(function() {
        if(registerPage == false) {
            registerPage = true;

            $('.registration-page').css({'left':'0'});
            $('.icon-left').css({'display':'block'});
        }
    });
    
    $('.show-forgotpass').click(function() {
        if(forgotPassPage == false) {
            forgotPassPage = true;

            $('.forgotpass-page').css({'left':'0'});
            $('.icon-left').css({'display':'block'});
        }
    });

    $('.show-home').click(function() {
        hideAll();
        
        $('.create-page').css({'left':'-100%'});
        $('.profile-page').css({'left':'100%'});
        $('.single-page').css({'top':'100%'});
        
        
        $('.icon-home').css({'opacity':'1'});
        $('.icon-add, .icon-profile').css({'opacity':'.15'});
        $('.icon-left, .icon-right, .topbar .submit-btn').css({'display':'none'});
        $('.icon-signout').css({'display':'block'});
        
        registerPage = false;
        createPage = false;
        profilePage = false;
    });

    $('.show-create').click(function() {
        hideAll();
        
        if(createPage == false) {
            createPage = true;
            $(".postimage-container textarea").val("");
            $(".takephoto-btn").val("");

            $('.create-page').css({'left':'0'});
            $('.icon-add').css({'opacity':'1'});
            $('.icon-profile').css({'opacity':'.15'});
            $('.icon-home').css({'opacity':'.15'});
            $('.icon-left').css({'display':'block'});
            $('.topbar .submit-btn').css({'display':'inline-block'});
            $('.icon-signout').css({'display':'none'});
        }
    });

    $('.show-profile').click(function() {
        hideAll();
        
        if(profilePage == false) {
            profilePage = true;
            
            $('.profile-page').css({'left':'0'});
            $('.icon-profile').css({'opacity':'1'});
            $('.icon-add').css({'opacity':'.15'});
            $('.icon-home').css({'opacity':'.15'});
            $('.icon-left').css({'display':'block'});
            $('.icon-signout').css({'display':'none'});
        }
    });

    $('.show-single').click(function() {
        
        if($(this).hasClass('profile-post')) {
            singleProfilePage = true;
        }

        if(singleProfilePage == false) {
            hideAll();
        }
        
        console.log($(this).data('postid'));
        
        if(singlePage == false) {
            singlePage = true;

            $('.single-page').css({'top':'0'});
            $('.icon-left').css({'display':'block'});
            $('.icon-signout').css({'display':'none'});
        }
    });
    
    $(document).on("click",".icon-left, .icon-cross, .background-overlay", function() {
        if(singleProfilePage == true) {
            hideAllExceptProfile();
        } else {
            hideAll();
        }
    });
    
    function hideAll() {
        if(forgotPassPage == true) {
            forgotPassPage = false;

            $('.forgotpass-page').css({'left':'-100%'});
            $('.icon-left').css({'display':'none'});
            $('.icon-signout').css({'display':'block'});
        }
        
        if(registerPage == true) {
            registerPage = false;

            $('.registration-page').css({'left':'100%'});
            $('.icon-left').css({'display':'none'});
            $('.icon-signout').css({'display':'block'});
        }
        
        if(createPage == true) {
            createPage = false;

            $('.create-page').css({'left':'-100%'});
            $('.icon-add').css({'opacity':'.15'});
            $('.icon-profile').css({'opacity':'.15'});
            $('.icon-home').css({'opacity':'1'});
            $('.icon-left').css({'display':'none'});
            $('.topbar .submit-btn').css({'display':'none'});
            $('.icon-signout').css({'display':'block'});
        }
        
        if(profilePage == true) {
            profilePage = false;

            $('.profile-page').css({'left':'100%'});
            $('.icon-profile').css({'opacity':'.15'});
            $('.icon-add').css({'opacity':'.15'});
            $('.icon-home').css({'opacity':'1'});
            $('.icon-left').css({'display':'none'});
            $('.icon-signout').css({'display':'block'});
        }
        
        if(singlePage == true) {
            singlePage = false;
            
            console.log('hide single page');

            $('.single-page').css({'top':'100%'});
            $('.icon-left').css({'display':'none'});
            $('.icon-signout').css({'display':'block'});
        }
    };
    
    function hideAllExceptProfile() {
        if(forgotPassPage == true) {
            forgotPassPage = false;

            $('.forgotpass-page').css({'left':'100%'});
        }
        
        if(registerPage == true) {
            registerPage = false;

            $('.registration-page').css({'left':'100%'});
        }
        
        if(createPage == true) {
            createPage = false;

            $('.create-page').css({'left':'-100%'});
            $('.icon-add').css({'opacity':'.15'});
            $('.icon-profile').css({'opacity':'.15'});
            $('.icon-home').css({'opacity':'1'});
        }
        
        if(singlePage == true) {
            singlePage = false;
            singleProfilePage = false;

            $('.single-page').css({'top':'100%'});
        }
    };
    
    //Stock photo live changes---
    $('.stockphoto').click(function() {
        $(".takephoto-btn").val("");
        
        $('.stockphoto input').prop( "checked", false );
        $('.stockphoto img').css({'opacity':'0.3'});
        
        $(this).find('input').prop( "checked", true );
        $(this).find('img').css({'opacity':'1'});
        
        $('.create-page .postimage-container img').attr('src', $(this).find('img').attr('src'));
    });
    
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.create-page .postimage-container img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".takephoto-btn").change(function() {
        $('.stockphoto input').prop( "checked", false );
        $('.stockphoto img').css({'opacity':'0.3'});
        readURL(this);
    });
    
    //Load single page---
    $('.show-single').click(function(){
        var postId = $(this).data('postid');
        
        $.ajax({
            type: 'post',
            url: 'loadsingle.php',
            data: {
                postId:postId,
            },
            success: function (response) {
                $('.single-page').html(response);
            }
        });
    });
    
    //Like system---
    $(document).on("click",".likecount-container", function() {
        var postId = $(this).parent().parent().find('.postimage-container').data('postid');
        var thisPost = $(this);
        
        console.log(postId);
        
        if ($(this).find('.heart').hasClass('active')) {
            $.ajax({
                type: 'post',
                url: 'likesystem.php',
                data: {
                    update:'remove',
                    postId:postId,
                },
                success: function (response) {
                    $(thisPost).find('.heart').removeClass('active');
                    $(thisPost).find('p').html(response);
                }
            });
        } else {
            $.ajax({
                type: 'post',
                url: 'likesystem.php',
                data: {
                    update:'add',
                    postId:postId,
                },
                success: function (response) {
                    $(thisPost).find('.heart').addClass('active');
                    $(thisPost).find('p').html(response);
                }
            });
        }
    });
    
    //Comment system---
    
    $(document).on("click",".comment-submit", function(event) {
        // Stop the browser from submitting the form.
        event.preventDefault();
        
        console.log('submit clicked');

        // Serialize the form data.
        var formData = $('#comment-form').serialize();
        
        $.ajax({
            type: 'post',
            url: 'commentsystem.php',
            data: formData,
            success: function (response) {
                $('.comment-container').append(response);
            }
        });
    });
    
    //Add / remove like form post---
//    $('.likecount-container').click(function(){
//        var postId = $(this).parent().parent().find('.postimage-container').data('postid');
//        
//        console.log(postId);
//        
//        if ($(this).find('.heart').hasClass('active')) {
//            $.ajax({
//                type: 'post',
//                url: 'likesystem.php',
//                data: {
//                    postId:postId,
//                    test:'remove',
//                },
//                success: function (response) {
//                    $(this).find('.heart').removeClass('active');
//                    $(this).html(response);
//                }
//            });
//        } else {
//            $.ajax({
//                type: 'post',
//                url: 'likesystem.php',
//                data: {
//                    postId:postId,
//                    test:'add',
//                },
//                success: function (response) {
//                    $(this).find('.heart').addClass('active');
//                    $(this).html(response);
//                }
//            });
//        }
//    });
    
    // Open and close terms and conditions popup
    $('.tclink').click(function(){
        $('.tc-container').css({'display': 'block'});
    });
    
    $('.acceptTC').click(function(){
        $('.tc-container').css({'display': 'none'});
    });
});