<!-- Side widget-->
<div class="card mb-4">
<?php
      if (basename($_SERVER['SCRIPT_FILENAME']) === 'index.php') {
        $basePath = './';
        $homepath="index.php";
      } else {
        $basePath = '../';
        $homepath="../";
      }
  ?>
<div class="card-header headingFont fw-bold text-light bg-secondary"> 
    <i class="fa fa-emvelope-0 me-1"> </i> Join Our Mailing List
</div>
  <div class="card-body bg-secondary text-light">
  
      <p class="text-light articleFont" style="font-size:12px;">
      A visionary in the realms of physics, chemistry, and programming, 
      brings together a passion for programmable medicine and quantum mechanics. Embark on an 
      enlightening journey exploring captivating subjects that span science, technology, 
      and personal growth. Join in to explore, learn, and engage with mind-expanding content 
      across various categories.
      </p>
 
  
  </div>
</div>


