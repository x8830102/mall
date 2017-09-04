<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"> <?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <style>
      .about {font-size: 16px;color: rgba(255, 255, 255, 0.7)}
      .about tr {height: 55px;border-top: 1px solid #999}
    </style>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>
	  <div class="image" style="width: 15%"><a href="<?php echo $link; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" class="img-responsive" /></a></div>
	  <legend style="border-bottom:0px"></legend>
	  <div>
        <table class="about">
          <tbody>
              <tr>
                <td style="width:20%"><strong><?php echo $text_company_name; ?></strong></td>
                <td><?php echo $company_name; ?></td>
              </tr>
			  <?php if ($rating) { ?>
			  <tr>
                <td><strong><?php echo $text_rating; ?></strong></td>
                <td>
				  <?php if ($rating) { ?>
				  <div class="rating" title="<?php echo $rating; ?>">
                  <?php for ($i = 1; $i <= 5; $i++) { ?>
                  <?php if ($rating < $i) { ?>
                  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } else { ?>
                  <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } ?>
                  <?php } ?>
                </div>
                <?php } ?></td>
              </tr>
			  <?php } ?>
			  <tr>
                <td><strong><?php echo $text_name; ?></strong></td>
                <td><?php echo $name; ?></td>
              </tr>
			  <?php if ($telephone) { ?>
			  <tr>
                <td><strong><?php echo $text_telephone; ?></strong></td>
                <td><?php echo $telephone; ?></td>
              </tr>
			  <?php } ?>
			  <?php if ($fax) { ?>
			  <tr>
                <td><strong><?php echo $text_fax; ?></strong></td>
                <td><?php echo $fax; ?></td>
              </tr>
			  <?php } ?>
			  <?php if ($location) { ?>
			  <!--<tr>
                <td><strong><?php echo $text_location; ?></strong></td>
                <td><?php echo $location; ?></td>
              </tr>-->
			  <?php } ?>
			  <tr>
                <td><strong><?php echo $text_email; ?></strong></td>
                <td><?php echo $email; ?></td>
              </tr>
			  <tr>
                <td><strong><?php echo $text_address_1; ?></strong></td>
                <td><?php echo $postcode; ?><?php echo $city; ?><?php echo $address_1; ?></td>
              </tr>
			  <!--<tr>
                <td><strong><?php echo $text_city; ?></strong></td>
                <td><?php echo $city; ?></td>
              </tr>-->
			  <!--<tr>
                <td><strong><?php echo $text_country; ?></strong></td>
                <td><?php echo $country; ?></td>
              </tr>-->
			  <!--<tr>
                <td><strong><?php echo $text_zone; ?></strong></td>
                <td><?php echo $zone; ?></td>
              </tr>-->
			  <!--<tr>
                <td><strong><?php echo $text_postcode; ?></strong></td>
                <td><?php echo $postcode; ?></td>
              </tr>-->
       
        <tr>
                
                <td colspan="2" style="padding: 8px"><?php echo $description; ?></td>
              </tr>
          </tbody>
        </table>
      </div>
        <fieldset>
        <legend style="border-bottom:0px"></legend>
		<?php if ($geocode) {
			$geodata = explode(',',$geocode);
		} else {
			$geodata[0]='';
			$geodata[1]='';
		} ?>	
		
		<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_key; ?>&libraries=places&callback=initMap"></script>
		<script>
		function initialize() {    	
			
		  var addressLatLng = new google.maps.LatLng(<?php echo $geodata[0]; ?>,<?php echo $geodata[1]; ?>);
		  var store = '<?php echo isset($vendor_name) ? $vendor_name : ''; ?>';
		  var mapproperties = {
			center:     addressLatLng,
			zoom:       11,    	  
			panControl: false,
			zoomControl:true,
			mapTypeControl:false,
			disableDefaultUI:true,
			streetViewControl:true,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		  };
		  
		  var map=new google.maps.Map(document.getElementById("seller_googlemap"),mapproperties);
		  var marker = new google.maps.Marker({
			position: addressLatLng,
			map: map,
			title: store
		  });       
		}
		
		google.maps.event.addDomListener(window, 'load', initialize);
		</script>

		<?php if ($geocode) { ?>
		<div id="seller_googlemap" style="width:100%;height:400px;"></div>
        <?php } ?>
		
	  </fieldset>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script>
<?php echo $footer; ?>
