$(document).ready(function() {
  var imgs = document.getElementsByClassName('loading-image');
  var imgsJquery = $('.loading-image');  
  for (let i = 0; i < $(imgsJquery).length; i++) {
    $(imgsJquery[i]).on('load' , function() {
      var parent = imgs[i].parentNode;
      parent.classList.remove('spinner');
      var grandParent = parent.parentNode;
      grandParent.classList.remove('spinner');
    })
  }  
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
