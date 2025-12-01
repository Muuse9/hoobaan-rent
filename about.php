<?php require "includes/header.php"; ?>

<!-- Modern Hero Section -->
<div class="modern-hero-section">
  <div class="hero-background">
    <div class="hero-overlay"></div>
  </div>
  <div class="container">
    <div class="row align-items-center min-vh-100">
      <div class="col-lg-6">
        <div class="hero-content">
          <h1 class="hero-title">About Hoobaan Construction</h1>
          <p class="hero-description">Building the future of Somaliland with strength, style, and sustainability. We are committed to delivering exceptional construction services that transform communities.</p>
          <div class="hero-buttons">
            <a href="#about" class="btn btn-primary hero-btn-primary">Learn More</a>
            <a href="contact.php" class="btn btn-outline-primary hero-btn-secondary">Contact Us</a>
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
              <i class="fas fa-hard-hat"></i>
              <span>Construction</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-leaf"></i>
              <span>Sustainable</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-award"></i>
              <span>Quality</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-users"></i>
              <span>Community</span>
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

/* Video Section */
.video-section .shadow-lg {
  border-radius: 15px;
  overflow: hidden;
}

/* About Section */
.site-section-title h2 {
  font-weight: 700;
  font-size: 2.5rem;
  margin-bottom: 25px;
}

.lead {
  font-size: 1.2rem;
  font-weight: 500;
}

.site-section p {
  font-size: 1rem;
  line-height: 1.7;
  color: #555;
}
</style>

<!-- Video Section -->
<div class="site-section bg-light video-section" id="about">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-7 text-center">
        <div class="site-section-title">
          <h2>Our Work in Action</h2>
          <p>See how Hoobaan Construction is building Somaliland market's future</p>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="shadow-lg">
          <video controls width="100%" height="auto" style="border-radius: 15px;">
            <source src="video/hoobaan.mp4" type="video/mp4">
            Your browser does not support the video tag.
          </video>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- About Section -->
<div class="site-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
        <img src="images/about.png" alt="Hoobaan Construction Site" class="img-fluid rounded shadow">
      </div>
      <div class="col-md-5 ml-auto" data-aos="fade-up" data-aos-delay="200">
        <div class="site-section-title">
          <h2>Our Company</h2>
        </div>
        <p class="lead">Hoobaan Construction is a premier building firm specializing in sustainable, resilient structures for Somaliland's unique climate.</p>
        <p>Founded in 2010, we've completed over 150 projects across Mogadishu and surrounding regions. Our team combines international engineering standards with local craftsmanship to deliver buildings that withstand extreme weather while maintaining cultural authenticity.</p>
        <p><a href="#" class="btn btn-primary rounded-0 py-2 px-5">View Our Projects</a></p>
      </div>
    </div>
  </div>
</div>

<?php require "includes/footer.php"; ?>
