<?php
	public function __construct(){
        parent::__construct();
        BackendMenu::setContext('Tenten.Dealers', 'main-menu-dealers');
        if(!empty($_FILES)){
			$nowtime = time();
			$src = $_FILES['excel']['tmp_name'];
			$des = "storage/app/media/dealers/".$_FILES['excel']['name'];
			move_uploaded_file($src,$des);
			$file = "media/dealers/".$_FILES['excel']['name'];
			$this->loadDealerFile($file);
			exit();
        }
    }
    
	public function loadDealerFile($file){
		
		$contents = Storage::get($file);
		$dealers = explode("\n",$contents);
		
		foreach ($dealers as $key => $value) {
			$dealer = explode("\t",$value);
			
			if($dealer[0]=="country")
				continue;
			
			if(count($dealer) > 3){
				$finddealer = Dealers::where("address", str_replace('"', "", $dealer[2]))->where("active",1)->first();
			} else {
				continue;
			}
			
			if(empty($finddealer))
			{
				
				if(!empty($dealer[5]))
					$zipstr = ",".$dealer[5];
				else
					$zipstr = "";

				if(!empty($dealer[8])){
					
					$coordinate = explode(",",$dealer[8]);
					
					if(count($coordinate) == 2) {
						$lat = trim($coordinate[0]);
						$lon = trim($coordinate[1]);
					} else {
						$url="https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($dealer[2].$zipstr)."&key=".$GOOGLEAPIKEY;
			
						$geo = $this->curl_api($url);
						$geo = json_decode($geo);
			
						if(!empty($geo->results[0]->geometry->location->lat))
							$lat = $geo->results[0]->geometry->location->lat;
						else
							$lat = 0;
						
						if(!empty($geo->results[0]->geometry->location->lng))
							$lon = $geo->results[0]->geometry->location->lng;
						else
							$lon = 0;
					}
	
				} else {
					$url="https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($dealer[2].$zipstr)."&key=".$GOOGLEAPIKEY;
		
					$geo = $this->curl_api($url);
					$geo = json_decode($geo);
		
					if(!empty($geo->results[0]->geometry->location->lat))
						$lat = $geo->results[0]->geometry->location->lat;
					else
						$lat = 0;
					
					if(!empty($geo->results[0]->geometry->location->lng))
						$lon = $geo->results[0]->geometry->location->lng;
					else
						$lon = 0;
				}

		    	$tdealer = new Dealers();
		    	$tdealer->name = str_replace('"', "", $dealer[1]);
		    	$tdealer->address = str_replace('"', "", $dealer[2]);
		    	if(!empty($dealer[3]))
		    	$tdealer->city = $dealer[3];
		    	if(!empty($dealer[4]))
		    	$tdealer->zip_code = $dealer[4];
		    	if(!empty($dealer[5]))
		    	$tdealer->phone = $dealer[5];
		    	if(!empty($dealer[6]))
		    	$tdealer->website = $dealer[6];
		    	$tdealer->latitude = $lat;
		    	$tdealer->longitude = $lon;
		    	
		    	if(!empty($dealer[7]))
		    	$tdealer->email = $dealer[7]; 
		    	if(!empty($dealer[0]))
		    	$tdealer->country = $dealer[0];
				
		    	$tdealer->save();

			} else {
				
				if(!empty($dealer[8])){
					$coordinate = explode(",",$dealer[8]);
					if(count($coordinate) == 2) {
						$finddealer->latitude = trim($coordinate[0]);
						$finddealer->longitude = trim($coordinate[1]);
					}
				}
				
				
		    	if(!empty($dealer[3]))
		    	$finddealer->city = $dealer[3];
		    	if(!empty($dealer[4]))
		    	$finddealer->zip_code = $dealer[4];
		    	if(!empty($dealer[5]))
		    	$finddealer->phone = $dealer[5];
		    	if(!empty($dealer[6]))
		    	$finddealer->website = $dealer[6];    	
		    	
		    	if(!empty($dealer[7]))
		    	$finddealer->email = $dealer[7];  
		    	if(!empty($dealer[0]))
		    	$finddealer->country = $dealer[0];

		    	$finddealer->save();
			}
		}
		
		return true;	
		
	}