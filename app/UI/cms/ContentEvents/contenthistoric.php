<div class="historicElement">
    <form action="<?php echo URLROOT; ?>/Cms/editcontent" method="GET" enctype="multipart/form-data">
      <h1 class="heading" name="elementTitel"><?php echo 'Historic page images'; ?></h1>
      
      <select class="historicDropdown" name="imageSelect" data-name="historicImage">
        <option value='<?php echo $data['PageHistoricImages'][0]->id ?>'>Top right image</option>
        <option value='<?php echo $data['PageHistoricImages'][1]->id ?>'>Bottom left image</option>
          
        <input id="event" name="event" type="hidden" value="historic">
      </select><input type="submit" value="Search" id="restaurantSubmitButton">
    </form>

      <form id="historicForm" action="<?php echo URLROOT; ?>/Cms/editcontent" method="POST" enctype="multipart/form-data"> 

        <h2 class="subheading" name="elementSubTitel"><?php echo 'Name'; ?></h2> 
        <input type="text" name="contentNaam" value="<?php echo $data['PageSelectedImage']->name; ?>" class="textfield2">

        <h2 class="subheading" name="elementSubTitel"><?php echo 'description'; ?></h2> 
        <textarea id="restaurantDescription" name="contentDescription" rows="2" cols="30"><?php echo $data['PageSelectedImage']->description; ?></textarea>
        
        <h2 class="subheading" name="elementSubTitel"><?php echo 'Image'; ?></h2>
        <input type="file" name="content" class="fileToUpload">

        <input id="contentId" name="contentId" type="hidden" value="<?php echo $data['PageSelectedText']->id; ?>">
        <input id="contentElementType" name="contentElementType" type="hidden" value="<?php echo "historicElement"; ?>">
        <input type="submit" value="Submit" id="submitArtistsContent"> 

        <span class="status" name="ArtistElementStatus"><?php echo $data['ArtistElementStatus']; ?></span>
      </form>    
</div>

<div class="historicElement">
    <form action="<?php echo URLROOT; ?>/Cms/editcontent" method="GET" enctype="multipart/form-data">
      <h1 class="heading" name="elementTitel"><?php echo 'Historic page texts'; ?></h1>
      
      <select class="historicDropdown" name="textSelect" data-name="historicText">
        <option value='<?php echo $data['PageHistoricTexts'][0]->id ?>'>Top left text</option>
        <option value='<?php echo $data['PageHistoricTexts'][1]->id ?>'>Bottom right text</option>
          
        <input id="event" name="event" type="hidden" value="historic">
      </select><input type="submit" value="Search" id="restaurantSubmitButton">
    </form>

      <form id="historicForm" action="<?php echo URLROOT; ?>/Cms/editcontent" method="POST" enctype="multipart/form-data"> 

        <h2 class="subheading" name="elementSubTitel"><?php echo 'Title'; ?></h2> 
        <input type="text" name="contentNaam" value="<?php echo $data['PageSelectedText']->name; ?>" class="textfield2">

        <h2 class="subheading" name="elementSubTitel"><?php echo 'Description'; ?></h2> 
        <textarea id="restaurantDescription" name="contentDescription" rows="4" cols="30"><?php echo $data['PageSelectedText']->description; ?></textarea>
        
        <h2 class="subheading" name="elementSubTitel"><?php echo 'Button text'; ?></h2>
        <input type="text" name="contentNaam" value="<?php echo $data['PageSelectedText']->content; ?>" class="textfield2">

        <input id="contentElementType" name="contentElementType" type="hidden" value="<?php echo "historicElement"; ?>">
        <input type="submit" value="Submit" id="submitArtistsContent"> 

        <input id="contentId" name="contentId" type="hidden" value="<?php echo $data['PageSelectedText']->id; ?>">
        <span class="status" name="ArtistElementStatus"><?php echo $data['ArtistElementStatus']; ?></span>
      </form>    
</div>

<div id="locationElement">
    <form action="<?php echo URLROOT; ?>/Cms/editcontent" method="GET" enctype="multipart/form-data">
      <h1 class="heading" name="elementTitel"><?php echo 'Historic page texts'; ?></h1>
      
      <form class="dropdowns" action="<?php echo URLROOT; ?>/Cms/editcontent" method="GET">
          <select class="historicDropdown" name="locationSelect" data-name="location">
          <?php
            foreach($data['PageLocations'] as $location)
            {
              echo '<option value=' . $location->id . '>' . $location->name . '</option>';
            }
          ?>  
           <input id="event" name="event" type="hidden" value="historic">
          </select><input type="submit" value="Search" id="restaurantSubmitButton">
      </form>

      <form id="historicForm" action="<?php echo URLROOT; ?>/Cms/editcontent" method="POST" enctype="multipart/form-data"> 

        <h2 class="subheading" name="elementSubTitel"><?php echo 'Location name'; ?></h2> 
        <input type="text" name="contentNaam" value="<?php echo $data['PageSelectedlocation']->name; ?>" class="textfield2">

        <h2 class="subheading" name="elementSubTitel"><?php echo 'Description'; ?></h2> 
        <textarea id="restaurantDescription" name="contentDescription" rows="6" cols="60"><?php echo $data['PageSelectedlocation']->description; ?></textarea>
        
        <h2 class="subheading" name="elementSubTitel"><?php echo 'Location image'; ?></h2>
        <input type="file" name="content" class="fileToUpload">

        <input id="contentId" name="contentId" type="hidden" value="<?php echo $data['PageSelectedText']->id; ?>">
        <input id="contentElementType" name="contentElementType" type="hidden" value="<?php echo "locationElement"; ?>">
        <input type="submit" value="Submit" id="submitArtistsContent"> 

        <span class="status" name="ArtistElementStatus"><?php echo $data['ArtistElementStatus']; ?></span>
      </form>    
</div>


