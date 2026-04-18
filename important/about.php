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
    <img src="assets/images/about/1.png" alt="GLIMLACH - Premium Wellness Laboratory" loading="eager">
  </div>

  <div class="glimlach-step">
    <img src="assets/images/about/2.png" alt="GLIMLACH - Happy Wellness Customer" loading="eager">
  </div>

  <div class="glimlach-step">
    <img src="assets/images/about/3.png" alt="GLIMLACH - Ayurvedic Wellness Products" loading="eager">
  </div>

  <div class="glimlach-step">
    <img src="assets/images/about/4.png" alt="GLIMLACH - Healthy Indian Lifestyle" loading="eager">
  </div>

  <div class="glimlach-step">
    <img src="assets/images/about/5.png" alt="GLIMLACH - Quality Manufacturing" loading="eager">
  </div>

  <div class="glimlach-step">
    <img src="assets/images/about/6.png" alt="GLIMLACH - Trusted by Customers" loading="eager">
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
  border: none;
  line-height: 0;
}

.glimlach-step img {
  width: 100%;
  height: auto;
  display: block;
  max-width: 100%;
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
