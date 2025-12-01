<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>
<?php 


  $select = $conn->query("SELECT * FROM props ORDER BY name DESC");
  $select->execute();

  $props = $select->fetchAll(PDO::FETCH_OBJ);

  if(isset($_GET['type'])) {
    $type = $_GET['type']; 

    $rent = $conn->query("SELECT * FROM props WHERE type='$type'");

    $rent->execute();

    $allListings = $rent->fetchAll(PDO::FETCH_OBJ);
  } else {
    echo "<script>window.location.href='".APPURL."/404.php' </script>";

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
          <h1 class="hero-title">Rent Properties</h1>
          <p class="hero-description">Find your perfect rental home with our extensive collection of properties. From cozy apartments to spacious houses, we have options for every lifestyle and budget.</p>
          <div class="hero-buttons">
            <a href="#properties" class="btn btn-primary hero-btn-primary">View Rentals</a>
            <a href="sale.php?type=sale" class="btn btn-outline-primary hero-btn-secondary">Buy Instead</a>
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
              <span>Rental Homes</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-dollar-sign"></i>
              <span>Affordable</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-shield-alt"></i>
              <span>Secure</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-clock"></i>
              <span>Flexible Terms</span>
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
  background-image: url('images/hero_bg_4.jpg');
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
            <div class="row  align-items-end">
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
                    <option value="sale">sale</option>
                    <option value="rent">rent</option>
                    <option value="lease">lease</option>
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
                <a href="index.html" class="icon-view view-module active"><span class="icon-view_module"></span></a>
                
              </div>
              <div class="ml-auto d-flex align-items-center">
                <div>
                  <a href="<?php echo APPURL; ?>" class="view-list px-3 border-right active">All</a>
                  <a href="rent.php?type=rent" class="view-list px-3 border-right">Rent</a>
                  <a href="sale.php?type=sale" class="view-list px-3">Sale</a>
                  <a href="price.php?price=ASC" class="view-list px-3">Price Ascending</a>
                  <a href="price.php?price=DESC" class="view-list px-3">Price Descending</a>
                </div>


              
              </div>
            </div>
          </div>
        </div>
       
      </div>
    </div>

    <div class="site-section site-section-sm bg-light">
      <div class="container">
        <style>
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
          <?php foreach($allListings as $allListing) : ?>
            <div class="col-md-6 col-lg-4 mb-4">
              <div class="modern-property-card property-card-v2" style="position:relative;">
                <div class="property-card-img-wrap">
                  <a href="property-details.php?id=<?php echo $allListing->id; ?>">
                    <img src="images/<?php echo $allListing->image; ?>" alt="Image" class="modern-property-img" onerror="this.onerror=null;this.src='images/no-image.png';">
                  </a>
                  <?php if (isset($_SESSION['user_id'])): ?>
                    <?php
                    $isFav = false;
                    $favCheckStmt = $conn->prepare("SELECT 1 FROM favs WHERE prop_id = :prop_id AND user_id = :user_id");
                    $favCheckStmt->execute([':prop_id' => $allListing->id, ':user_id' => $_SESSION['user_id']]);
                    $isFav = $favCheckStmt->rowCount() > 0;
                    ?>
                    <form method="POST" action="user/add-fav.php" style="position:absolute;top:16px;right:16px;z-index:3;">
                      <input type="hidden" name="prop_id" value="<?php echo $allListing->id; ?>">
                      <button type="submit" class="property-fav-btn" title="Add to Favourites">
                        <i class="<?php echo $isFav ? 'fas' : 'far'; ?> fa-heart" style="color:#e74c3c;"></i>
                      </button>
                    </form>
                  <?php endif; ?>
                </div>
                <div class="modern-property-body property-card-body-v2" style="align-items: flex-start;">
                  <div class="property-type-row">
                    <span class="property-type-dot"></span>
                    <span class="property-type-label"><?php echo ucfirst($allListing->home_type ?? $allListing->type); ?></span>
                  </div>
                  <div class="property-card-price-v2">$<?php echo $allListing->price; ?></div>
                  <div class="property-card-specs-row">
                    <span><b><?php echo $allListing->rooms; ?></b> room</span>
                    <span><b><?php echo $allListing->baths; ?></b> bath</span>
                  </div>
                  <div class="property-card-address">
                    <div><?php echo $allListing->location; ?></div>
                  </div>
                  <a href="property-details.php?id=<?php echo $allListing->id; ?>" class="modern-property-btn property-card-btn-v2">See Details</a>
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
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis maiores quisquam saepe architecto error corporis aliquam. Cum ipsam a consectetur aut sunt sint animi, pariatur corporis, eaque, deleniti cupiditate officia.</p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-4">
            <a href="#" class="service text-center">
              <span class="icon flaticon-house"></span>
              <h2 class="service-heading">Research Subburbs</h2>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt iure qui natus perspiciatis ex odio molestia.</p>
              <p><span class="read-more">Read More</span></p>
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a href="#" class="service text-center">
              <span class="icon flaticon-sold"></span>
              <h2 class="service-heading">Sold Houses</h2>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt iure qui natus perspiciatis ex odio molestia.</p>
              <p><span class="read-more">Read More</span></p>
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a href="#" class="service text-center">
              <span class="icon flaticon-camera"></span>
              <h2 class="service-heading">Security Priority</h2>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt iure qui natus perspiciatis ex odio molestia.</p>
              <p><span class="read-more">Read More</span></p>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center">
            <div class="site-section-title">
              <h2>Recent Blog</h2>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis maiores quisquam saepe architecto error corporis aliquam. Cum ipsam a consectetur aut sunt sint animi, pariatur corporis, eaque, deleniti cupiditate officia.</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="100">
            <a href="#"><img src="images/img_4.jpg" alt="Image" class="img-fluid"></a>
            <div class="p-4 bg-white">
              <span class="d-block text-secondary small text-uppercase">Jan 20th, 2019</span>
              <h2 class="h5 text-black mb-3"><a href="#">Art Gossip by Mike Charles</a></h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias enim, ipsa exercitationem veniam quae sunt.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="200">
            <a href="#"><img src="images/img_2.jpg" alt="Image" class="img-fluid"></a>
            <div class="p-4 bg-white">
              <span class="d-block text-secondary small text-uppercase">Jan 20th, 2019</span>
              <h2 class="h5 text-black mb-3"><a href="#">Art Gossip by Mike Charles</a></h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias enim, ipsa exercitationem veniam quae sunt.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="300">
            <a href="#"><img src="images/img_3.jpg" alt="Image" class="img-fluid"></a>
            <div class="p-4 bg-white">
              <span class="d-block text-secondary small text-uppercase">Jan 20th, 2019</span>
              <h2 class="h5 text-black mb-3"><a href="#">Art Gossip by Mike Charles</a></h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias enim, ipsa exercitationem veniam quae sunt.</p>
            </div>
          </div>

        </div>

      </div>
    </div> -->

    
    <div class="site-section bg-light">
    <div class="container">
      <div class="row mb-5 justify-content-center">
        <div class="col-md-7">
          <div class="site-section-title text-center">
            <h2>Our Agents</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero magnam officiis ipsa eum pariatur labore fugit amet eaque iure vitae, repellendus laborum in modi reiciendis quis! Optio minima quibusdam, laboriosam.</p>
          </div>
        </div>
      </div>
      <div class="row">
          <div class="col-md-6 col-lg-4 mb-5 mb-lg-5">
            <div class="team-member">

              <img src="images/person_1.jpg" alt="Image" class="img-fluid rounded mb-4">

              <div class="text">

                <h2 class="mb-2 font-weight-light text-black h4">Megan Smith</h2>
                <span class="d-block mb-3 text-white-opacity-05">Real Estate Agent</span>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi dolorem totam non quis facere blanditiis praesentium est. Totam atque corporis nisi, veniam non. Tempore cupiditate, vitae minus obcaecati provident beatae!</p>
                <p>
                  <a href="#" class="text-black p-2"><span class="icon-facebook"></span></a>
                  <a href="#" class="text-black p-2"><span class="icon-twitter"></span></a>
                  <a href="#" class="text-black p-2"><span class="icon-linkedin"></span></a>
                </p>
              </div>

            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-5 mb-lg-5">
            <div class="team-member">

              <img src="images/person_2.jpg" alt="Image" class="img-fluid rounded mb-4">

              <div class="text">

                <h2 class="mb-2 font-weight-light text-black h4">Brooke Cagle</h2>
                <span class="d-block mb-3 text-white-opacity-05">Real Estate Agent</span>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, cumque vitae voluptates culpa earum similique corrupti itaque veniam doloribus amet perspiciatis recusandae sequi nihil tenetur ad, modi quos id magni!</p>
                <p>
                  <a href="#" class="text-black p-2"><span class="icon-facebook"></span></a>
                  <a href="#" class="text-black p-2"><span class="icon-twitter"></span></a>
                  <a href="#" class="text-black p-2"><span class="icon-linkedin"></span></a>
                </p>
              </div>

            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-5 mb-lg-5">
            <div class="team-member">

              <img src="images/person_3.jpg" alt="Image" class="img-fluid rounded mb-4">

              <div class="text">

                <h2 class="mb-2 font-weight-light text-black h4">Philip Martin</h2>
                <span class="d-block mb-3 text-white-opacity-05">Real Estate Agent</span>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores illo iusto, inventore, iure dolorum officiis modi repellat nobis, praesentium perspiciatis, explicabo. Atque cupiditate, voluptates pariatur odit officia libero veniam quo.</p>
                <p>
                  <a href="#" class="text-black p-2"><span class="icon-facebook"></span></a>
                  <a href="#" class="text-black p-2"><span class="icon-twitter"></span></a>
                  <a href="#" class="text-black p-2"><span class="icon-linkedin"></span></a>
                </p>
              </div>

            </div>
          </div>

          

        </div>
    </div>
<?php require "includes/footer.php"; ?>
