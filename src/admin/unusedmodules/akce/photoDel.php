<?php    



    
      $query = "UPDATE tbAkcePhotos SET
                   isDel = 1
                   WHERE file = $target";


new sql($query);



