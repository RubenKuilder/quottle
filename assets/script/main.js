// Main Javascript file
// A $( document ).ready() block.
$( document ).ready(function() {
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
    
    $('.icon-left').click(function(){
        if(singleProfilePage == true) {
            hideAllExceptProfile();
        } else {
            hideAll();
        }
    });
    
    function hideAll() {
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

            $('.single-page').css({'top':'100%'});
            $('.icon-left').css({'display':'none'});
            $('.icon-signout').css({'display':'block'});
        }
    };
    
    function hideAllExceptProfile() {
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
    
    $('.stockphoto').click(function() {
        console.log($(this).find('input'));
        $('.stockphoto input').prop( "checked", false );
        $('.stockphoto img').css({'opacity':'0.3'});
        
        $(this).find('input').prop( "checked", true );
        $(this).find('img').css({'opacity':'1'});
        
        $('.create-page .postimage-container img').attr('src', $(this).find('img').attr('src'));
    });
});