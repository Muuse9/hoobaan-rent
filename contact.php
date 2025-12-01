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
          <h1 class="hero-title">Contact Us</h1>
          <p class="hero-description">Get in touch with our team. We're here to help you find your perfect home and answer any questions you may have.</p>
          <div class="hero-buttons">
            <a href="#contact-form" class="btn btn-primary hero-btn-primary">Send Message</a>
            <a href="#contact-info" class="btn btn-outline-primary hero-btn-secondary">Contact Info</a>
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
              <i class="fas fa-phone"></i>
              <span>Call Us</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-envelope"></i>
              <span>Email Us</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-map-marker-alt"></i>
              <span>Visit Us</span>
            </div>
            <div class="hero-icon-item">
              <i class="fas fa-clock"></i>
              <span>24/7 Support</span>
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
    

    <div class="site-section">
      <div class="container">
        <div class="row">
       
          <div class="col-md-12 col-lg-8 mb-5">
          
            
          
            <form action="#" class="p-5 bg-white border">

              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="font-weight-bold" for="fullname">Full Name</label>
                  <input type="text" id="fullname" class="form-control" placeholder="Full Name">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="font-weight-bold" for="email">Email</label>
                  <input type="email" id="email" class="form-control" placeholder="Email Address">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="font-weight-bold" for="email">Subject</label>
                  <input type="text" id="subject" class="form-control" placeholder="Enter Subject">
                </div>
              </div>
              

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="font-weight-bold" for="message">Message</label> 
                  <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Say hello to us"></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Send Message" class="btn btn-primary  py-2 px-4 rounded-0">
                </div>
              </div>

  
            </form>
          </div>

          <div class="col-lg-4">
            <div class="p-4 mb-3 bg-white">
              <h3 class="h6 text-black mb-3 text-uppercase">Contact Info</h3>
              <p class="mb-0 font-weight-bold">Address</p>
              <p class="mb-4">A.Dhagax District., Hargeysa, Somalia, n/a</p>

              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-4"><a href="#">+25263 4403775</a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="#">hoobaan.cc@gmail.com</a></p>

            </div>
            
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