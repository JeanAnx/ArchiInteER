
var imgs = document.getElementsByClassName('loading-image');
for (let i = 0; i < imgs.length; i++) {
  imgs[i].addEventListener('load', function() {
    setTimeout(function() {
      var parent = imgs[i].parentNode;
      var grandParent = parent.parentNode;
      grandParent.classList.remove('spinner');
    }, 500);
  });
}

function voitureBalai() {
    for (let i = 0; i < imgs.length; i++) {
      var parent = imgs[i].parentNode;
      var grandParent = parent.parentNode;
      grandParent.classList.remove('spinner');
        }
    };

setTimeout(function() {
  voitureBalai();
  console.log('VOITURE BALAIIIII');
}, 5000);
