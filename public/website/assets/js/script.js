
$(document).ready(function(){
  $(".validation__input-box input").keyup(function () {
    if($(this).val().length > 0){ 
    $(this).parent('.validation__input-box ').children('label').addClass('hidden-validate');
    // $(this).parent('.validation__input-box ').children('small').css("display", "none");
    }else{    
      $(this).parent('.validation__input-box ').children('label').removeClass('hidden-validate');
    }
    });

    $('body').css('opacity',1)
});


$(document).ready(function(){
  $(".form__field input").keyup(function () {
    if($(this).val().length > 0){ 
    $(this).parent('.form__field').children('label').addClass('hidden-validate');
    // $(this).parent('.validation__input-box ').children('small').css("display", "none");
    }else{    
      $(this).parent('.form__field').children('label').removeClass('hidden-validate');
    }
    });

    $('body').css('opacity',1)
});
ScrollReveal({
  /*  reset: true, */
  distance: "300px",
  duration: 1500,
  delay: 200,
});

ScrollReveal().reveal(".main-banner__img", { delay: 500, origin: "right", mobile: false });
ScrollReveal().reveal(".main-banner__info", { delay: 500, origin: "bottom", mobile: false });
ScrollReveal().reveal(".testimonial-info", { delay: 500, origin: "left", mobile: false });
ScrollReveal().reveal(".number-div__div", { delay: 100, origin: "bottom",interval: 30, mobile: true, afterReveal: function () {
   
  $('.counter').each(function() {
    // $('.number-div__div div:first-of-type').css('opacity', "1");
    var $this = $(this),
        countTo = $this.attr('data-count');
    
    $({ countNum: $this.text()}).animate({
      countNum: countTo
    },
  
    {
  
      duration: 5000,
      easing:'linear',
      step: function() {
        $this.text(Math.floor(this.countNum));
      },
      complete: function() {
        $this.text(this.countNum);
        //alert('finished');
      }
  
    });  
    
    
  
  });
}}); 
ScrollReveal().reveal(".colaborate-text", { delay: 500, origin: "bottom", mobile: false });
ScrollReveal().reveal(".examples-div", { delay: 500, origin: "bottom",interval: 200,  mobile: false });
ScrollReveal().reveal(".whyus-info", { delay: 500, origin: "left", mobile: false });
ScrollReveal().reveal(".whyus-img", { delay: 500, origin: "right", mobile: false });
ScrollReveal().reveal(".offering-info", { delay: 500, origin: "bottom", mobile: false });
ScrollReveal().reveal(".card", { delay: 500, origin: "bottom",interval: 200, mobile: false });
ScrollReveal().reveal(".speciality1", { delay: 500, origin: "left", mobile: false });
ScrollReveal().reveal(".speciality2", { delay: 500, origin: "right", mobile: false });
ScrollReveal().reveal(".project-img__grid-div", { delay: 500, origin: "bottom",interval: 200, mobile: false });
ScrollReveal().reveal(".project-detail_img", { delay: 500, origin: "left", mobile: false });
ScrollReveal().reveal(".unicsale div", { delay: 500, origin: "right",interval: 100, mobile: false });
ScrollReveal().reveal(".project-detail_services div", { delay: 500, origin: "right",interval: 100, mobile: false }); 

$(document).ready(function(){
 $('.partner_slider').slick({
    arrows:false,
    dots:false,
    autoplay:true,
    slidesToShow:5,
    slidesToScroll:1,
    speed:500,
    infinity:true,
    draggable:true,
    responsive:[
      {
        breakpoint:1100,
        settings:{
          slidesToShow:3,
          slidesToScroll:1,
        }
      },
      {
        breakpoint:800,
        settings:{
          slidesToShow:2,
          slidesToScroll:1,
        }
      }
      

    ]
       
 });


   $('.testimonial-slider').on('init', function(event, slick) {
     $(this).append('<div class="slick-counter"><span class="current"></span> / <span class="total"></span></div>');
     $('.current').text(slick.currentSlide + 1);
     $('.total').text(slick.slideCount);
     ScrollReveal().sync();
   })

   .slick({
      arrows:true,
      dots:false,
      autoplay:true,
      slidesToShow:1,
      slidesToScroll:1,
      speed:3000,
      fade: true,
   })
   .on('beforeChange', function(event, slick, currentSlide, nextSlide) {
     $('.current').text(nextSlide + 1);
   })
   $(".testimonial-slider .slick-prev").addClass("active-arrow")
   $(".testimonial-slider .slick-next").click(
    function(){
      $(".testimonial-slider .slick-prev").removeClass("active-arrow")
      $(".testimonial-slider .slick-next").addClass("active-arrow")
    }
   )
   $(".testimonial-slider .slick-prev").click(function(){
    
    $(".testimonial-slider .slick-next").removeClass('active-arrow')
    $(".testimonial-slider .slick-prev").addClass('active-arrow')
   })






 $(".offering-slider").each((i,slider) => {
  /* console.log(slick.slideCount); */
  $(slider).find('.offering-slider-background__info').prepend('<div class="offering-num"><div class="offering-current-slide"></div></div>');

  $(slider).find('.offering-current-slide').each(function(index,element){
   /*  console.log(index) */
    $(element).text((index + 1).toString().padStart(2,'0'))
  })

  $(slider).slick({
    arrows:true,
    autoplay:true,
    infinity:true,
    slidesToShow:2,
    slidesToScroll:1,
    speed:500,
    responsive:[
      {
        breakpoint:1100,
        settings:{
          slidesToShow:1,
          slidesToScroll:1,
        }
      },
    ]
    });
    // $(".slick").on("afterChange", function(event, slick, currentSlide){
    //   /* console.log(slick.currentSlide+1) ;*/
    // });
  });
 
 
 




$("#applay").click(function(){
  $(".aplication-form").css("display", "block"),
  $(".aplication-form_background").css("display", "block"),
  $(".aplication-form__form").css("display", "block"),
  $('body').css("overflow","hidden")
 
})

$(".aplication-form_background").click(function(){
  $(".aplication-form_background").css("display", "none"),
  $(".aplication-form__form").css("display", "none"),

  location.reload(true)
})
});


$('#aplication-file').on('change' , function(){
  
  let i =$(this).prev('label').clone();
  let file = $('#aplication-file')[0].files[0].name 
   $(this).prev('label').text( file) 
})
$(document).ready(function(){
  $(document).on("change", ".inputfile",function(){
    console.log($(this).prev('label').text());
    let file = $(this)[0].files[0].name; 
    $(this).closest(".colaboration-files").find('.labelinputfile').text(
      "Uploads Files: "  +  $(this)[0].files.length 
      );
    
    // $(this).closest(".colaboration-files").find('.alert__01').text($(this)[0].files.length);
  })
});
$('.burger-icon').click(function(){
  $('.burger').toggleClass("active-menu");
  $('.span2').toggleClass('span-x2')
  $('.span1').toggleClass('span-x1')
  $('.span3').toggleClass('span-x3')

});

$('.service-alert-x').click(function(){
  $('.service-alert-background').css('display','none');
  $('.service-alert').css('display','none'); 

});
setTimeout(function() {
  $('.service-alert-background').fadeOut('fast');
}, 3000);
setTimeout(function() {
  $('.service-alert').fadeOut('fast');
}, 3000);

$(document).ready(function () {
  setTimeout(function () {
      $('.service-alert-background').addClass("hidden")
  }, 3E3)
});

// const contactBox = document.querySelector(".contact-container");
// const contactBtn = document.querySelector(".contact-btn");


// contactBtn.addEventListener("click", () => {
//   contactBox.style = "display: flex;"; 
// });
// window.addEventListener("click", (e) => {
//   if (e.target == contactBox) {
//     contactBox.style = "display: none;";
//     location.reload(true)
//   }
  
// });


$(document).ready(function(e) { 
  $('.contact-btn').click(function(){
    $('.contact-container').css('display', 'flex');
  })
  $('.contact-form-img').click(function(){
    $('.contact-container').css('display', 'none');
  })

});










 
