<?php
/**
 * @var \App\View\AppView $this
 */
?>

<?php if($loggedUser['role'] == 'Admin') : ?>
<table>
    <tr>
        <td>
            <div id="sales_per_product_this_month_chart_div"></div>
        </td>
        <td>
            <div id="new_customers_per_month"></div>
        </td>
    </tr>
</table>
<div id="sales_per_month_chart_div"></div>
<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

    // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawSalesPerProductPerMonthPie);
    google.charts.setOnLoadCallback(drawNewCustomersPerMonthBar);
    google.charts.setOnLoadCallback(drawSalesPerMonthArea);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawSalesPerProductPerMonthPie() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Product Name');
        data.addColumn('number', 'Items Sold');
        data.addRows([
            ['GE Appliance Light Bulb 40w A15', 110],
            ['T-fal FR3900 Triple Basket Deep Fryer', 60],
            ['25475A Breakfast Sandwich Maker', 50],
            ['BFP-328C 11" Nonstick Aluminum', 100],
            ['RainLeaf Microfiber Towel', 75]
        ]);

        // Set chart options
        var options = {'title':'Sales Per Product This Month',
            'width':400,
            'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('sales_per_product_this_month_chart_div'));
        chart.draw(data, options);
    }

    function drawSalesPerMonthArea() {
        var data = google.visualization.arrayToDataTable([
            ['Month', '2017', '2018'],
            ['January',  1000,  2000],
            ['February',  1500,  2500],
            ['March',  1600,  2600],
            ['April',  1900,  2900],
            ['May',  1400,  2400],
            ['June',  1500,  2500],
            ['July',  1600,  2600],
            ['August',  1900,  2900]
        ]);

        var options = {
            title: 'Sales Per Month',
            hAxis: {title: 'Months',  titleTextStyle: {color: '#333'}},
            vAxis: {title: 'Sales', minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('sales_per_month_chart_div'));
        chart.draw(data, options);
    }

    function drawNewCustomersPerMonthBar() {
        var data = google.visualization.arrayToDataTable([
            ["Months", "New Customers", { role: 'tooltip' }, { role: "style"} ],
            ["Jan", 9, "January", ""],
            ["Feb", 10,  "February", ""],
            ["Mar", 19, "March", ""],
            ["Apr", 15, "April", ""],
            ['May',  16,  "May", ""],
            ['Jun',  18,  "June", ""],
            ['Jul',  15,  "July", ""],
            ['Aug',  20,  "August", ""]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" },
            2, 3]);

        var options = {
            title: "New Customer Each Month",
            width: 600,
            height: 400,
            bar: {groupWidth: "95%"},
            hAxis: {title: 'New Customers'},
            vAxis: {title: 'Months', minValue: 0},
            legend: { position: "none" },
        };
        var chart = new google.visualization.BarChart(document.getElementById("new_customers_per_month"));
        chart.draw(view, options);

    }
</script>
<?php endif; ?>
