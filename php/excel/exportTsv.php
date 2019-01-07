<?php
    public function onExportTsv()
    {
        $checkedIds = post('checked');
        foreach ($checkedIds as $objectId) {
	        $dealers[] = DB::table('DBNAME')
	        				->where('id', $objectId)
	        				->select([
		        				'country',
		        				'name',
		        				'address',
		        				'city',
		        				'zip_code',
		        				'phone',
		        				'website',
		        				'fax',
		        				'latitude',
		        				'longitude'
	        				])
	        				->first();

	        foreach ($dealers as $dealer){		        
		        $data['country'] = $dealer->country;
		        $data['dealer'] = $dealer->name;
		        $data['address'] = $dealer->address;
		        $data['city'] = $dealer->city;
		        $data['zip_code'] = $dealer->zip_code;
		        $data['phone'] = $dealer->phone;
		        $data['website'] = $dealer->website;
		        $data['email'] = $dealer->fax;		        
		        $data['coordinate'] = ($dealer->latitude).", ".($dealer->longitude);
	        }
	        $alldata[] = $data;
        }
		$head['country'] = 'country';
		$head['dealers'] = 'dealers';
		$head['address'] = 'address';
		$head['city'] = 'city';
		$head['zip_code'] = 'zip_code';
		$head['phone'] = 'phone';
		$head['website'] = 'website';
		$head['email'] = 'email';
		$head['coordinate'] = 'coordinate';
		header('Content-type: text/tsv');
		header('Pragma: no-cache');
		header('Expires: 0');
        $file = fopen('storage/app/media/dealers/export.tsv', 'w');
		$delimiter="\t";
		fputcsv($file, $head, $delimiter);
        foreach ($alldata as $line) { 
	        fputcsv($file, $line, $delimiter); 
        }
		fclose($file);
    }
?>