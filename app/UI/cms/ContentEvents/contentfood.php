<div class="titelElement">
    <form id="titelForm" action="<?php echo URLROOT; ?>/Cms/editcontent" method="POST" enctype="multipart/form-data">
      <h1 class="heading" name="elementTitel"><?php echo 'Title Element'; ?></h1>
      
      <h2 class="subheading" name="elementSubTitel"><?php echo 'Page title'; ?></h2> 
      <input type="text" name="contentNaam" value="<?php echo $data['PageTitel']->name; ?>" class="textfield">    

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

    <div class="restaurantElement">
      <h1 class="heading" name="elementRestaurant"><?php echo 'Restaurants Element'; ?></h1>

      <form id="dropdowns" action="<?php echo URLROOT; ?>/Cms/editcontent" method="GET">
          <select id="restaurantDropdown" name="restautantSelect" data-name="restaurant">
          <?php
            foreach($data['PageRestaurants'] as $restaurant)
            {
              echo '<option value=' . $restaurant->id . '>' . $restaurant->name . '</option>';
            }
          ?>  
           <input id="event" name="event" type="hidden" value="food">
          </select><input type="submit" value="Search" id="restaurantSubmitButton">
      </form>

      <form id="restaurantForm" action="<?php echo URLROOT; ?>/Cms/editcontent" method="POST" enctype="multipart/form-data"> 

      <h2 class="subheading" name="elementSubTitel"><?php echo 'Restaurant Name'; ?></h2> 
      <input type="text" name="contentNaam" value="<?php echo $data['PageSelectedRestaurant']->name; ?>" class="textfield">

      <h2 class="subheading" name="elementSubTitel"><?php echo 'Restaurant description'; ?></h2> 
      <textarea id="restaurantDescription" name="contentDescription" rows="8" cols="50"><?php echo $data['PageSelectedRestaurant']->description; ?></textarea>
      
      <h2 class="subheading" name="elementSubTitel"><?php echo 'Restaurant Foto'; ?></h2>
      <input type="file" name="content" class="fileToUpload">

      <input id="contentId" name="contentId" type="hidden" value="<?php echo $data['PageSelectedRestaurant']->id; ?>">
      <input id="contentElementType" name="contentElementType" type="hidden" value="<?php echo "restaurantElement"; ?>">
      <input type="submit" value="Submit" id="submitArtistsContent"> 

      <span class="status" name="ArtistElementStatus"><?php echo $data['ArtistElementStatus']; ?></span>
      </form>  
    </div>
      
  </div>