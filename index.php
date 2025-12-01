<?php
require "config/config.php";
require "includes/header.php";

// Fetch categories for the search form
$allCategoriesQuery = $conn->query("SELECT * FROM categories");
$allCategoriesQuery->execute();
$allCategories = $allCategoriesQuery->fetchAll(PDO::FETCH_OBJ);

// Fetch only available (not leased) properties
$propsStmt = $conn->prepare("SELECT * FROM props WHERE is_leased = 0");
$propsStmt->execute();
$props = $propsStmt->fetchAll(PDO::FETCH_OBJ);

// Fetch user's favorite property IDs if logged in
$favPropIds = [];
if (isset($_SESSION['user_id'])) {
  $favStmt = $conn->prepare("SELECT prop_id FROM favs WHERE user_id = :user_id");
  $favStmt->execute([':user_id' => $_SESSION['user_id']]);
  $favPropIds = $favStmt->fetchAll(PDO::FETCH_COLUMN, 0);
}
?>

<!-- Navigation Bar Styles -->
<style>
.site-navbar {
  background: #007bff !important;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  margin-top: 0 !important;
}

.site-navbar .site-navigation .site-menu > li > a {
  color: white !important;
  font-weight: 500;
}

.site-navbar .site-navigation .site-menu > li > a:hover {
  color: #e3f2fd !important;
}

.site-navbar .site-navigation .site-menu .active > a {
  color: #e3f2fd !important;
}

.site-navbar h1 a {
  color: white !important;
}

.site-navbar h1 a span {
  color: #e3f2fd !important;
}

.request-btn {
  background: #e3f2fd !important;
  border: 2px solid #e3f2fd !important;
  color: #007bff !important;
  padding: 8px 20px !important;
  border-radius: 6px !important;
  font-weight: 600 !important;
  text-decoration: none !important;
  transition: all 0.3s ease !important;
}

.request-btn:hover {
  background: white !important;
  border-color: white !important;
  color: #007bff !important;
  text-decoration: none !important;
  transform: translateY(-1px);
  box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
}
</style>

<!-- Modern Hero Section -->
<div class="modern-hero-section">
  <div class="hero-background">
    <div class="hero-overlay"></div>
  </div>
  <div class="container">
    <div class="row align-items-center min-vh-100">
      <div class="col-lg-6">
        <div class="hero-content">
          <h1 class="hero-title">Best Real Estate Company</h1>
          <p class="hero-description">Discover your dream home with Hoobaan. We offer premium properties with exceptional service, ensuring you find the perfect place to call home.</p>
          <div class="hero-buttons">
            <a href="about.php" class="btn btn-primary hero-btn-primary">More About Us</a>
            <a href="#properties" class="btn btn-outline-primary hero-btn-secondary">More Service</a>
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
              <i class="fas fa-home"></i>
              <span>Premium Homes</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-shield-alt"></i>
              <span>Secure & Safe</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-handshake"></i>
              <span>Trusted Service</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-star"></i>
              <span>Best Quality</span>
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
  background-image: url('images/hero_bg_1.jpg');
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

<div class="site-section site-section-sm pb-0">
  <div class="container">
    <div class="row">
      <form class="form-search col-md-12" method="POST" action="search.php" style="margin-top: -100px;">
        <div class="row align-items-end">
          <div class="col-md-3">
            <label for="list-types">Listing Types</label>
            <div class="select-wrap">
              <span class="icon icon-arrow_drop_down"></span>
              <select name="types" id="list-types" class="form-control d-block rounded-0">
                <?php foreach($allCategories as $category) : ?>
                  <option value="<?php echo $category->name; ?>"><?php echo str_replace('-', ' ', $category->name); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <label for="offer-types">Offer Type</label>
            <div class="select-wrap">
              <span class="icon icon-arrow_drop_down"></span>
              <select name="offers" id="offer-types" class="form-control d-block rounded-0">
                <option value="sale">Sale</option>
                <option value="rent">Rent</option>
                <option value="lease">Lease</option>
                <option value="leased">Leased</option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <label for="select-city">Select City</label>
            <div class="select-wrap">
              <span class="icon icon-arrow_drop_down"></span>
              <select name="cities" id="select-city" class="form-control d-block rounded-0">
                <option value="newhargeisa">New Hargeisa</option>
                <option value="masale">Masale</option>
                <option value="jigjiga">Jig Jiga</option>
                <option value="october">October</option>
                <option value="siinaay">Siinaay</option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <input type="submit" name="submit" class="btn btn-primary text-white btn-block rounded-0" value="Search">
          </div>
        </div>
      </form>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="view-options bg-white py-3 px-3 d-md-flex align-items-center">
          <div class="mr-auto">
            <a href="index.php" class="icon-view view-module active"><span class="icon-view_module"></span></a>
          </div>
          <div class="ml-auto d-flex align-items-center">
            <div>
              <a href="<?php echo APPURL; ?>" class="view-list px-3 border-right active">All</a>
              <a href="rent.php?type=rent" class="view-list px-3 border-right">Rent</a>
              <a href="sale.php?type=sale" class="view-list px-3 border-right">Sale</a>
              <a href="leased.php?type=leased"
              <a href="price.php?price=ASC" class="view-list px-3">Price ↑</a>
              <a href="price.php?price=DESC" class="view-list px-3">Price ↓</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="site-section site-section-sm bg-light" id="properties">
  <div class="container">
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
        color: #007bff;
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
        background: #007bff;
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
        background: #0056b3;
        color: #fff;
        text-decoration: none;
      }
    </style>
    <div class="row mb-5">
      <?php foreach($props as $prop) : ?>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="modern-property-card property-card-v2">
            <div class="property-card-img-wrap">
              <a href="property-details.php?id=<?php echo $prop->id; ?>">
                <img src="<?php echo THUMBNAILMURL; ?>/<?php echo $prop->image; ?>" alt="Image" class="modern-property-img">
              </a>
              <?php if(isset($_SESSION['user_id'])): ?>
                <?php $isFav = in_array($prop->id, $favPropIds); ?>
                <form method="POST" action="user/add-fav.php" style="position:absolute;top:14px;right:14px;z-index:3;">
                  <input type="hidden" name="prop_id" value="<?php echo $prop->id; ?>">
                  <button type="submit" class="property-fav-btn" title="Add to Favourites">
                    <i class="<?php echo $isFav ? 'fas' : 'far'; ?> fa-heart" style="color:<?php echo $isFav ? '#e74c3c' : '#bbb'; ?>;"></i>
                  </button>
                </form>
              <?php endif; ?>
            </div>
            <div class="modern-property-body property-card-body-v2">
              <div class="property-type-row">
                <span class="property-type-dot"></span>
                <span class="property-type-label"><?php echo ucfirst($prop->home_type ?? $prop->type); ?></span>
              </div>
              <div class="modern-property-price property-card-price-v2">$<?php echo $prop->price; ?></div>
              <div class="property-card-specs-row">
                <span><b><?php echo $prop->rooms; ?></b> room</span>
                <span><b><?php echo $prop->baths; ?></b> bath</span>
              </div>
              <div class="property-card-address">
                <div><?php echo $prop->location; ?></div>
                <!-- Optionally split address into two lines if you have more info -->
              </div>
              <a href="property-details.php?id=<?php echo $prop->id; ?>" class="modern-property-btn property-card-btn-v2">See Details</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 text-center">
        <div class="site-section-title">
          <h2>Why Choose Us?</h2>
        </div>
        <p>Hoobaan stands for trust, quality, and commitment. 
          With a professional team and customer-first mindset, 
          we deliver smooth renting and construction experiences..</p>
      </div>
    </div>
    <div class="row">
      <!-- Service Cards -->
      <div class="col-md-6 col-lg-4">
        <a href="#" class="service text-center">
          <span class="icon flaticon-house"></span>
          <h2 class="service-heading">Research Suburbs</h2>
          <p>At Hoobaan House Rent and Construction Company,
          Explore handpicked suburbs that match your lifestyle and budget.
           We help you find homes in safe, accessible, and vibrant communities.</p>
        </a>
      </div>
      <div class="col-md-6 col-lg-4">
        <a href="#" class="service text-center">
          <span class="icon flaticon-sold"></span>
          <h2 class="service-heading">Sold Houses</h2>
          <p>At Hoobaan House Rent and Construction Company, We've proudly 
            sold numerous homes that meet the highest living standards.
             Our success stories speak for our quality and customer trust..</p>
        </a>
      </div>
      <div class="col-md-6 col-lg-4">
        <a href="#" class="service text-center">
          <span class="icon flaticon-camera"></span>
          <h2 class="service-heading">Security & Rent</h2>
          <p>We provide affordable rentals without compromising safety. 
            Our properties are inspected regularly
             to ensure your comfort and protection.</p>
        </a>
      </div>
    </div>
  </div>
</div>

<div class="site-section bg-light">
  <div class="container">
    <div class="row mb-5 justify-content-center">
      <div class="col-md-7 text-center">
        <div class="site-section-title">
          <h2>Our Expert Team</h2>
        </div>
        <p>At Hoobaan House Rent and Construction Company, our dedicated team of three expert engineers ensures every home is built and maintained with precision, safety, and your needs in mind.</p>
      </div>
    </div>
    <div class="row">
      <!-- Agent 1 -->
      <div class="col-md-6 col-lg-4 mb-5">
        <div class="team-member-modern">
          <div class="team-member-image">
            <img src="images/eng1.png" alt="Eng Ismail Mohamed Xanano" class="img-fluid">
            <div class="team-member-overlay">
              <div class="social-links">
                <a href="#" class="social-link facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-link twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-link instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-link linkedin"><i class="fab fa-linkedin-in"></i></a>
              </div>
            </div>
          </div>
          <div class="team-member-content">
            <h3 class="team-member-name">Eng Ismail Mohamed Xanano</h3>
            <span class="team-member-position">Senior Civil Engineer</span>
            <p class="team-member-description">Experienced civil engineer with over 8 years in construction and property development. Specializes in structural design and project management, ensuring all our properties meet the highest safety and quality standards.</p>
          </div>
        </div>
      </div>
      <!-- Agent 2 -->
      <div class="col-md-6 col-lg-4 mb-5">
        <div class="team-member-modern">
          <div class="team-member-image">
            <img src="images/qarni0.jpg" alt="Eng Farxaan Mohamed Qarni" class="img-fluid">
            <div class="team-member-overlay">
              <div class="social-links">
                <a href="#" class="social-link facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-link twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-link instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-link linkedin"><i class="fab fa-linkedin-in"></i></a>
              </div>
            </div>
          </div>
          <div class="team-member-content">
            <h3 class="team-member-name">Eng Farxaan Mohamed Qarni</h3>
            <span class="team-member-position">Architecture Engineer</span>
            <p class="team-member-description">Creative architect with a passion for innovative design and sustainable building practices. Brings modern architectural concepts to life while respecting local culture and environmental considerations.</p>
          </div>
        </div>
      </div>
      <!-- Agent 3 -->
      <div class="col-md-6 col-lg-4 mb-5">
        <div class="team-member-modern">
          <div class="team-member-image">
            <img src="images/xoghaye.jpg" alt="Manager Abdiwali Muse" class="img-fluid">
            <div class="team-member-overlay">
              <div class="social-links">
                <a href="#" class="social-link facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-link twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-link instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-link linkedin"><i class="fab fa-linkedin-in"></i></a>
              </div>
            </div>
          </div>
          <div class="team-member-content">
            <h3 class="team-member-name">Manager Abdiwali Muse</h3>
            <span class="team-member-position">General Manager</span>
            <p class="team-member-description">Strategic leader with extensive experience in property management and customer relations. Oversees all operations to ensure exceptional service delivery and client satisfaction across all our projects.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.team-member-modern {
  background: white;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 8px 32px rgba(0,0,0,0.1);
  transition: all 0.3s ease;
  height: 100%;
  display: flex;
  flex-direction: column;
}

.team-member-modern:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.team-member-image {
  position: relative;
  width: 100%;
  height: 320px;
  overflow: hidden;
}

.team-member-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.team-member-modern:hover .team-member-image img {
  transform: scale(1.05);
}

.team-member-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(135deg, rgba(0,123,255,0.8), rgba(0,86,179,0.8));
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.team-member-modern:hover .team-member-overlay {
  opacity: 1;
}

.social-links {
  display: flex;
  gap: 15px;
}

.social-link {
  width: 45px;
  height: 45px;
  background: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #007bff;
  text-decoration: none;
  font-size: 18px;
  transition: all 0.3s ease;
  transform: translateY(20px);
  opacity: 0;
}

.team-member-modern:hover .social-link {
  transform: translateY(0);
  opacity: 1;
}

.social-link.facebook:hover {
  background: #1877f2;
  color: white;
  transform: translateY(-3px);
}

.social-link.twitter:hover {
  background: #1da1f2;
  color: white;
  transform: translateY(-3px);
}

.social-link.instagram:hover {
  background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
  color: white;
  transform: translateY(-3px);
}

.social-link.linkedin:hover {
  background: #0077b5;
  color: white;
  transform: translateY(-3px);
}

.team-member-content {
  padding: 25px;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.team-member-name {
  font-size: 1.4rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 8px;
  line-height: 1.3;
}

.team-member-position {
  color: #007bff;
  font-weight: 600;
  font-size: 1rem;
  margin-bottom: 15px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.team-member-description {
  color: #666;
  line-height: 1.6;
  font-size: 0.95rem;
  margin: 0;
  flex: 1;
}

/* Animation delays for social links */
.team-member-modern:hover .social-link:nth-child(1) { transition-delay: 0.1s; }
.team-member-modern:hover .social-link:nth-child(2) { transition-delay: 0.2s; }
.team-member-modern:hover .social-link:nth-child(3) { transition-delay: 0.3s; }
.team-member-modern:hover .social-link:nth-child(4) { transition-delay: 0.4s; }

/* Responsive adjustments */
@media (max-width: 991.98px) {
  .team-member-image {
    height: 280px;
  }
  
  .team-member-name {
    font-size: 1.3rem;
  }
  
  .team-member-content {
    padding: 20px;
  }
}

@media (max-width: 767.98px) {
  .team-member-image {
    height: 250px;
  }
  
  .team-member-name {
    font-size: 1.2rem;
  }
  
  .team-member-content {
    padding: 18px;
  }
  
  .social-links {
    gap: 12px;
  }
  
  .social-link {
    width: 40px;
    height: 40px;
    font-size: 16px;
  }
}
</style>

<?php require "includes/footer.php"; ?>

<style>
.property-card-v2 {
  border-radius: 20px;
  box-shadow: 0 4px 24px rgba(0,0,0,0.10);
  background: #fff;
  overflow: hidden;
  transition: box-shadow 0.2s;
  display: flex;
  flex-direction: column;
  height: 100%;
  position: relative;
}
.property-card-v2:hover {
  box-shadow: 0 8px 32px rgba(0,0,0,0.18);
}
.property-card-img-wrap {
  position: relative;
  width: 100%;
  height: 190px; /* increased from 150px for better image visibility */
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
  top: 12px;
  right: 12px;
  background: #fff;
  border: none;
  border-radius: 50%;
  width: 38px;
  height: 38px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 2px 8px rgba(0,0,0,0.10);
  font-size: 1.3rem;
  color: #e74c3c;
  cursor: pointer;
  z-index: 2;
  transition: background 0.15s;
}
.property-fav-btn:hover {
  background: #ffeaea;
}
.property-card-body-v2 {
  padding: 14px 14px 12px 14px; /* tighter padding for compactness */
  flex: 1 1 auto;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: flex-start;
}
.property-type-row {
  display: flex;
  align-items: center;
  margin-bottom: 6px;
  font-size: 1.01rem;
  font-weight: 500;
}
.property-type-dot {
  width: 10px;
  height: 10px;
  background: #007bff;
  border-radius: 50%;
  display: inline-block;
  margin-right: 6px;
}
.property-type-label {
  color: #222;
}
.property-card-price-v2 {
  font-size: 1.4rem;
  font-weight: 700;
  color: #222;
  margin-bottom: 7px;
}
.property-card-specs-row {
  display: flex;
  gap: 12px;
  font-size: 1rem;
  color: #222;
  margin-bottom: 7px;
}
.property-card-specs-row span b {
  font-weight: 700;
  margin-right: 2px;
}
.property-card-address {
  color: #444;
  font-size: 0.98rem;
  margin-bottom: 8px;
}
.property-card-btn-v2 {
  margin-top: 4px;
  background: #007bff;
  color: #fff;
  border: none;
  border-radius: 6px;
  padding: 8px 18px;
  font-size: 1rem;
  text-decoration: none;
  transition: background 0.2s;
  display: inline-block;
}
.property-card-btn-v2:hover {
  background: #0056b3;
  color: #fff;
  text-decoration: none;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.js-fav-btn').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      var propId = this.getAttribute('data-prop-id');
      var icon = this.querySelector('.js-fav-icon');
      var formData = new FormData();
      formData.append('prop_id', propId);
      formData.append('user_id', <?php echo json_encode($_SESSION['user_id'] ?? ''); ?>);
      formData.append('submit', '1');
      fetch('favs/add-fav.php', {
        method: 'POST',
        body: formData
      })
      .then(function(response) { return response.text(); })
      .then(function(data) {
        // On success, change icon to filled
        icon.classList.remove('icon-favorite_border');
        icon.classList.add('icon-favorite');
      });
    });
  });
});
</script>
