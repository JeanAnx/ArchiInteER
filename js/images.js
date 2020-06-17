$(document).ready(function() {

  var imgs = document.getElementsByClassName('loading-image');
  var imgsJquery = $('.loading-image');
  console.log($(imgsJquery).length);
  console.log($('.spinner'));
  
  for (let i = 0; i < $(imgsJquery).length; i++) {
    $(imgsJquery[i]).on('load' , function() {
      console.log('loop');
      console.log(imgsJquery[i]);
      console.log('jquery');
      var parent = imgs[i].parentNode;
      parent.classList.remove('spinner');
      var grandParent = parent.parentNode;
      grandParent.classList.remove('spinner');
    })
    /*imgs[i].addEventListener('load', function() {
      console.log('loadded');
      setTimeout(function() {
        var parent = imgs[i].parentNode;
        var grandParent = parent.parentNode;
        grandParent.classList.remove('spinner');
      }, 500);
    });*/
  }
  
  console.log($(imgsJquery).length);
  
  
  function voitureBalai() {
      for (let i = 0; i < imgs.length; i++) {
        var parent = imgs[i].parentNode;
        parent.classList.remove('spinner');
        var grandParent = parent.parentNode;
        grandParent.classList.remove('spinner');
          }
      };
  
  setTimeout(function() {
    voitureBalai();
  }, 4000);
  

}) 