<?php
   
    
      $query = "UPDATE tbAkcePhotos SET
                   note = '$note'
                   WHERE file = $target";


new sql($query);



