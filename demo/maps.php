<html>
<head>
  <script type='text/javascript' src='https://www.google.com/jsapi'></script>
  <script type='text/javascript'>
   google.load('visualization', '1', {'packages': ['geomap']});
   google.setOnLoadCallback(drawMap);

    function drawMap() {
      var data = google.visualization.arrayToDataTable([
        ['State', 'Popularity'],
        ['New York', 200],
        ['Boston', 300],
        ['Miami', 400],
        ['Chicago', 500],
        ['Los Angeles', 600],
        ['Houston', 700]
      ]);

      var options = {};
      options['region'] = '005';
      options['colors'] = [0xFF8747, 0xFFB581, 0xc06000]; //orange colors
      options['dataMode'] = 'markers';

      var container = document.getElementById('map_canvas');
      var geomap = new google.visualization.GeoMap(container);
      geomap.draw(data, options);
    };

  </script>
</head>

<body>
    <div id='map_canvas'></div>
</body>

</html>