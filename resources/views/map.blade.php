<!-- <div style="width: 500px; height: 500px;">
	{!! Mapper::render() !!}
</div> -->
<!DOCTYPE html>
<html>
 	<head>
  		<title>Google Maps</title>
 	</head>
 	<body>
		<x-maps-leaflet
			:centerPoint="['lat' => 12.3680872, 'long' => -1.530806]"
			:zooLevel="12"
			:markers="[['lat' => 12.3680872, 'long' => -1.530806]]">

		</x-maps-leaflet>
	</body>
</html>