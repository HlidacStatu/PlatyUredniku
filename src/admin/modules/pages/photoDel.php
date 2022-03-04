<?php    



    
      $query = "UPDATE tbPagesPhotos SET
                   isDel = 1
                   WHERE file = $target";


new sql($query);



