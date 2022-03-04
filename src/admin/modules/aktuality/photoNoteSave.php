<?php
   
    
      $query = "UPDATE tbAktualityPhotos SET
                   note = '$note'
                   WHERE file = $target";


new sql($query);



