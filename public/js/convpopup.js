// BE MY TUTOR POPUP
$(document).ready(function($) {
    $('.tutor-popup-open').click(function() {
        $('.tutor-popup-fade').fadeIn();
        return false;
    });

    $('.tutor-popup-close').click(function() {
        $(this).parents('.tutor-popup-fade').fadeOut();
        return false;
    });
// press ESC for close
    $(document).keydown(function(e) {
        if (e.keyCode === 27) {
            e.stopPropagation();
            $('.tutor-popup-fade').fadeOut();
        }
    });
// Click on any place for close
    $('.tutor-popup-fade').click(function(e) {
        if ($(e.target).closest('.tutor-popup').length == 0) {
            $(this).fadeOut();
        }
    });
});


// ALERT POPUP
$(document).ready(function($) {
    $('.alert-popup-open').click(function() {
        $('.alert-popup-fade').fadeIn();
        return false;
    });

    $('.alert-popup-close').click(function() {
        $(this).parents('.alert-popup-fade').fadeOut();
        return false;
    });
// press ESC for close
    $(document).keydown(function(e) {
        if (e.keyCode === 27) {
            e.stopPropagation();
            $('.alert-popup-fade').fadeOut();
        }
    });
// Click on any place for close
    $('.alert-popup-fade').click(function(e) {
        if ($(e.target).closest('.alert-popup').length == 0) {
            $(this).fadeOut();
        }
    });
});


// CONFIRM ALERT POPUP
$(document).ready(function($) {
    $('.confirm-alert-popup-open').click(function() {
        $(this).parents('.alert-popup-fade').fadeOut();
        $('.confirm-alert-popup-fade').fadeIn();
        return false;
    });

    $('.confirm-alert-popup-close').click(function() {
        $(this).parents('.confirm-alert-popup-fade').fadeOut();
        $(this).parents('.alert-popup-fade').fadeOut();
        return false;
    });

// press ESC for close
    $(document).keydown(function(e) {
        if (e.keyCode === 27) {
            e.stopPropagation();
            $('.confirm-alert-popup-fade').fadeOut();
            $('.alert-popup-fade').fadeOut();
        }
    });
    /* Click on any place for close
           $('.confirm-alert-popup-fade').click(function(e) {
               if ($(e.target).closest('.confirm-alert-popup').length == 0) {
                   $(this).fadeOut();
               }
           });

    */
});


// SIGNALER POPUP
$(document).ready(function($) {
    $('.signaler-popup-open').click(function() {
        $(this).parents('.alert-popup-fade').fadeOut();
        $('.signaler-popup-fade').fadeIn();
        return false;
    });

    $('.signaler-popup-close').click(function() {
        $(this).parents('.signaler-popup-fade').fadeOut();
        $(this).parents('.alert-popup-fade').fadeOut();
        return false;
    });
// press ESC for close
    $(document).keydown(function(e) {
        if (e.keyCode === 27) {
            e.stopPropagation();
            $('.signaler-popup-fade').fadeOut();
            $('.alert-popup-fade').fadeOut();
        }
    });
    /* Click on any place for close
            $('.signaler-popup-fade').click(function(e) {
                if ($(e.target).closest('.signaler-popup').length == 0) {
                    $(this).fadeOut();
                }
            });

     */

    <!----- Droplist logic ----->

    let selectHeader = document.querySelectorAll('.select_title');
    let selectItem   = document.querySelectorAll('.select_item');

    selectHeader.forEach(item=>{item.addEventListener('click', selectToggle)});

    selectItem.forEach(item=>{item.addEventListener('click', selectSelect)})

    function selectToggle() {
        this.parentElement.classList.toggle('is-active');
    }

    function selectSelect() {
        let select_tag = this.innerText;
        select = this.closest('.select');
        currentTag = select.querySelector('.select_current');
        currentTag.innerText = select_tag;
        select.classList.remove('is-active');
    }

});
