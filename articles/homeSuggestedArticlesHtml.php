
        <!--          Featured blog post           -->
        <?php
        $articlesData = getSuggestedArticles($conn,12);
        foreach( $articlesData  as $articleData){
        $randid = $articleData[0];
        $title = $articleData[1];
        $cover = $articleData[2];
        $categoryName = $articleData[3];
        $categoryDescription = $articleData[4];
        $date = $articleData[5];
        $date = date('jS F Y', strtotime($date));
        $authorrand = $articleData[6];
        $authorName = $articleData[7];
        $category_randid = $articleData[8];
        // $relativecoverpath = preg_replace('/\./', '', $cover, 1);
         // Determine the relative path to the image based on the current file location
        $basePath = '';
        if (basename($_SERVER['SCRIPT_FILENAME']) === 'index.php') {
            $basePath = './articles_cover/';
            $pathprefix="./";
        } else {
            $basePath = '../articles_cover/';
            $pathprefix="../";
        }
        // Extract the image name from the cover path
        $imageName = basename($cover);
        $placeholder=$basePath."placeholder.webp";

        // Construct the relative path to the image using the image name and the determined base path
        $relativecoverpath = $basePath . $imageName;

        $ellipsizedContent=$articleData[9];
         $slug=$articleData[10];
          $authorslug=$articleData[11];
           $catslug=$articleData[12];

        $html = '
        <div class="card mb-2" onmouseover="this.querySelector(\'.title\').style.color=\'#1845cd\';
        this.querySelector(\'.article_image\').style.filter=\'grayscale(10%)\';"
        onmouseout=" this.querySelector(\'.article_image\').style.filter=\'\'; this.querySelector(\'.title\').style.color=\'\';">
                <a href="'.$pathprefix.'article/'.$slug.'" style="width: 100%; ">
                <img class="card-img-top lazy article_image mt-3" style="width:90%;height=302px; margin-left:5%;" 
                data-src="' . $relativecoverpath . '" src="' . $placeholder . '"alt=" Cover Image"  />
                </a>
                <div class="card-body">
                    <div class=" text-muted small my-2">
                    <a href="'.$pathprefix.'category/'.$catslug.'" class="text-primary px-2 me-1 border rounded-pill  border-secondary"
                    style="text-decoration:none; font-size:12px;" title="'.$categoryDescription .'">
                    <i  class="fa fa-folder"> </i>    ' . $categoryName . '
                     </a>
                    <a href="'.$pathprefix.'author/'.$authorslug.'" class="px-2 border rounded-pill  border-secondary"
                    style="color: #d24d33;text-decoration:none; font-size:12px;" title="Posts By '.$authorName .'">
                    <i  class="fa fa-user"> </i> ' . $authorName . '
                     </a>              
                    </div>
                    <a href="'.$pathprefix.'article/'.$slug.'" class=" h5 headingFont title fw-bold">
                   '. $title . '
                        </a>
                    <p class="card-text bodyFont mt-2">'. $ellipsizedContent.'</p>
                </div>
                
            </div>
                ';
        echo $html;
        }
        ?>
