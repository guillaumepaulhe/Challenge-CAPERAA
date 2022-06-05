<div class="btn">
<span class="material-icons">
arrow_upward
</span>
</div>

<script>
  // show .btn only when scroll
  window.onscroll = function() {scrollFunction()};
  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 200) {
      document.getElementsByClassName("btn")[0].style.display = "flex";
    } else {
      document.getElementsByClassName("btn")[0].style.display = "none";
    }
  }
  
  const btn = document.querySelector('.btn');
  btn.addEventListener('click', () => {
    window.scrollTo({
      top: 0,
      left: 0,
      behavior: 'smooth'
    });
  });
  
</script>