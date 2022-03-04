<?php    



    
      $query = "UPDATE tbAktualityPhotos SET
                   isDel = 1
                   WHERE file = $target";


new sql($query);



