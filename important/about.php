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
    <img src="assets/images/about/1.png" alt="GLIMLACH - Premium Wellness Laboratory">
  </div>

  <div class="glimlach-step">
    <img src="assets/images/about/2.png" alt="GLIMLACH - Happy Wellness Customer">
  </div>

  <div class="glimlach-step">
    <img src="assets/images/about/3.png" alt="GLIMLACH - Ayurvedic Wellness Products">
  </div>

  <div class="glimlach-step">
    <img src="assets/images/about/4.png" alt="GLIMLACH - Healthy Indian Lifestyle">
  </div>

  <div class="glimlach-step">
    <img src="assets/images/about/5.png" alt="GLIMLACH - Quality Manufacturing">
  </div>

  <div class="glimlach-step">
    <img src="assets/images/about/6.png" alt="GLIMLACH - Trusted by Customers">
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
  margin-top: 0 !important;
  padding-top: 0 !important;
  border-top: none !important;
}

.glimlach-step {
  width: 100%;
  overflow: hidden;
  border: none;
}

.glimlach-step img {
  width: 100%;
  height: auto;
  display: block;
  object-fit: cover;
}

hr {
  display: none !important;
}

@media (max-width: 768px) {
  .glimlach-step img {
    width: 100%;
    height: auto;
  }
}
</style>


<?php require_once 'includes/footer.php'; ?>
