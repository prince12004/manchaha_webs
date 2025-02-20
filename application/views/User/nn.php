    <!------------- hero container A section------------>
    <?php 

    $pick_data = $this->db->get_where('settings', "settings_id=12 OR settings_id=13 OR settings_id=14 OR settings_id=15 OR settings_id=16 OR settings_id=17")->result();
      $pick_start_time = $pick_end_time = $price_increase_percentage = "";
      foreach($pick_data as $p){ 
         if($p->settings_id == 12){
            $pick_start_time = $p->description;
         }
         elseif($p->settings_id == 13){
            $pick_end_time = $p->description;
         }
         elseif($p->settings_id == 14){
            $price_increase_percentage = $p->description;
         }
         
          elseif($p->settings_id == 15){
            $price_decrease_percentage = $p->description;
         }
          elseif($p->settings_id == 16){
            $down_start_time = $p->description;
         }
          elseif($p->settings_id == 17){
            $down_end_time = $p->description;
         }
  } 
   ?>


    <div class="heading-cont bookings-sum"
        style="background-image: url('<?= base_url(); ?>assets/v2/images/car-rental-7.png'); height: 280px">
        <div class="content bookings-sums-content">
            <h1 class="big-heading">Book Cars</h1>
            <h5 class="green-text">
                <a href="<?= base_url(); ?>" class="green-text">Home</a> | Book Cars
            </h5>
        </div>
    </div>
    <section class="main-booking-container">
        <div class="rental-care-container-bookcars">
            <form action="<?= base_url(); ?>Book" method="get" id="searchCarForm">
                <div class="rental-care-box-books">
                    <div class="form-group mains-bookings">
                        <div class="input-field">
                            <label for="location">Location</label>
                            <img src="<?= base_url(); ?>assets/v2/images/locations.png" id="mains-calendars"
                                style="width: 16px" />
                            <?php  $cid= isset($_GET['city'])?$_GET['city']:''; 
                  	$cityName = $this->db->get_where("city", array('city_id'=>$cid))->row();
                    ?>
                            <input type="text" class="city_name" id="location-input"
                                value="<?php echo  $cityName->name?>" placeholder="Select City">
                            <input type="hidden" name="city" class="city_name" value="<?= $cid ?>"
                                id="location-input_data">
                            <input type="hidden" name="latitude" class="latitude">
                            <input type="hidden" name="longitude" class="longitude">

                        </div>
                        <div class="main-checkings">
                            <div class="input-field select-city">
                                <label for="check-in">Start Date</label>
                                <img src="<?= base_url(); ?>assets/v2/images/calendars.png" alt=""
                                    id="mains-calendars" />
                                <input readonly autocomplete="off" name="start" type="text" class="start-timepicker"
                                    id="ssd_start" placeholder=" Select start Time" style="cursor: pointer" required
                                    value="<?= date('d-m-Y H:i', strtotime($_GET['start'])); ?>" />
                                <!-- <input type="text" id="check-in-bookings" placeholder="Select start date">  -->
                            </div>
                            <div class="input-field select-city">
                                <label for="check-out">End Date</label>
                                <img src="<?= base_url(); ?>assets/v2/images/calendars.png" id="mains-calendars" />
                                <input readonly autocomplete="off" name="end" type="text" class="end-timepicker"
                                    id="sed_end" placeholder="Select end Time" style="cursor: pointer"
                                    value="<?= date('d-m-Y H:i', strtotime($_GET['end'])); ?>" />
                                <!-- <input type="text" id="check-out-bookings" placeholder="Select end date">  -->

                            </div>
                        </div>
                        <button class="search-btn bokkings-search find-cars2 " type="submit">
                            <i class="fa-solid fa-magnifying-glass" id="searchs"></i>
                            Search Cars
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <section class="main-filtes-response">
            <form action="<?= base_url(); ?>Book" method="get">
                <input type="hidden" name="city" value="<?=  $_GET['city'] ?>">
                <input type="hidden" name="start" value="<?= date('d-m-Y H:i', strtotime($_GET['start'])); ?>">
                <input type="hidden" name="end" value="<?= date('d-m-Y H:i', strtotime($_GET['end'])); ?>">
                <input type="hidden" name="latitude" class="latitude">
                <input type="hidden" name="longitude" class="longitude">
                <div class="toggle-image-responsive">
                    <div class="togless">
                        <img src="<?= base_url(); ?>assets/v2/images/toggle-image.png" id="toggle-filter-btn" />
                    </div>
                    <div class="filter-option" data-filter="Maruti">
                        <!--<i class="fa-solid fa-xmark" id="closes"></i>-->
                        Filter cars
                    </div>
                    <!--<div class="filter-option" data-filter="Sedan">-->
                    <!--  <i class="fa-solid fa-xmark" id="closes"></i>-->
                    <!--  Sedan-->
                    <!--</div>-->
                    <!--<div class="filter-option" data-filter="Manual">-->
                    <!--  <i class="fa-solid fa-xmark" id="closes"></i>-->
                    <!--  Manual-->
                    <!--</div>-->
                </div>
        </section>
        <div class="main-reds-filter">
            <div class="left-side-filters">
                <div class="filter-opens">
                    <div class="d-flex"
                        style="justify-content: space-between; align-items: center; margin-bottom: 10px; ">
                        <h3 class="fiter-headings">Filter</h3>
                        <span>
                            <i class="fa-solid fa-xmark" id="close-filter"></i>
                        </span>
                    </div>
                </div>


                <div class="filter-container">
                    <div class="filter">
                        <div class="d-flex mb-2" style="justify-content: space-between">
                            <div class="filter-label">Select Car Type</div>
                            <div class="clear-all">
                                <i class="fa-solid fa-arrow-up" style="color: black"></i>
                            </div>
                        </div>
                        <div class="filter-options-type">
                            <div class="filter-options" data-filter="Maruti">
                                <input type="radio" name="car_type" value="Sedan" class="filter-checkbox"
                                    <?= (isset($_GET['car_type']) && $_GET['car_type'] == 'Sedan') ? 'checked' : '' ?> />
                                <span>Sedan</span>
                            </div>
                            <div class="filter-options" data-filter="Sedan">
                                <input type="radio" name="car_type" value="Hatch Back" class="filter-checkbox"
                                    <?= (isset($_GET['car_type']) && $_GET['car_type'] == 'Hatch Back') ? 'checked' : '' ?> />
                                <span>Hatch Back</span>
                            </div>
                            <div class="filter-options" data-filter="Manual">
                                <input type="radio" name="car_type" value="SUV" class="filter-checkbox" value="SUV"
                                    <?= (isset($_GET['car_type']) && $_GET['car_type'] == 'SUV') ? 'checked' : '' ?> />
                                <span>SUV</span>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="filter-container">
                    <div class="filter">
                        <div class="d-flex mb-2" style="justify-content: space-between">
                            <div class="filter-label">Select Fuel Type</div>
                            <div class="clear-all">
                                <i class="fa-solid fa-arrow-up" style="color: black"></i>
                            </div>
                        </div>

                        <div class="filter-options-type">
                            <div class="filter-options" data-filter="Maruti">
                                <input type="radio" name="fuel" value="Petrol"
                                    <?= (isset($_GET['fuel']) && $_GET['fuel'] == 'Petrol') ? 'checked' : '' ?>
                                    class="filter-checkbox" />
                                <span>Petrol</span>
                            </div>
                            <div class="filter-options" data-filter="Sedan">
                                <input type="radio" name="fuel" value="CNG" class="filter-checkbox"
                                    <?= (isset($_GET['fuel']) && $_GET['fuel'] == 'CNG') ? 'selected' : '' ?> />
                                <span>CNG</span>
                            </div>
                            <div class="filter-options" data-filter="Manual">
                                <input type="radio" name="fuel" value="Diesel" class="filter-checkbox"
                                    <?= (isset($_GET['fuel']) && $_GET['fuel'] == 'Diesel') ? 'selected' : '' ?> />
                                <span>Diesel</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-container">
                    <div class="filter">
                        <div class="d-flex mb-2" style="justify-content: space-between">
                            <div class="filter-label">Select Seats</div>
                            <div class="clear-all">
                                <i class="fa-solid fa-arrow-up" style="color: black"></i>
                            </div>
                        </div>
                        <div class="filter-options-type">
                            <div class="filter-options" data-filter="Maruti">

                                <input type="radio" name="seats" class="filter-checkbox" value="5"
                                    <?= (isset($_GET['seats']) && $_GET['seats'] == '5') ? 'checked' : '' ?> />
                                <span>05</span>
                            </div>
                            <div class="filter-options" data-filter="Sedan">
                                <input type="radio" name="seats" class="filter-checkbox" value="6"
                                    <?= (isset($_GET['seats']) && $_GET['seats'] == '6') ? 'checked' : '' ?> />
                                <span>06</span>
                            </div>
                            <div class="filter-options" data-filter="Manual">
                                <input type="radio" name="seats" class="filter-checkbox" value="7"
                                    <?= (isset($_GET['seats']) && $_GET['seats'] == '7') ? 'checked' : '' ?> />
                                <span>07</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-container">
                    <div class="filter">
                        <div class="d-flex mb-2" style="justify-content: space-between">
                            <div class="filter-label">Select Transmission</div>
                            <div class="clear-all">
                                <i class="fa-solid fa-arrow-up" style="color: black"></i>
                            </div>
                        </div>
                        <div class="filter-options-type">
                            <div class="filter-options" data-filter="Maruti">
                                <input type="radio" name="transmission" value="Manual"
                                    <?= (isset($_GET['transmission']) && $_GET['transmission'] == 'Manual') ? 'checked' : '' ?>
                                    class="filter-checkbox" />
                                <span>Manual</span>
                            </div>
                            <div class="filter-options" data-filter="Sedan">
                                <input type="radio" name="transmission" value="Automatic"
                                    <?= (isset($_GET['transmission']) && $_GET['transmission'] == 'Automatic') ? 'checked' : '' ?>
                                    class="filter-checkbox" />
                                <span>Automatic</span>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" id="find-cars"
                    class="booking-car-find-care-btn mobile-go-btn find-main-button">Filter Cars</button>
            </div>
            </form>

            <div class="booking-cars-container">

                <?php  if(isset($_GET['city'])){
               
               $date_now = new DateTime($_GET['start']);
               
               $date_convert = new DateTime($_GET['end']);
   
               if ($date_convert > $date_now) {
   
                   if(!empty($car)){ 
                       
                       if(isset($_GET['start']) && $_GET['end']){
                          $getStart = date("Y-m-d H:i:s", strtotime($_GET['start']));
                          $getEnd = date("Y-m-d H:i:s", strtotime($_GET['end']));
                       }
                             
                       $car_array = [];
                      
                       foreach($car as $c){  
                           $availability = "available";
                           $card_opacity = 1.0;
                           $checkIfCarBooked = 0;
                           $car_id = $c->car_id;
                           
                           $diff_begin = new DateTime($getStart);
                           $diff_end = new DateTime($getEnd);
                           $interval = DateInterval::createFromDateString('1 hour');
                           $period_diff = new DatePeriod($diff_begin, $interval, $diff_end);
                           
                           $dateDiff = null;
                           $i = 0;
                           
                           foreach ($period_diff as $k => $dt) 
                           {
                               $dateDiff = $dt->format("Y-m-d H:i:s");
                           }
                           
                           
                          
                           $wher = [
                               "availability >=" => $diff_begin->format("Y-m-d H:i:s"), 
                               "car_id" => $car_id, 
                               "payment_status" => 1,
                               "start <" => $diff_end->format("Y-m-d H:i:s"), //start datetime of booked car is less than end datetime
                           ];
                              
                           $checkSql = $this->db->get_where("booking", $wher)->num_rows();
                           // print_r($checkSql);die;
                           
                           if($checkSql > 0){
                              $checkIfCarBooked = 1;
                           }
                          
                          
                          if($checkIfCarBooked > 0){
                              continue; 
                          }
                         
                        
                         
                         
                         
                         
                         
                          if(($c->sold_from!="0000-00-00 00:00:00")&&($c->sold_to!="0000-00-00 00:00:00")) {
                              foreach ($period_diff as $dt) {
                                  $dateDiff = $dt->format("Y-m-d H:i:s");
                                  if( ($dateDiff >= $c->sold_from) && ($dateDiff <= $c->sold_to) ){
                                      $availability = "booked";
                                  }
                              }
                          }
       
                          $isHide = 0;
                          
                          $car_hide_detail = $this->db->where('car_id', $c->car_id)->get('car_hide_history')->result();
                          
                       //   print_r($car_hide_detail);die;
                          
                          
                          $hideArr = [];
                          
                           foreach($car_hide_detail as $ch_key => $ch_value)
                           {
                              if(($ch_value->hide_from!="0000-00-00 00:00:00")&&($ch_value->hide_to!="0000-00-00 00:00:00")) 
                              {
                             
                                   foreach ($period_diff as $dt) {
                                      $dateDiff = $dt->format("Y-m-d H:i:s");
                                  
                                   }
                                  
                              }
                              
                           }
                          
                           
                           if( in_array(1, $hideArr) )
                           {
                               continue;
                           }
                          
                           $arr = [
                              "name"=>str_replace(' ', '', $c->name), 
                              "place"=>str_replace(' ', '', $c->place), 
                              "transmission"=>$c->transmission, 
                              "fuel"=>$c->fuel, 
                              "seats"=>$c->seats, 
                              "availability"=>$availability
                           ];
                          
                          if(in_array($arr, $car_array)) {
                              continue;
                          }
       
                           array_push($car_array, $arr); 
                      ?>

                <?php 
                    
                            $url = 'https://veekaycabs.com/book/checkBookCar?'.$_SERVER['QUERY_STRING'].'&vehicle_number='.$c->vehicle_number;
                            $curl = curl_init();
                            curl_setopt($curl, CURLOPT_URL, $url);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($curl, CURLOPT_POST, true);
                            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
                            $response = curl_exec($curl);
                            if(curl_errno($curl)) {
                             //  echo 'Error: ' . curl_error($curl);
                            }
                           
                          $extraCars = json_decode($response, true);
                          if(count($extraCars["data"]) > 0){
                              if($extraCars["status"] == "success"){
                                  
                                if($extraCars["data"]==1){
                                     $availability="booked";
                                     $display="display: none;";
                                     
                                }else{
                                    $display=""; 
                                }
                          
                              }
                          }
                         
                      
                        
                        //  for pick time price_increase_percentage
                        $start = new DateTime($_GET["start"]);
                        $end = new DateTime($_GET["end"]);
                        $interval = DateInterval::createFromDateString('1 hour');
                        $period = new DatePeriod($start, $interval, $end);
                        $overall_fare = 0;
                        foreach ($period as $dt) {
                            $date_day = $dt->format("l"); 
                            if($date_day=="Saturday" || $date_day=="Sunday"){
                                $overall_fare = $overall_fare+$c->weekend_price;
                            }else{
                                $overall_fare = $overall_fare+$c->price;
                            }
                            $dateDiff2 = $dt->format("Y-m-d H:i:s");
                            $percentToApply = $percentAddon = 0;
                           $percentToApply1  = $percentDecrease = 0;
                            if($dateDiff2 >= $pick_start_time && $dateDiff2 <= $pick_end_time){
                                $percentToApply = $price_increase_percentage;
                            }
                            if($percentToApply > 0){
                             $percentAddon = (($overall_fare*$percentToApply)/100);
                            }
                            
                            
                            if($dateDiff2 >= $down_start_time && $dateDiff2 <= $down_end_time){
                                $percentToApply1 = $price_decrease_percentage;
                            }
                            if($percentToApply1 > 0){
                             $percentDecrease = (($overall_fare*$percentToApply1)/100);
                            }
                            
                            
                            
                        }
               
                 
                          
                   
                   
                   ?>


                <div class="booking-car" style="<?= $display; ?>">
                    <div class="booking-show-img">
                        <div class="main-images-carss">
                            <img src="<?= base_url().$c->image; ?>" alt="Innova Crysta" class="main-cards-image">
                        </div>
                    </div>
                    <div class="booking-car-card">
                        <div class="mains-ne">
                            <h2><?= $c->name ?></h2>
                            <p class="text-dark"><?= $c->description; ?></p>
                        </div>
                        <div class="booking-car-details">
                            <span><img src="<?= base_url(); ?>assets/v2/images/Group-158863.png" alt="Automatic"
                                    class="icon" /><?= $c->transmission; ?></span>
                            <spa><img src="<?= base_url(); ?>assets/v2/images/Clip-path-group.png" alt="Petrol"
                                    class="icon" /><?= $c->fuel; ?></span>
                                <span><img src="<?= base_url(); ?>assets/v2/images/Group-158866.png" alt="7 Seats"
                                        class="icon" /><?= $c->seats; ?> Seats</span>
                        </div>

                        <div class="booking-car-pickup-info">
                            <img src="<?= base_url(); ?>assets/v2/images/Group-158878.png" alt="7 Seats" class="icon" />
                            <span id="bold">Pickup from:</span><?= $c->place ?>
                            <?php if($c->distance > 0){ ?>
                            (<span><b><?= isset($c->distance)?$c->distance: 0 ?> kms</b> away from your location</span>)
                            <?php }?>
                        </div>
                        <div class="booking-car-pricing">

                            <?php
                  
                        $total_final_price = $overall_fare;
                  
                           if($percentAddon > 0){
                                $total_final_price = ($overall_fare+$percentAddon);
                            }
                            
                             if($percentDecrease > 0){
                                $total_final_price = ($overall_fare-$percentDecrease);
                            }
                  
                  ?>
                            <span class="booking-car-price">₹ <?= number_format($total_final_price); ?></span>
                            <?php if($availability == "booked"){  ?>
                            <a data-href='<?=$url?>' class="booking-car-book-now"
                                style="color:red;background:#fff !important;">
                                Sold Out <?php //echo $c->sold_from;  ?>
                            </a>
                            <?php  }else{ ?>

                            <a data-href='<?=$url?>'
                                href="<?= base_url(); ?>Ford?car_id=<?= $c->car_id.'&&'.$_SERVER['QUERY_STRING']; ?>"
                                class="booking-car-book-now book_now_bnt ">BOOK NOW <i class="fa-solid fa-arrow-right"
                                    id="arrow_forward"></i> </a>
                            <?php }  ?>
                        </div>
                    </div>
                </div>


                <?php } } 
            
            
            foreach($car as $c) {  
                    
                $availability = "booked";  
                $card_opacity = 0.8;  
                $checkIfCarBooked = 0;  
                $car_id = $c->car_id;
                
                $diff_begin = new DateTime($getStart);
                $diff_end = new DateTime($getEnd);
                $interval = DateInterval::createFromDateString('1 hour');
                $period_diff = new DatePeriod($diff_begin, $interval, $diff_end);
                
                
                
                foreach ($period_diff as $dt) {
                    $dateDiff = $dt->format("Y-m-d H:i:s");
                    break;
                    // $wher = ["start <="=>$dateDiff, "availability >="=>$dateDiff, "car_id"=>$car_id, "payment_status"=>1];
                    // $checkSql = $this->db->get_where("booking", $wher)->num_rows();
                    // if($checkSql > 0){
                    //     $checkIfCarBooked = 1;
                    // }
                }
                
                
                
                
                $wher = [
                    //   "start <="=>$dateDiff, 
                    //   "availability >="=>$dateDiff, 
                    "availability >="=>$diff_begin->format("Y-m-d H:i:s"),
                   "car_id"=>$car_id, 
                   "payment_status"=>1
                ];
                
                
                   
                $checkSql = $this->db->get_where("booking", $wher)->num_rows();

                
                
                
                if($checkSql > 0){
                    $checkIfCarBooked = 1;
                }
               
                if($checkIfCarBooked == 0){
                    continue;
                }
                
                
                
                
                if(($c->sold_from!="0000-00-00 00:00:00")&&($c->sold_to!="0000-00-00 00:00:00")) {
                   foreach ($period_diff as $dt) {
                       $dateDiff = $dt->format("Y-m-d H:i:s");
                       if( ($dateDiff >= $c->sold_from) && ($dateDiff <= $c->sold_to) ){
                           $availability = "booked";
                       }
                   }
                }else{
                    // $availability = "available";
                }
                
       
               $isHide = 0;
               if(($c->hide_from!="0000-00-00 00:00:00")&&($c->hide_to!="0000-00-00 00:00:00")) {
                   foreach ($period_diff as $dt) {
                       $dateDiff = $dt->format("Y-m-d H:i:s");
                       if( ($dateDiff >= $c->hide_from) && ($dateDiff <= $c->hide_to) ){
                           $isHide=1;
                       }
                   }
               }
               
               if($isHide > 0){
                   continue;
               }
                
                
                $arr = ["name"=>str_replace(' ', '', $c->name), "place"=>str_replace(' ', '', $c->place), "transmission"=>$c->transmission, "fuel"=>$c->fuel, "seats"=>$c->seats];
                
                if(in_array($arr, $car_array)) { continue;  }
                
                
                             $total_final_price= $overall_fare;
                           if($percentAddon > 0){
                                $total_final_price = ($overall_fare+$percentAddon);
                            }
                            
                             if($percentDecrease > 0){
                                $total_final_price = ($overall_fare-$percentDecrease);
                            }
                  
               array_push($car_array, $arr); ?>

                <div class="booking-car">
                    <div class="booking-show-img">
                        <img src="<?= base_url().$c->image; ?>" alt="booking self car " class="main-cards-image">
                    </div>
                    <div class="booking-car-card">
                        <h2><?= $c->name ?></h2>
                        <small class="text-dark"><?= $c->description; ?></small>
                        <div class="booking-car-details">
                            <span><img src="<?= base_url(); ?>assets/v2/images/Group-158863.png" alt="Automatic"
                                    class="icon" /><?= $c->transmission; ?></span>
                            <spa><img src="<?= base_url(); ?>assets/v2/images/Clip-path-group.png" alt="Petrol"
                                    class="icon" /><?= $c->fuel; ?></span>
                                <span><img src="<?= base_url(); ?>assets/v2/images/Group-158866.png" alt="7 Seats"
                                        class="icon" /><?= $c->seats; ?> Seats</span>
                        </div>

                        <div class="booking-car-pickup-info">
                            <img src="<?= base_url(); ?>assets/v2/images/Group-158878.png" alt="7 Seats" class="icon" />
                            <span id="bold">pickup from:</span><?= $c->place ?>
                            <?php if($c->distance > 0){ ?>
                            (<span><b><?= isset($c->distance)?$c->distance: 0 ?> kms</b> away from your location</span>)
                            <?php }?>
                        </div>
                        <div class="booking-car-pricing">
                            <span class="booking-car-price">₹ <?= number_format($total_final_price); ?></span>
                            <?php if($availability == "booked"){  ?>
                            <a data-href='<?=$url?>' class="booking-car-book-now"
                                style="color:red;background:#fff !important;">
                                Sold Out <?php //echo $c->sold_from;  ?>
                            </a>
                            <?php  }else{ ?>

                            <a data-href='<?=$url?>'
                                href="<?= base_url(); ?>Ford?car_id=<?= $c->car_id.'&&'.$_SERVER['QUERY_STRING']; ?>"
                                class="booking-car-book-now book_now_bnt ">BOOK NOW <i class="fa-solid fa-arrow-right"
                                    id="arrow_forward"></i> </a>
                            <?php }  ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php } } if(empty($car)){ ?>



            <div class="col-md-12 my-5">
                <h2 class=" text-center">Sorry, but Car Not Available!</h2>
            </div>

            <?php }
        } else { ?>

            <div class="col-md-12 my-5">
                <h2 class="text-white text-center">Please Select Correct Date Range</h2>
            </div>

            <?php  }   ?>


        </div>
        </div>
        <div class="show-more-button">
            <button id="toggle-button" class="toggle-button">Show More</button>
        </div>

    </section>


    <!-- Modal to show location options -->
    <div id="location-modal" class="modal">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-headers d-flex" style="justify-content: space-between; align-items: center">
                <h2>Select Location</h2>
                <span class="close" id="close-modal">&times;</span>
            </div>
            <!-- Modal Body -->
            <ul>
                <?php $city = $this->db->order_by('city_id','asc')->get_where('city', array('status'=>1))->result();
        foreach($city as $c){ ?>
                <li data-location="<?= $c->city_id; ?>" data-id="<?= $c->city_id; ?>"><?= $c->name; ?></li>

                <?php } ?>
            </ul>
        </div>
    </div>

    <script type="text/javascript">
// ******************************************************************************************************
//                  Code for showing pop-up if booking days is less then 4 days ////////////////////
// ******************************************************************************************************
$('.book_now_bnt').on('click', function(e) {
    try {
        let startDate = formatDate($('#ssd_start').val());
        let endDate = formatDate($('#sed_end').val());
        const differenceInDays = getDaysDifference(new Date(startDate), new Date(endDate));
        let link = $(this).attr('href');
        if (differenceInDays < 4) {
            e.preventDefault();
            let message =
                "Please note that we allow 250 kms in 24 hours, if you have booked for 4 or more days then its unlimited kms. Over 250 kms, we charge 6/- per km which will be deducted from your security deposit."
            //   +" If user books car for 4 days or more than 4 days, there is no kms limit."
            //   +" For more details read T&C point 20. https://happyeasyrides.com/terms";
            swal(message, {
                    hideOnOverlayClick: false,
                    allowOutsideClick: false,
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                    allowEscapeKey: false,

                    buttons: {
                        cancel: "Cancel",
                        confirm: "Ok",
                    },
                })
                .then((value) => {
                    if (value) {
                        window.location.href = link;
                    }
                });
        }
    } catch (err) {
        console.log('error', err);
        e.preventDefault();
    }
});

function formatDate(dateString) {
    const [day, month, year, time] = dateString.split(/\s|[-:]/); // Split the string

    // Create a Date object using the components
    const inputDate = new Date(`${year}-${month}-${day}T${time}:00`);

    // Extract components
    const formattedYear = inputDate.getFullYear();
    const formattedMonth = String(inputDate.getMonth() + 1).padStart(2, '0');
    const formattedDay = String(inputDate.getDate()).padStart(2, '0');
    const formattedHour = String(inputDate.getHours()).padStart(2, '0');
    const formattedMinute = String(inputDate.getMinutes()).padStart(2, '0');

    // Format the result
    const formattedDate = `${formattedYear}-${formattedMonth}-${formattedDay}`;
    return formattedDate;
}

function getDaysDifference(date1, date2) {
    // Convert dates to milliseconds
    const time1 = date1.getTime();
    const time2 = date2.getTime();

    // Calculate the difference in milliseconds
    const timeDiff = Math.abs(time2 - time1);

    // Convert milliseconds to days
    const daysDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

    return daysDiff;
}
// ******************************************************************************************************
//                  Code for showing pop-up if booking days is less then 4 days
// ******************************************************************************************************




$('.find-cars2').on('click', function(event) {
    // Prevent the default action to check the form
    event.preventDefault();

    // Check if required fields are filled
    const citySelected = $('.city_name').val()
    const startDate = $('#ssd_start').val();
    const endDate = $('#sed_end').val();

    if (citySelected && startDate && endDate) {

        // Parse the input values into Date objects
        const startTime = new Date(startDate);
        const endTime = new Date(endDate);

        // Validate the 24-hour difference
        const timeDifference = endTime - startTime;
        const hoursDifference = timeDifference / (1000 * 60 * 60); // Convert milliseconds to hours

        if (hoursDifference < 24) {
            alert("The end time must be at least 24 hours after the start time.");
            return;
        }

        // If validation passes, submit the form
        $('#searchCarForm').submit();

    } else {
        // Optionally, you can alert the user or show a message
        alert('Please fill in all required fields.');
    }
});


//   function checkForHours(form_name){
//       const start = $("#ssd_start").val();
//       const end = $("#sed_end").val();
//       const city = $("#location-input_data").val();

//       if(city=='6'){
//           $("#"+form_name).submit();
//       }else{
//       $.ajax({
//           url: "<?= base_url("Welcome/getHrs/"); ?>",
//           data: {end: end, start: start},
//           type: "GET",
//           success: function(res){
//               if(res < 24){
//                   swal({
//                     title: "Sorry !!",
//                     text: "Please select minimum 24 hours of booking duration.",
//                     icon: "warning",
//                     timer: 3000
//                   });      
//               }else{
//                   $("#"+form_name).submit();
//               }
//           }
//       });
//       }
//   }
    </script>

    <script>
// JavaScript to handle the toggle functionality (Mobile-Only)
document
    .getElementById("toggle-filter-btn")
    .addEventListener("click", function() {
        const filterOptions = document.querySelector(".left-side-filters");
        filterOptions.classList.toggle("show"); // Toggle filter visibility (open/close)
    });

// JavaScript to close the filter container when the close button (in the header) is clicked
document
    .getElementById("close-filter")
    ?.addEventListener("click", function() {
        const filterContainer = document.querySelector(".left-side-filters");
        filterContainer.classList.remove("show");
    });

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
        $('.latitude').val(position.coords.latitude);
        $('.longitude').val(position.coords.longitude);
    });
}
    </script>