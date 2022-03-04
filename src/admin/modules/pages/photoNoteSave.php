<?php
   
    
      $query = "UPDATE tbPagesPhotos SET
                   note = '$note'
                   WHERE file = $target";


new sql($query);



