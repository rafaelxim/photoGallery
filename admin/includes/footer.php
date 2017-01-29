  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

	<!-- Editor tynimce -->
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>

  <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Quantity'],         
          ['Comments', <?=Comment::count_all(); ?>],
          ['Users',      <?=User::count_all(); ?>],
          ['Photos',  <?=Photo::count_all(); ?>]  
          
          
        ]);

        var options = {
          legend: "none",
          pieSliceText: "label",
          backgroundColor: "transparent"
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

</body>

</html>
