var menu = document.querySelector('.nav__list');
var burger = document.querySelector('.burger');
var doc = $(document);
var l = $('.scrolly');
var panel = $('.panel');
var vh = $(window).height();
//alert('hi');
menu.classList.toggle('nav__list--active');
var openMenu = function() {
  //burger.classList.toggle('burger--active');
  //menu.classList.toggle('nav__list--active');
  //alert('hi');
};
//alert('hi');
// reveal content of first panel by default
panel.eq(0).find('.panel__content').addClass('panel__content--active');
//alert('hi');
var scrollFx = function() {
  var ds = doc.scrollTop();
  var of = vh / 4;
  //alert('hi');
  // if the panel is in the viewport, reveal the content, if not, hide it.
  for (var i = 0; i < panel.length; i++) {
    
     panel
       .eq(i)
       .find('.panel__content')
       .addClass('panel__content--active');
    
  }
};
//alert('hi');
var scrolly = function(e) {
  e.preventDefault();
  var target = this.hash;
  var $target = $(target);

  $('html, body').stop().animate({
      'scrollTop': $target.offset().top
  }, 300, 'swing', function () {
      window.location.hash = target;
  });
}
//alert('hi');
var init = function() {
  //alert('hi');
  burger.addEventListener('click', openMenu, false);
  //alert('hi');
  window.addEventListener('scroll', scrollFx, false);
  window.addEventListener('load', scrollFx, false);
  //alert('hi');
  $('a[href^="#"]').on('click',scrolly);
  //alert('hi');
};
//alert('hi');
doc.on('ready', init);
//alert('hi');