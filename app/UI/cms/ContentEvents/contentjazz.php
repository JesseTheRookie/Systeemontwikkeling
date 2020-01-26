<div class="titelElement">
    <form id="titelForm" action="<?php echo URLROOT; ?>/Cms/editcontent" method="POST" enctype="multipart/form-data">
      <h1 class="heading" name="elementTitel"><?php echo 'Title Element'; ?></h1>
      
      <h2 class="subheading" name="elementSubTitel"><?php echo 'Page title'; ?></h2> 
      <input type="text" name="contentNaam" value="<?php echo $data['PageTitel']->naam; ?>" class="textfield">    

      <h2 class="subheading" name="elementSubTitel"><?php echo 'Buttons names'; ?></h2>
      <input type="text" name="contentDescription" value="<?php echo $data['PageTitel']->description; ?>" class="textfield">

      <h2 class="subheading" name="elementSubTitel"><?php echo 'Top left foto'; ?></h2>
      <input type="file" name="content" class="fileToUpload">

      <input id="contentId" name="contentId" type="hidden" value="<?php echo $data['PageTitel']->id; ?>">
      <input id="contentElementType" name="contentElementType" type="hidden" value="<?php echo "titelElement"; ?>">
      <input type="submit" value="Submit" id="submitArtistTitel">  


      <span class="status" name="TitelElementStatus"><?php echo $data['TitelElementStatus']; ?></span>
    </form>  
</div>

    <div class="artistElement">
      <form id="artistsForm" action="<?php echo URLROOT; ?>/Cms/editcontent" method="POST" enctype="multipart/form-data">
        <h1 class="heading" name="elementArtist"><?php echo 'Artists Element'; ?></h1> 
        <table>
        <?php
            echo "<tr>";
              echo "<th></th>";
              echo "<th>Naam</th>";
              echo "<th>Description</th>";
              echo "<th>Content</th>";
            echo "</tr>";
        ?>

        <?php
          foreach($data['PageArtists'] AS $artist)
          { 
            echo "<tr>";  
              echo '<td>
                      <div class="radio">
                        <label>
                          <input type="radio" name="contentId" value=' . $artist->id . '>
                        </label>
                      </div>
                    </td>';
              echo '<td>' . $artist->naam . '</td>';
              echo '<td>' . $artist->description . '</td>';
              echo '<td>' . $artist->content . '</td>';
              echo "</tr>";
          }
        ?>
      </table>

      <h2 class="subheading" name="elementSubTitel"><?php echo 'Artist Name'; ?></h2> 
      <input type="text" name="contentNaam" value="" class="textfield">

      <h2 class="subheading" name="elementSubTitel"><?php echo 'Artist description'; ?></h2> 
      <input type="text" name="contentDescription" value="" class="textfield">

      <h2 class="subheading" name="elementSubTitel"><?php echo 'Artist Foto'; ?></h2>
      <input type="file" name="content" class="fileToUpload">

      <input id="contentElementType" name="contentElementType" type="hidden" value="<?php echo "artistElement"; ?>">
      <input type="submit" value="Submit" id="submitArtistsContent"> 

      <span class="status" name="ArtistElementStatus"><?php echo $data['ArtistElementStatus']; ?></span>
      </form>  
    </div>
      
  </div>