<script>
	
	
	var textLength = $('#record_in_db').html().length;
        if (textLength <= 10) {
            // Do noting 
        } else if (textLength > 10) {
            $('.font_dinamic>h3').css('font-size', '20px');
        }
	
	//-------------
	//- PIE CHART -
	//-------------
	// Get context with jQuery - using jQuery's .get() method.
	var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
	    
	var data = {
		labels: [
			<?php 
				$label = "";
				foreach($record_in_table as $record_in_table_rows){
					
					$value = $record_in_table_rows["TABLE_NAME"];
					$value = str_replace($this->data['tables']['prefix'],"",$value);
					$value = str_replace("_"," ",$value);
					
					$label = $label.'"'.$value.'",';
				}
			
			$label = substr($label, 0, -1);
			echo $label;
			?>
		],
		datasets: [
			{
				data: [
					<?php 
					$data = "";
						foreach($record_in_table as $record_in_table_rows){
							$data = $data.'"'.$record_in_table_rows["TABLE_ROWS"].'",';
						}

					$data = substr($data, 0, -1);
					echo $data;
					?>
				],
				backgroundColor: [
					<?php 
					
					

					function random_color($key){
						$c = '';
						while(strlen($c)<6){
							$c .= sprintf("%02X", $key);
						}
						return $c;
					}


					
					$data = "";
					$value=15;
					foreach($record_in_table as $record_in_table_rows){
						$data = $data.'"#'.substr(random_color($value), 0, 6).'",';
						$value=$value*3;
					}

					$data = substr($data, 0, -1);
					echo $data;
					?>
				]
			}]
	};
	
	// For a pie chart
	var myPieChart = new Chart(pieChartCanvas,{
		type: 'pie',
		data: data,
		options: {
			responsive: true,
    			maintainAspectRatio: false,
			legend: {
				position:"bottom",
				display: true
        	}
		}
	});



</script>