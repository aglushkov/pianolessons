var hoverImage = function() {
  var modal = document.getElementById('imgModal');
  var imgs = document.getElementsByClassName('hoverImg');
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");

  var show = function() {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  }

  for (var i=0; i < imgs.length; i++) { imgs[i].onclick = show };
  var span = document.getElementsByClassName("close")[0];
  var close = function() { modal.style.display = "none" }
  span.onclick = close
  modal.onclick = close
};

$( document ).on('turbolinks:load', hoverImage);
window.onload = hoverImage;
$(hoverImage)