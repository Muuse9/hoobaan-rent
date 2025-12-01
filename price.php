<?php 
require "includes/header.php"; 
require "config/config.php"; 

// Get all props for slider or default display
$select = $conn->prepare("SELECT * FROM props ORDER BY name DESC");
$select->execute();
$props = $select->fetchAll(PDO::FETCH_OBJ);

$allListingsPrice = [];
$allListings = [];

// Check if either type or price filter is set
if (isset($_GET['type']) && !empty($_GET['type'])) {
    $type = $_GET['type'];

    // Prepare and execute safely
    $rent = $conn->prepare("SELECT * FROM props WHERE type = :type");
    $rent->execute(['type' => $type]);
    $allListings = $rent->fetchAll(PDO::FETCH_OBJ);

} elseif (isset($_GET['price']) && !empty($_GET['price'])) {
    $price = strtoupper($_GET['price']);

    // Validate price order value
    if ($price === 'ASC' || $price === 'DESC') {
        $price_query = $conn->prepare("SELECT * FROM props ORDER BY price $price");
        $price_query->execute();
        $allListingsPrice = $price_query->fetchAll(PDO::FETCH_OBJ);
    } else {
        // Invalid price param, redirect or show error
        echo "<script>window.location.href='".APPURL."/index.php';</script>";
        exit;
    }
} else {
    // No filter provided, show all properties or redirect to home
    // Here, you can decide to show all or redirect.
    // For example, show all:
    $allListings = $props;
}

?>

<!-- Your HTML below -->

<div class="slide-one-item home-slider owl-carousel">
  <?php foreach($props as $prop) : ?>
    <div class="site-blocks-cover overlay" style="background-image: url(images/<?php echo htmlspecialchars($prop->image); ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <span class="d-inline-block bg-<?php echo ($prop->type === "rent") ? "success" : "danger"; ?> text-white px-3 mb-3 property-offer-type rounded"><?php echo htmlspecialchars($prop->type); ?></span>
            <h1 class="mb-2"><?php echo htmlspecialchars($prop->name); ?></h1>
            <p class="mb-5"><strong class="h2 text-success font-weight-bold">$<?php echo htmlspecialchars($prop->price); ?></strong></p>
            <p><a href="property-details.php?id=<?php echo $prop->id; ?>" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 btn-2">See Details</a></p>
          </div>
        </div>
      </div>
    </div>  
  <?php endforeach; ?>
</div>

<div class="site-section site-section-sm pb-0">
  <div class="container">
    <div class="row">
      <!-- Your search form here -->
    </div>

    <div class="row mb-5">
      <?php 
      // Decide which list to show: price filtered or type filtered or all
      $listingsToShow = !empty($allListingsPrice) ? $allListingsPrice : $allListings;

      if (!empty($listingsToShow)): 
        foreach($listingsToShow as $listing): ?>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="property-entry h-100">
              <a href="property-details.php?id=<?php echo $listing->id; ?>" class="property-thumbnail">
                <div class="offer-type-wrap">
                  <span class="offer-type bg-<?php echo ($listing->type === "rent") ? "success" : "danger"; ?>"><?php echo htmlspecialchars($listing->type); ?></span>
                </div>
                <img src="images/<?php echo htmlspecialchars($listing->image); ?>" alt="Image" class="img-fluid">
              </a>
              <div class="p-4 property-body">
                <h2 class="property-title"><a href="property-details.php?id=<?php echo $listing->id; ?>"><?php echo htmlspecialchars($listing->name); ?></a></h2>
                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> <?php echo htmlspecialchars($listing->location); ?></span>
                <strong class="property-price text-primary mb-3 d-block text-success">$<?php echo htmlspecialchars($listing->price); ?></strong>
                <ul class="property-specs-wrap mb-3 mb-lg-0">
                  <li><span class="property-specs">Beds</span><span class="property-specs-number"><?php echo $listing->beds; ?></span></li>
                  <li><span class="property-specs">Baths</span><span class="property-specs-number"><?php echo $listing->baths; ?></span></li>
                  <li><span class="property-specs">SQ FT</span><span class="property-specs-number"><?php echo $listing->sq_ft; ?></span></li>
                </ul>
              </div>
            </div>
          </div>
        <?php endforeach; 
      else: ?>
        <div class="col-12">
          <div class="alert alert-info text-center">No properties found for this filter.</div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php require "includes/footer.php"; ?>
