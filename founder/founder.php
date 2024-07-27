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
    <i class="fa fa-user me-1"> </i> About The Founder
</div>
  <div class="card-body bg-secondary text-light">
    <div class="row">
    <div class="col-3 ">
      <img src="<?php $basePath?>founder/founder.png" class="rounded-circle border border-light" 
      style="height:60px;width:60px;">
      </div>
      <div class=" col-9  "> 
      <span class=" bodyFont">
      <?php echo $founderName?> 
      </span>
      <p class=" small">
      Founder
      </p>
    </div>
    </div>
    <div >
      <p class="text-light articleFont" style="font-size:12px;">
      A visionary in the realms of physics, chemistry, and programming, 
      brings together a passion for programmable medicine and quantum mechanics. Embark on an 
      enlightening journey exploring captivating subjects that span science, technology, 
      and personal growth. Join in to explore, learn, and engage with mind-expanding content 
      across various categories.
      </p>
    </div>
  
  </div>
</div>


