<?php
// Enable error reporting for debugging - remove on production
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start output buffering
ob_start();

// Includes: Adjust paths if needed
require "includes/header.php";
require "config/config.php";

// Check if APPURL is defined, else define it here for demo
if (!defined('APPURL')) {
    define('APPURL', 'http://localhost/yourproject'); // Change to your actual base URL
}

// Define thumbnail URL (absolute URL path)
if (!defined('THUMBNAILMURL')) {
    define('THUMBNAILMURL', APPURL . '/images/properties');
}

// Fetch leased properties
try {
    $stmt = $conn->prepare("SELECT * FROM props WHERE is_leased = 1");
    $stmt->execute();
    $properties = $stmt->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    // Show error and stop script execution
    die("<div class='alert alert-danger'>Database error: " . htmlspecialchars($e->getMessage()) . "</div>");
}

?>

<!-- Modern Hero Section -->
<div class="modern-hero-section">
  <div class="hero-background">
    <div class="hero-overlay"></div>
  </div>
  <div class="container">
    <div class="row align-items-center min-vh-100">
      <div class="col-lg-6">
        <div class="hero-content">
          <h1 class="hero-title">Leased Properties</h1>
          <p class="hero-description">Discover our premium collection of currently leased properties. These homes have found their perfect tenants and are no longer available.</p>
          <div class="hero-buttons">
            <a href="#properties" class="btn btn-primary hero-btn-primary">View Properties</a>
            <a href="index.php" class="btn btn-outline-primary hero-btn-secondary">Available Homes</a>
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
              <i class="fas fa-key"></i>
              <span>Leased Out</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-check-circle"></i>
              <span>Verified</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-users"></i>
              <span>Happy Tenants</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-star"></i>
              <span>Premium Quality</span>
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
  background-image: url('images/hero_bg_3.jpg');
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  opacity: 0.3;
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

.hero-title {
  font-size: 3.5rem;
  font-weight: 700;
  margin-bottom: 1.5rem;
  line-height: 1.2;
  text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.hero-description {
  font-size: 1.2rem;
  margin-bottom: 2.5rem;
  line-height: 1.6;
  opacity: 0.9;
  max-width: 500px;
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

<!-- Leased Properties Section -->
<div class="site-section site-section-sm bg-light py-5">
    <div class="container">
        <div class="row mb-5 justify-content-center">
            <div class="col-md-7 text-center">
                <div class="site-section-title">
                    <h2 class="text-primary">Currently Leased Properties</h2>
                    <p class="text-muted">Browse our exclusive collection of leased homes</p>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <?php if (count($properties) > 0): ?>
                <?php foreach ($properties as $prop): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="property-entry h-100 shadow-sm rounded position-relative">
                            <a href="property-details.php?id=<?php echo $prop->id; ?>" class="property-thumbnail d-block position-relative overflow-hidden">
                                <div class="offer-type-wrap position-absolute top-0 end-0 m-2">
                                    <span class="offer-type bg-info px-3 py-1 text-white rounded"><?php echo htmlspecialchars($prop->type ?? ''); ?></span>
                                </div>
                                <img src="<?php echo THUMBNAILMURL . '/' . htmlspecialchars($prop->image ?? 'no-image.png'); ?>"
                                     alt="Property Image"
                                     class="img-fluid"
                                     style="height: 220px; width: 100%; object-fit: cover;"
                                     onerror="this.onerror=null;this.src='<?php echo APPURL; ?>/images/no-image.png';">
                            </a>
                            <div class="p-4 property-body bg-white">
                                <h2 class="property-title mb-2">
                                    <a href="property-details.php?id=<?php echo $prop->id; ?>" class="text-decoration-none text-dark">
                                        <?php echo htmlspecialchars($prop->name ?? ''); ?>
                                    </a>
                                </h2>
                                <span class="property-location d-block mb-3 text-muted">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i><?php echo htmlspecialchars($prop->location ?? ''); ?>
                                </span>
                                <strong class="property-price text-success mb-3 d-block">
                                    $<?php echo number_format(floatval(str_replace(',', '', $prop->price ?? '0'))); ?>
                                </strong>
                                <ul class="property-specs-wrap mb-0 list-unstyled d-flex justify-content-between text-center">
                                    <li>
                                        <span class="property-specs d-block text-muted">Beds</span>
                                        <span class="property-specs-number fw-bold"><?php echo htmlspecialchars($prop->beds ?? 0); ?></span>
                                    </li>
                                    <li>
                                        <span class="property-specs d-block text-muted">Baths</span>
                                        <span class="property-specs-number fw-bold"><?php echo htmlspecialchars($prop->baths ?? 0); ?></span>
                                    </li>
                                    <li>
                                        <span class="property-specs d-block text-muted">SQ FT</span>
                                        <span class="property-specs-number fw-bold"><?php echo htmlspecialchars($prop->sq_ft ?? 0); ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="ribbon position-absolute top-0 start-0 bg-danger text-white px-3 py-1 fw-bold" style="transform: rotate(-20deg); z-index:10;">
                                LEASED
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle me-2"></i> No leased properties available at the moment.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
.property-entry {
    transition: transform 0.3s ease;
    position: relative;
}
.property-entry:hover {
    transform: translateY(-5px);
}
.property-thumbnail img {
    transition: transform 0.3s ease;
}
.property-entry:hover .property-thumbnail img {
    transform: scale(1.05);
}
.offer-type {
    font-weight: 600;
    font-size: 0.85rem;
    border-radius: 5px;
}
.property-title a:hover {
    color: #007bff;
}
.property-specs-wrap li {
    flex: 1;
}
.ribbon {
    padding: 0.25rem 1rem;
    font-size: 0.85rem;
}
.hero-section {
    position: relative;
    overflow: hidden;
}
.leased-hero-section {
    background: linear-gradient(120deg, #2563eb 0%, #3b82f6 100%);
    color: #fff;
    height: 340px;
    border-radius: 0 0 32px 32px;
    box-shadow: 0 8px 32px rgba(59,130,246,0.10);
    margin-bottom: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
.leased-hero-section h1, .leased-hero-section p {
    color: #fff;
}
</style>

<?php
require "includes/footer.php";
ob_end_flush();
?>
