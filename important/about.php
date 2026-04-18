<?php
require_once 'includes/config.php';
$pageTitle       = 'Trusted Wellness Brand | Pure Herbal Products India';
$metaDescription = 'Discover the story behind India\'s premium wellness brand. We bring you pure, safe herbal supplements and natural health products for holistic wellness.';
$metaKeywords    = 'wellness brand india, herbal company india, natural wellness brand, wellness manufacturer, trusted products india';
$canonicalUrl    = 'https://glimlach.in/best-wellness-brand-india';
require_once 'includes/header.php';
?>


<!-- STEP WISE IMAGE SECTION -->
<section class="glimlach-steps">

  <div class="glimlach-step">
    <img src="assets/images/about/1.jpeg" alt="Step 01">
  </div>

  <div class="glimlach-step" style="width:100%; height:100%; overflow:hidden;">
    <video 
      src="assets/images/about/2.mp4"
      autoplay
      muted
      loop
      playsinline
      style="
        width:100%;
        height:auto;
        object-fit:contain;
        display:block;
      "
    ></video>
  </div>

  <div class="glimlach-step">
    <img src="assets/images/about/3.jpeg" alt="Step 03">
  </div>

  <div class="glimlach-step">
    <img src="assets/images/about/4.jpeg" alt="Step 04">
  </div>

  <div class="glimlach-step" style="width:100%; height:100%; overflow:hidden;">
    <video 
      src="assets/images/about/5.mp4"
      autoplay
      muted
      loop
      playsinline
      style="
        width:100%;
        height:auto;
        object-fit:contain;
        display:block;
      "
    ></video>
  </div>

  <div class="glimlach-step">
    <img src="assets/images/about/6.jpeg" alt="Step 06">
  </div>

</section>

<style>
/* ===== GLIMLACH VERTICAL STEPS ===== */
.glimlach-steps {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 0;
  background: #fff;

  /* 🔥 LINE REMOVE FIX */
  margin-top: 0 !important;
  padding-top: 0 !important;
  border-top: none !important;
}

/* Each step */
.glimlach-step {
  width: 100%;
  overflow: hidden;
  border: none;
}

/* Images */
.glimlach-step img {
  width: 100%;
  height: auto;
  display: block;
  object-fit: contain;
}

/* Videos (same as image) */
.glimlach-step video {
  width: 100%;
  height: auto;
  display: block;
  object-fit: contain;
}

/* 🔥 Global HR / border safety (line wahi se aa rahi thi) */
hr {
  display: none !important;
}

/* Mobile safe */
@media (max-width: 768px) {
  .glimlach-step img,
  .glimlach-step video {
    width: 100%;
    height: auto;
  }
}
</style>


<?php require_once 'includes/footer.php'; ?>
