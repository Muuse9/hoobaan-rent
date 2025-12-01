<?php
// Start session and enable full error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require "includes/header.php";
require "config/config.php";

// Ensure required constants are defined
if (!defined('THUMBNAILMURL')) {
    define('THUMBNAILMURL', 'admin-panel/properties-admins/thumbnail');
}
if (!defined('GALLERYURL')) {
    define('GALLERYURL', 'admin-panel/properties-admins/images');
}

// Initialize optional variables
$check = null;
$check_request = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch property details
    $single = $conn->prepare("SELECT * FROM props WHERE id = :id");
    $single->execute([':id' => $id]);
    $allDetails = $single->fetch(PDO::FETCH_OBJ);

    // Redirect if property not found
    if (!$allDetails) {
        echo "<script>window.location.href='" . APPURL . "/404.php'</script>";
        exit();
    }

    // Related properties
    $relatedProps = $conn->prepare("SELECT * FROM props WHERE home_type = :home_type AND id != :id");
    $relatedProps->execute([':home_type' => $allDetails->home_type, ':id' => $id]);
    $allRelatedProps = $relatedProps->fetchAll(PDO::FETCH_OBJ);

    // Gallery images
    $images = $conn->prepare("SELECT * FROM related_images WHERE prop_id = :id");
    $images->execute([':id' => $id]);
    $allImages = $images->fetchAll(PDO::FETCH_OBJ);

    // Favorites check
    if (isset($_SESSION['user_id'])) {
        $check = $conn->prepare("SELECT * FROM favs WHERE prop_id = :prop_id AND user_id = :user_id");
        $check->execute([':prop_id' => $id, ':user_id' => $_SESSION['user_id']]);

        // Request check
        $check_request = $conn->prepare("SELECT * FROM requests WHERE prop_id = :prop_id AND user_id = :user_id");
        $check_request->execute([':prop_id' => $id, ':user_id' => $_SESSION['user_id']]);
    }
} else {
    echo "<script>window.location.href='" . APPURL . "/404.php'</script>";
    exit();
}
?>

<!-- Modern Hero Section -->
<?php
$heroImgPath = THUMBNAILMURL . '/' . $allDetails->image;
// Check if property is in user's favorites
$isFav = false;
if (isset($_SESSION['user_id'])) {
    $isFav = ($check && $check->rowCount() > 0);
}
?>
<div class="modern-hero-section">
  <div class="hero-background" style="background-image: url(<?php echo $heroImgPath; ?>);">
    <div class="hero-overlay"></div>
  </div>
  <div class="container">
    <div class="row align-items-center min-vh-100">
      <div class="col-lg-6">
        <div class="hero-content">
          <span class="hero-badge">Property Details</span>
          <h1 class="hero-title"><?php echo htmlspecialchars($allDetails->name); ?></h1>
          <p class="hero-description">Discover this amazing property with premium features and excellent location. Perfect for your dream home.</p>
          <div class="hero-price">$<?php echo htmlspecialchars($allDetails->price); ?></div>
          <div class="hero-buttons">
            <a href="#property-info" class="btn btn-primary hero-btn-primary">View Details</a>
            <a href="#contact-agent" class="btn btn-outline-primary hero-btn-secondary">Contact Agent</a>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="hero-icons-container">
          <div class="hero-geometric-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
            <div class="shape shape-5"></div>
          </div>
          <div class="hero-icons-grid">
            <div class="hero-icon-item">
              <i class="fas fa-bed"></i>
              <span><?php echo htmlspecialchars($allDetails->rooms); ?> Rooms</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-bath"></i>
              <span><?php echo htmlspecialchars($allDetails->baths); ?> Baths</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-ruler-combined"></i>
              <span><?php echo htmlspecialchars($allDetails->sq_ft); ?> Sq Ft</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-map-marker-alt"></i>
              <span><?php echo htmlspecialchars($allDetails->location); ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Hero Section Styles -->
<style>
.modern-hero-section {
  position: relative;
  background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
  min-height: 100vh;
  overflow: hidden;
  padding-top: 80px;
}

.hero-background {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  opacity: 0.4;
}

.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(26, 26, 46, 0.8);
}

.hero-content {
  color: white;
  z-index: 2;
  position: relative;
}

.hero-badge {
  background: rgba(0, 123, 255, 0.9);
  color: white;
  padding: 8px 16px;
  border-radius: 20px;
  font-size: 0.9rem;
  font-weight: 600;
  display: inline-block;
  margin-bottom: 1rem;
}

.hero-title {
  font-size: 3.5rem;
  font-weight: 700;
  margin-bottom: 1.5rem;
  line-height: 1.2;
  text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.hero-description {
  font-size: 1.2rem;
  margin-bottom: 2rem;
  line-height: 1.6;
  opacity: 0.9;
  max-width: 500px;
}

.hero-price {
  font-size: 2.5rem;
  font-weight: 700;
  color: #007bff;
  margin-bottom: 2rem;
  text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.hero-buttons {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
}

.hero-btn-primary {
  background: #007bff;
  border: 2px solid #007bff;
  color: white;
  padding: 12px 30px;
  border-radius: 8px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
  display: inline-block;
}

.hero-btn-primary:hover {
  background: #0056b3;
  border-color: #0056b3;
  color: white;
  text-decoration: none;
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0, 123, 255, 0.3);
}

.hero-btn-secondary {
  background: transparent;
  border: 2px solid #007bff;
  color: #007bff;
  padding: 12px 30px;
  border-radius: 8px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
  display: inline-block;
}

.hero-btn-secondary:hover {
  background: #007bff;
  color: white;
  text-decoration: none;
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0, 123, 255, 0.3);
}

.hero-icons-container {
  position: relative;
  z-index: 2;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
  min-height: 400px;
}

.hero-geometric-shapes {
  position: absolute;
  width: 100%;
  height: 100%;
  z-index: 1;
}

.shape {
  position: absolute;
  background: linear-gradient(135deg, #007bff, #0056b3);
  opacity: 0.9;
  border-radius: 8px;
  box-shadow: 0 8px 25px rgba(0, 123, 255, 0.3);
}

.shape-1 {
  width: 140px;
  height: 140px;
  top: 10%;
  right: 10%;
  transform: rotate(45deg);
  clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
}

.shape-2 {
  width: 100px;
  height: 100px;
  top: 70%;
  right: 20%;
  transform: rotate(30deg);
  clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
}

.shape-3 {
  width: 120px;
  height: 80px;
  top: 40%;
  right: 5%;
  transform: rotate(15deg);
  clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%);
}

.shape-4 {
  width: 60px;
  height: 60px;
  top: 20%;
  right: 60%;
  transform: rotate(60deg);
  clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
}

.shape-5 {
  width: 80px;
  height: 80px;
  top: 60%;
  right: 70%;
  transform: rotate(20deg);
  clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%);
}

.hero-icons-grid {
  position: relative;
  z-index: 2;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 30px;
  max-width: 500px;
  width: 100%;
}

.hero-icon-item {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  border: 2px solid rgba(255, 255, 255, 0.2);
  border-radius: 20px;
  padding: 30px 20px;
  text-align: center;
  color: white;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.hero-icon-item::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(135deg, rgba(0, 123, 255, 0.3), rgba(0, 86, 179, 0.3));
  opacity: 0;
  transition: opacity 0.3s ease;
}

.hero-icon-item:hover::before {
  opacity: 1;
}

.hero-icon-item:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(0, 123, 255, 0.3);
  border-color: rgba(255, 255, 255, 0.4);
}

.hero-icon-item i {
  font-size: 3rem;
  color: #007bff;
  margin-bottom: 15px;
  position: relative;
  z-index: 1;
  text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.hero-icon-item span {
  font-size: 1.1rem;
  font-weight: 600;
  position: relative;
  z-index: 1;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

/* Responsive Design */
@media (max-width: 991.98px) {
  .hero-title {
    font-size: 2.5rem;
  }
  
  .hero-description {
    font-size: 1.1rem;
  }
  
  .hero-price {
    font-size: 2rem;
  }
  
  .hero-buttons {
    justify-content: center;
  }
  
  .hero-icons-container {
    margin-top: 3rem;
  }
  
  .hero-icons-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
  }
  
  .hero-icon-item {
    padding: 25px 15px;
  }
  
  .hero-icon-item i {
    font-size: 2.5rem;
  }
}

@media (max-width: 767.98px) {
  .hero-title {
    font-size: 2rem;
  }
  
  .hero-description {
    font-size: 1rem;
  }
  
  .hero-price {
    font-size: 1.8rem;
  }
  
  .hero-buttons {
    flex-direction: column;
    align-items: center;
  }
  
  .hero-btn-primary,
  .hero-btn-secondary {
    width: 100%;
    max-width: 250px;
    text-align: center;
  }
  
  .hero-icons-grid {
    grid-template-columns: 1fr;
    gap: 15px;
  }
  
  .hero-icon-item {
    padding: 20px 15px;
  }
  
  .hero-icon-item i {
    font-size: 2rem;
  }
  
  .hero-icon-item span {
    font-size: 1rem;
  }
}
</style>

<!-- Property Info -->
<div class="site-section site-section-sm">
    <div class="container">
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">
                <div>
                    <div class="slide-one-item home-slider owl-carousel">
                        <?php foreach ($allImages as $image): ?>
                            <?php
                            $galleryImgPath = GALLERYURL . '/' . $image->image;
                            echo '<!-- Gallery image path: ' . $galleryImgPath . ' | Exists: ' . (file_exists($galleryImgPath) ? 'yes' : 'no') . ' -->';
                            ?>
                            <?php if (!empty($image->image)): ?>
                                <div><img src="<?php echo $galleryImgPath; ?>" alt="Image" class="img-fluid" onerror="this.onerror=null;this.src='images/no-image.png';"></div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="bg-white property-body border-bottom border-left border-right">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <strong class="text-success h1 mb-3">$<?php echo htmlspecialchars($allDetails->price); ?></strong>
                        </div>
                        <div class="col-md-6">
                            <ul class="property-specs-wrap mb-3 mb-lg-0 float-lg-right">
                                <li><span class="property-specs">Rooms</span><span class="property-specs-number"><?php echo htmlspecialchars($allDetails->rooms); ?></span></li>
                                <li><span class="property-specs">Baths</span><span class="property-specs-number"><?php echo htmlspecialchars($allDetails->baths); ?></span></li>
                                <li><span class="property-specs">SQ FT</span><span class="property-specs-number"><?php echo htmlspecialchars($allDetails->sq_ft); ?></span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                            <span class="d-inline-block text-black mb-0 caption-text">Home Type</span>
                            <strong class="d-block"><?php echo str_replace('-', ' ', htmlspecialchars($allDetails->home_type)); ?></strong>
                        </div>
                        <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                            <span class="d-inline-block text-black mb-0 caption-text">Year Built</span>
                            <strong class="d-block"><?php echo htmlspecialchars($allDetails->year_built); ?></strong>
                        </div>
                        <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                            <span class="d-inline-block text-black mb-0 caption-text">Price/Sqft</span>
                            <strong class="d-block">$<?php echo htmlspecialchars($allDetails->price_sqft); ?></strong>
                        </div>
                    </div>

                    <h2 class="h4 text-black">More Info</h2>
                    <p><?php echo htmlspecialchars($allDetails->description); ?></p>

                    <div class="row no-gutters mt-5">
                        <div class="col-12"><h2 class="h4 text-black mb-3">Gallery</h2></div>
                        <?php foreach ($allImages as $image): ?>
                            <?php if (!empty($image->image)): ?>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <a href="<?php echo GALLERYURL; ?>/<?php echo htmlspecialchars($image->image); ?>" class="image-popup gal-item">
                                        <img src="<?php echo GALLERYURL; ?>/<?php echo htmlspecialchars($image->image); ?>" alt="Image" class="img-fluid" onerror="this.onerror=null;this.src='images/no-image.png';">
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Right Column (Sidebar) -->
            <div class="col-lg-4">
                <!-- Contact Agent -->
                <div class="bg-white widget border rounded">
                    <h3 class="h4 text-black widget-title mb-3">Contact Agent</h3>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <?php if (isset($check_request) && $check_request->rowCount() > 0): ?>
                            <p>You already sent a request to this property, you can't send another.</p>
                        <?php else: ?>
                            <form action="user/process-request.php" method="POST" class="form-contact-agent">
                                <input type="hidden" name="prop_id" value="<?php echo $id; ?>">
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                                <input type="hidden" name="admin_name" value="<?php echo $allDetails->admin_name; ?>">
                                <div class="form-group"><label>Name</label><input type="text" name="name" class="form-control"></div>
                                <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control"></div>
                                <div class="form-group"><label>Phone</label><input type="text" name="phone" class="form-control"></div>
                                <div class="form-group"><input type="submit" name="submit" class="btn btn-primary" value="Send Request"></div>
                            </form>
                        <?php endif; ?>
                    <?php else: ?>
                        <p>Log in to send a request.</p>
                    <?php endif; ?>
                </div>

                <!-- Share Buttons -->
                <div class="bg-white widget border rounded">
                    <h3 class="h4 text-black widget-title mb-3">Share</h3>
                    <div class="px-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo APPURL; ?>/property-details.php?id=<?php echo $allDetails->id; ?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
                        <a href="https://twitter.com/intent/tweet?text=<?php echo $allDetails->name; ?>&url=<?php echo APPURL; ?>/property-details.php?id=<?php echo $allDetails->id; ?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo APPURL; ?>/property-details.php?id=<?php echo $allDetails->id; ?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
                    </div>
                </div>

                <!-- Add to Favs -->
                <div class="bg-white widget border rounded">
                    <h3 class="h4 text-black widget-title mb-3">Add to Fav</h3>
                    <div class="px-3">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <form action="favs/add-fav.php" method="POST" class="form-contact-agent">
                                <input type="hidden" name="prop_id" value="<?php echo $id; ?>">
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                                <?php if (isset($check) && $check->rowCount() > 0): ?>
                                    <a href="favs/delete-fav.php?prop_id=<?php echo $id; ?>&user_id=<?php echo $_SESSION['user_id']; ?>" class="btn btn-primary text-white">Added to fav</a>
                                <?php else: ?>
                                    <input type="submit" name="submit" class="btn btn-primary" value="Add to fav">
                                <?php endif; ?>
                            </form>
                        <?php else: ?>
                            <p>Log in to add this to favorites.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Properties -->
<div class="site-section site-section-sm bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12"><h2>Related Properties</h2></div>
        </div>
        <style>
          .modern-property-card {
            border-radius: 18px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.10);
            background: #fff;
            overflow: hidden;
            transition: box-shadow 0.2s;
            display: flex;
            flex-direction: column;
            height: 100%;
            text-align: center;
          }
          .modern-property-card:hover {
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
          }
          .modern-property-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
          }
          .modern-property-body {
            padding: 28px 18px 22px 18px;
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
          }
          .modern-property-title {
            font-size: 1.35rem;
            font-weight: 600;
            margin-bottom: 10px;
          }
          .modern-property-location {
            color: #555;
            font-size: 1rem;
            margin-bottom: 8px;
          }
          .modern-property-price {
            font-size: 1.1rem;
            color: #1e7e34;
            font-weight: 500;
            margin-bottom: 10px;
          }
          .modern-property-specs {
            font-size: 0.98rem;
            color: #333;
            margin-bottom: 0;
            padding: 0;
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 18px;
          }
          .modern-property-specs li {
            display: flex;
            flex-direction: column;
            align-items: center;
          }
          .modern-property-btn {
            margin-top: 16px;
            background: #1e7e34;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 10px 24px;
            font-size: 1rem;
            text-decoration: none;
            transition: background 0.2s;
            display: inline-block;
          }
          .modern-property-btn:hover {
            background: #155d27;
            color: #fff;
            text-decoration: none;
          }
.property-fav-btn {
  position: absolute;
  top: 18px;
  right: 18px;
  background: #fff;
  border: none;
  border-radius: 50%;
  width: 48px;
  height: 48px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 2px 8px rgba(0,0,0,0.10);
  font-size: 1.7rem;
  color: #e74c3c;
  cursor: pointer;
  z-index: 2;
  transition: background 0.15s;
}
.property-fav-btn:hover {
  background: #ffeaea;
}
.property-type-dot {
  width: 12px;
  height: 12px;
  background: #1ec94c;
  border-radius: 50%;
  display: inline-block;
  margin-right: 8px;
}
.property-type-label {
  color: #222;
  font-size: 1.1rem;
  font-weight: 500;
}
.property-card-price-v2 {
  font-size: 2rem;
  font-weight: 700;
  color: #222;
  margin-bottom: 7px;
}
.property-card-specs-row {
  display: flex;
  gap: 16px;
  font-size: 1.1rem;
  color: #222;
  margin-bottom: 7px;
}
.property-card-specs-row span b {
  font-weight: 700;
  margin-right: 2px;
  font-size: 1.2rem;
}
.property-card-address {
  color: #444;
  font-size: 1.05rem;
  margin-bottom: 12px;
}
.property-card-btn-v2 {
  margin-top: 4px;
  background: #218838;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 12px 28px;
  font-size: 1.1rem;
  text-decoration: none;
  transition: background 0.2s;
  display: inline-block;
}
.property-card-btn-v2:hover {
  background: #155d27;
  color: #fff;
  text-decoration: none;
}
.property-card-img-wrap {
  position: relative;
  width: 100%;
  height: 190px;
  overflow: hidden;
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
}
.property-card-img-wrap img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
}
.property-fav-btn {
  position: absolute;
  top: 16px;
  right: 16px;
  background: #fff;
  border: none;
  border-radius: 50%;
  width: 44px;
  height: 44px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 2px 8px rgba(0,0,0,0.10);
  font-size: 1.5rem;
  color: #e74c3c;
  cursor: pointer;
  z-index: 2;
  transition: background 0.15s;
}
.property-fav-btn:hover {
  background: #ffeaea;
}
.property-type-row {
  display: flex;
  align-items: center;
  margin-bottom: 8px;
  font-size: 1.01rem;
  font-weight: 500;
}
.property-type-dot {
  width: 10px;
  height: 10px;
  background: #1ec94c;
  border-radius: 50%;
  display: inline-block;
  margin-right: 6px;
}
.property-type-label {
  color: #222;
}
.property-card-price-v2 {
  font-size: 2rem;
  font-weight: 700;
  color: #222;
  margin-bottom: 7px;
}
.property-card-specs-row {
  display: flex;
  gap: 12px;
  font-size: 1.1rem;
  color: #222;
  margin-bottom: 7px;
}
.property-card-specs-row span b {
  font-weight: 700;
  margin-right: 2px;
  font-size: 1.2rem;
}
.property-card-address {
  color: #444;
  font-size: 1.05rem;
  margin-bottom: 12px;
  text-align: left;
}
.property-card-btn-v2 {
  margin-top: 4px;
  background: #218838;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 12px 0;
  font-size: 1.1rem;
  text-decoration: none;
  transition: background 0.2s;
  display: block;
  width: 100%;
  font-weight: 500;
}
.property-card-btn-v2:hover {
  background: #155d27;
  color: #fff;
  text-decoration: none;
}
        </style>
        <div class="row mb-5">
            <?php foreach ($allRelatedProps as $allRelatedProp): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                  <div class="modern-property-card property-card-v2" style="position:relative;">
                    <div class="property-card-img-wrap">
                      <a href="property-details.php?id=<?php echo $allRelatedProp->id; ?>">
                        <img src="<?php echo THUMBNAILMURL; ?>/<?php echo $allRelatedProp->image; ?>" alt="Image" class="modern-property-img" onerror="this.onerror=null;this.src='images/no-image.png';">
                      </a>
                      <?php if (isset($_SESSION['user_id'])): ?>
                        <?php
                        $isFavRelated = false;
                        $favCheckStmt = $conn->prepare("SELECT 1 FROM favs WHERE prop_id = :prop_id AND user_id = :user_id");
                        $favCheckStmt->execute([':prop_id' => $allRelatedProp->id, ':user_id' => $_SESSION['user_id']]);
                        $isFavRelated = $favCheckStmt->rowCount() > 0;
                        ?>
                        <form method="POST" action="user/add-fav.php" style="position:absolute;top:16px;right:16px;z-index:3;">
                          <input type="hidden" name="prop_id" value="<?php echo $allRelatedProp->id; ?>">
                          <button type="submit" class="property-fav-btn" title="Add to Favourites">
                            <i class="<?php echo $isFavRelated ? 'fas' : 'far'; ?> fa-heart" style="color:#e74c3c;"></i>
                          </button>
                        </form>
                      <?php endif; ?>
                    </div>
                    <div class="modern-property-body property-card-body-v2" style="align-items: flex-start;">
                      <div class="property-type-row">
                        <span class="property-type-dot"></span>
                        <span class="property-type-label"><?php echo ucfirst($allRelatedProp->home_type ?? $allRelatedProp->type); ?></span>
                      </div>
                      <div class="property-card-price-v2">$<?php echo $allRelatedProp->price; ?></div>
                      <div class="property-card-specs-row">
                        <span><b><?php echo $allRelatedProp->rooms; ?></b> room</span>
                        <span><b><?php echo $allRelatedProp->baths; ?></b> bath</span>
                      </div>
                      <div class="property-card-address">
                        <div><?php echo $allRelatedProp->location; ?></div>
                      </div>
                      <a href="property-details.php?id=<?php echo $allRelatedProp->id; ?>" class="modern-property-btn property-card-btn-v2">See Details</a>
                    </div>
                  </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require "includes/footer.php"; ?>
