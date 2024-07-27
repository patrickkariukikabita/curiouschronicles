<?php
 if (basename($_SERVER['SCRIPT_FILENAME']) === 'index.php') {
        $pathprefix = './';
      } else {
        $pathprefix = '../';
      }
      ?>
<footer class="footer bg-dark py-4 me-2 container-fluid">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-center align-items-center ">
            <a href="<?php echo $pathprefix?>terms/privacyPolicy.php" class="text-warning fw-bold bg-transparent border btn mx-2 p-2"> Privacy Policy</a>
           <a href="<?php echo $pathprefix?>terms/termsOfService.php" class="text-warning fw-bold bg-transparent border btn mx-2 p-2"> Terms Of Service</a>
           <a href="<?php echo $pathprefix?>author/authorSignup.php" class="text-warning fw-bold bg-transparent border btn mx-2 p-2"> Become A writer</a>
            </div>
            </div>
      <div class="row">
        <div class="col text-center  mb-2">
          <div class="mb-3 h3">Connect with us: </div>
          <div class="contact-icons">
            <a href="https://www.facebook.com" target="_blank" class="btn mx-auto text-primary border border-secondary "><i class="fa fa-facebook fa-lg mx-3"></i></a>
            <a href="https://www.twitter.com/PatrickKabita" target="_blank" class="btn mx-auto text-primary border border-secondary "><i class="fa fa-twitter fa-lg mx-3"></i></a>
            <a href="https://www.linkedin.com/in/patrick-kariuki-kabita" target="_blank" class="btn mx-auto text-primary border border-secondary  "><i class="fa fa-linkedin fa-lg mx-3"></i></a>
            <a href="https://www.github.com/patrickkariukikabita" target="_blank" class="btn mx-auto text-light border border-secondary "><i class="fa fa-github fa-lg mx-3"></i></a>
            <a href="https://wa.me/+1937 793 7489" target="_blank" class="btn mx-auto text-success border border-secondary "><i class="fa fa-whatsapp fa-lg mx-3 "></i></a>
          </div>
          <div class="my-3  text-primary">  Call us : <span class="mx-3"> +1 937 793 7489  </span > OR <span class="mx-3">   +1 937 793 7489</span>  </div>
        </div>
      </div>
      <p class="m-0 text-center text-white">Copyright &copy; <?php echo $sitename?> 2023</p>
    </div>
  </footer>