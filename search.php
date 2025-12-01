<?php
// Enable error reporting for development (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session and output buffering
session_start();
ob_start();

require "includes/header.php";
require "config/config.php";

// Base URL definition if not already defined
if (!defined('APPURL')) {
    define('APPURL', 'http://localhost/homeland1'); // adjust this to your actual project path
}
if (!defined('THUMBNAILMURL')) {
    define('THUMBNAILMURL', APPURL . '/images/properties');
}

// Fetch categories for dropdown
try {
    $catStmt = $conn->query("SELECT * FROM categories");
    $allCategories = $catStmt->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    die("<div class='alert alert-danger'>Error fetching categories: " . htmlspecialchars($e->getMessage()) . "</div>");
}

// Initialize
$searching = false;
$listings = [];

if (isset($_POST['submit'])) {
    $searching = true;

    // Sanitize inputs
    $types = trim($_POST['types'] ?? '');
    $offers = trim($_POST['offers'] ?? '');
    $cities = trim($_POST['cities'] ?? '');

    // Dynamic query based on filters
    $query = "SELECT * FROM props WHERE 1";
    $params = [];

    if (!empty($types)) {
        $query .= " AND home_type LIKE ?";
        $params[] = "%$types%";
    }
    if (!empty($offers)) {
        $query .= " AND type LIKE ?";
        $params[] = "%$offers%";
    }
    if (!empty($cities)) {
        $query .= " AND location LIKE ?";
        $params[] = "%$cities%";
    }

    try {
        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        $listings = $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die("<div class='alert alert-danger'>Search error: " . htmlspecialchars($e->getMessage()) . "</div>");
    }
} else {
    // Default view: all available (not leased) properties
    try {
        $propsStmt = $conn->prepare("SELECT * FROM props WHERE is_leased = 0");
        $propsStmt->execute();
        $props = $propsStmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die("<div class='alert alert-danger'>Error fetching properties: " . htmlspecialchars($e->getMessage()) . "</div>");
    }
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
          <h1 class="hero-title">Search Properties</h1>
          <p class="hero-description">Find your perfect home with our advanced search features. Filter by location, price, and property type to discover your dream home.</p>
          <div class="hero-buttons">
            <a href="#search-form" class="btn btn-primary hero-btn-primary">Start Search</a>
            <a href="index.php" class="btn btn-outline-primary hero-btn-secondary">View All</a>
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
              <i class="fas fa-search"></i>
              <span>Advanced Search</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-filter"></i>
              <span>Smart Filters</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-map-marked-alt"></i>
              <span>Location Based</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-bolt"></i>
              <span>Quick Results</span>
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
  background-image: url('images/hero_bg_2.jpg');
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

<!-- Search Form -->
<div class="site-section site-section-sm bg-light py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form method="POST" action="search.php" class="form-search">
                    <div class="row align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">Listing Types</label>
                            <select name="types" class="form-control" required>
                                <option value="" disabled <?php echo empty($_POST['types']) ? 'selected' : ''; ?>>Select type</option>
                                <?php foreach ($allCategories as $category): ?>
                                    <option value="<?php echo htmlspecialchars($category->name); ?>" <?php if ($searching && $_POST['types'] === $category->name) echo 'selected'; ?>>
                                        <?php echo ucwords(str_replace('-', ' ', $category->name)); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Offer Type</label>
                            <select name="offers" class="form-control" required>
                                <option value="" disabled <?php echo empty($_POST['offers']) ? 'selected' : ''; ?>>Select offer</option>
                                <option value="sale" <?php if ($searching && $_POST['offers'] === 'sale') echo 'selected'; ?>>Sale</option>
                                <option value="rent" <?php if ($searching && $_POST['offers'] === 'rent') echo 'selected'; ?>>Rent</option>
                                <option value="lease" <?php if ($searching && $_POST['offers'] === 'lease') echo 'selected'; ?>>Lease</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Select City</label>
                            <select name="cities" class="form-control" required>
                                <option value="" disabled <?php echo empty($_POST['cities']) ? 'selected' : ''; ?>>Select city</option>
                                <option value="newhargeisa" <?php if ($searching && $_POST['cities'] === 'newhargeisa') echo 'selected'; ?>>New Hargeisa</option>
                                <option value="masale" <?php if ($searching && $_POST['cities'] === 'masale') echo 'selected'; ?>>Masale</option>
                                <option value="jigjiga" <?php if ($searching && $_POST['cities'] === 'jigjiga') echo 'selected'; ?>>Jig Jiga</option>
                                <option value="october" <?php if ($searching && $_POST['cities'] === 'october') echo 'selected'; ?>>October</option>
                                <option value="siinaay" <?php if ($searching && $_POST['cities'] === 'siinaay') echo 'selected'; ?>>Siinaay</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Property Listings -->
<div class="site-section site-section-sm bg-light">
    <div class="container">
        <div class="row">
            <?php
            $displayList = $searching ? $listings : $props;
            if (!empty($displayList)):
                foreach ($displayList as $prop):
            ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="property-entry h-100 shadow-sm rounded">
                    <a href="property-details.php?id=<?php echo $prop->id; ?>" class="property-thumbnail d-block position-relative overflow-hidden">
                        <span class="offer-type bg-primary position-absolute top-0 end-0 m-2 text-white px-3 py-1 rounded">
                            <?php echo htmlspecialchars($prop->type); ?>
                        </span>
                        <img src="<?php echo THUMBNAILMURL . '/' . htmlspecialchars($prop->image); ?>"
                             onerror="this.onerror=null;this.src='<?php echo APPURL; ?>/images/no-image.png';"
                             class="img-fluid"
                             style="height: 220px; width: 100%; object-fit: cover;">
                    </a>
                    <div class="p-4 bg-white">
                        <h2 class="mb-2">
                            <a href="property-details.php?id=<?php echo $prop->id; ?>" class="text-dark text-decoration-none">
                                <?php echo htmlspecialchars($prop->name); ?>
                            </a>
                        </h2>
                        <p class="text-muted"><i class="fas fa-map-marker-alt text-primary me-2"></i><?php echo htmlspecialchars($prop->location); ?></p>
                        <strong class="text-primary">$<?php echo number_format(floatval(str_replace(',', '', $prop->price))); ?></strong>
                        <ul class="list-unstyled d-flex justify-content-between mt-3 mb-0">
                            <li><small class="text-muted">Beds</small><br><strong><?php echo htmlspecialchars($prop->beds); ?></strong></li>
                            <li><small class="text-muted">Baths</small><br><strong><?php echo htmlspecialchars($prop->baths); ?></strong></li>
                            <li><small class="text-muted">SQ FT</small><br><strong><?php echo htmlspecialchars($prop->sq_ft); ?></strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endforeach; else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <?php echo $searching ? 'No properties found for your search criteria.' : 'No properties available right now.'; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
.property-entry:hover {
    transform: translateY(-5px);
    transition: 0.3s ease;
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
}
.hero-section::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0, 0, 0, 0.5);
}
</style>

<?php
require "includes/footer.php";
ob_end_flush();
?>
