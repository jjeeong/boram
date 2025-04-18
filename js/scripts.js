/*!
* Start Bootstrap - Grayscale v7.0.6 (https://startbootstrap.com/theme/grayscale)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-grayscale/blob/master/LICENSE)
*/
//
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

    // Shrink the navbar 
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);

    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            rootMargin: '0px 0px -40%',
        });
    };

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

});



/* 제이쿼리 */


jQuery(document).ready(function(){

    $(".btn").click(function(){ 
        $(".text").addClass("active"); // 카운트 세는거 나타내기
        $(".bbi").addClass("active"); // 영상 나타내기
        $(".btn").addClass("chbtn"); //start 버튼 없애기
        $(".stbtn").addClass("active"); //저장 버튼 나타내기
    });
    /* 이벤트 페이지 세가지 포즈 뭐시기 3초 후에 사라지게끔 하는거 */
    $(document).ready(function() {
        $(".btn").click(function() {
          $(".message_box").addClass("cnt").fadeIn(300, function() {
            setTimeout(function() {
              $(".message_box").removeClass("cnt").fadeOut(300);
            }, 3000);
          });
          $(".message").addClass("cnt").fadeIn(300, function() {
            setTimeout(function() {
              $(".message").removeClass("cnt").fadeOut(300);
            }, 3000);
          });
        });
      });      
});

jQuery(document).ready(function(){
    function displaySuccessMessage() {
        $('.success-message').show();
      }
});