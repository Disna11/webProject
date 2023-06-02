<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
/* CSS for the table */
table {
   border-collapse: collapse;  /* Collapse the borders between cells */
  border-spacing: 0; /* Set the spacing between cells to 0 */
  width: 100%;  /* Set the table width to 100% of its container */
  border: 3px solid #ddd;  /* Set a border of 3 pixels with a color of #ddd */
}

/* CSS for the table header */
th {
 text-align: left; /* Align the text to the left */
 padding: 8px;   /* Add padding around the header cells */
 color: blue;  /* Set the text color to blue */
 background-color: lightblue;  /* Set the background color to lightblue */
 border-bottom: 3px solid #0c0c0c;   /* Add a bottom border of 3 pixels with a color of #0c0c0c */
 border-right: 3px solid #0b0a0a;/* Add a right border of 3 pixels with a color of #0b0a0a */
 border-left: 3px solid #0b0a0a; /* Add a left border of 3 pixels with a color of #0b0a0a */
 border-top: 3px solid #0b0a0a; /* Add a top border of 3 pixels with a color of #0b0a0a */
}

/* CSS for the table cells */
td {
   text-align: left;  /* Align the text to the left */
   padding: 8px; /* Add padding around the cells */
   color: black;  /* Set the text color to black */
   background-color: lightgoldenrodyellow;  /* Set the background color to lightgoldenrodyellow */
   border-bottom: 3px solid #0c0c0c;  /* Add a bottom border of 3 pixels with a color of #0c0c0c */
   border-right: 3px solid #0b0a0a;  /* Add a right border of 3 pixels with a color of #0b0a0a */
   border-left: 3px solid #0b0a0a;  /* Add a left border of 3 pixels with a color of #0b0a0a */
}

/* CSS for even rows */
tr:nth-child(even) {
  /* Set the background color to #f2f2f2 */
  background-color: #f2f2f2;
}

</style>
</head>
<body>
<?php
// Check if any courses were selected
if (isset($_POST['checkedCourses']) && !empty($_POST['checkedCourses'])) {
    // Database connection parameters
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'internet_programming';

    // Establish a database connection
    $connection = mysqli_connect($host, $username, $password, $database);

    // Check if the connection was successful
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the selected course IDs
    $selectedCourses = $_POST['checkedCourses'];

    // Fetch course details for selected courses
    $query = "SELECT * FROM coursedetails WHERE id IN (" . implode(',', $selectedCourses) . ") ORDER BY courseName ASC";
    $result = mysqli_query($connection, $query);

    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Start creating the HTML table for the report
        echo '<table>';
        echo '<tr>';
        echo '<th>Course Name</th>';  // course nmae as heading
        echo '<th>Overview</th>';  // overview as heading
        echo '<th>Highlights</th>';  // highlights as heading
        echo '<th>Course Details</th>';  // course details as heading
        echo '<th>module1</th>';  // module1 as heading
        echo '<th>module1Credit</th>';   // module1 credit as heading
        echo '<th>module2</th>';  // module2 as heading
        echo '<th>module2Credit</th>';  // module2 credit as heading
        echo '<th>module3</th>';  // module3 as heading
        echo '<th>module3Credit</th>';  // module3 credit as heading
        echo '<th>Level</th>';  //level as heading
        echo '<th>Entry Requirement</th>';  // entry requirement as heading
        echo '<th>Fees(GBP)</th>';  // feesGBP as heading
        echo '<th>International Fees(GBP)</th>';  // international feesGBP as heading
        echo '<th>Fees(EUR)</th>';  // feesEUR as heading
        echo '<th>International Fees(EUR)</th>';// international feesEUR as heading
        echo '<th>Fees(USD)</th>';  // feesUSD as heading
        echo '<th>International Fees(USD)</th>'; // international feesUSD as heading
        echo '</tr>';

        // Loop through the rows and display data in table cells
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['courseName'] . '</td>';  // get coursename value and display in coursename column
            echo '<td>' . $row['overview'] . '</td>';  // get overview value and display in overview column
            echo '<td>' . $row['highlights'] . '</td>';  // get highlights value and display in highlights column
            echo '<td>' . $row['courseDetails'] . '</td>';   // get course details value and display in coursedetails column
            echo '<td>' . $row['module1'] . '</td>';  // get module1 value and display in module1 column
            echo '<td>' . $row['module1Credit'] . '</td>';  // get module1 credit  value and display in module1 credit column
            echo '<td>' . $row['module2'] . '</td>';  // get module2 value and display in module2 column
            echo '<td>' . $row['module2Credit'] . '</td>';   // get module2 credit  value and display in module1 credit column
            echo '<td>' . $row['module3'] . '</td>';   // get module3 value and display in module2 column
            echo '<td>' . $row['module3Credit'] . '</td>';  // get module3 credit  value and display in module1 credit column
            echo '<td>' . $row['level'] . '</td>';  // get level value and display in level column
            echo '<td>' . $row['entryRequirement'] . '</td>';  // get entry requirement value and display in entry requirement column
            echo '<td>' . $row['feesGBP'] . '</td>';  // get feesGBP value and display in feesGBP column
            echo '<td>' . $row['intfeesGBP'] . '</td>';  // get intfeesGBP value and display in international feesGBP column
            echo '<td>' . $row['feesEUR'] . '</td>';  // get feesGEUR value and display in feesEUR column
            echo '<td>' . $row['intfeesEUR'] . '</td>'; // get intfeesEUR value and display in international feesEUR column
            echo '<td>' . $row['feesUSD'] . '</td>';  // get feesUSD value and display in feesUSD column
            echo '<td>' . $row['intfeesUSD'] . '</td>';  // get intfeesUSD value and display in international feesGBP column
            echo '</tr>';
        }

        echo '</table>';

        // Generate pie chart and bar chart after printing the table
        mysqli_data_seek($result, 0); // Reset the result pointer to the beginning

        while ($row = mysqli_fetch_assoc($result)) {
            // Generate unique identifier for the canvas element
            $chartCanvasId = 'pieChart-' . $row['id'];

            // Generate pie chart using Chart.js
            echo '<canvas id="' . $chartCanvasId . '"></canvas>'; // Display a canvas element with the specified ID
            echo '<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>'; // Include the Chart.js library
            echo '<script>'; // Start of JavaScript code
            echo 'var ctx = document.getElementById("' . $chartCanvasId . '").getContext("2d");'; // Get the canvas element by ID and obtain the 2D rendering context
            echo 'var data = {'; // Define the data object for the chart
            echo 'labels: ["' . $row['module1'] . '", "' . $row['module2'] . '", "' . $row['module3'] . '"],'; // Set the labels for the chart
            echo 'datasets: [{' ; // Define the datasets array
            echo 'data: [' . $row['module1Credit'] . ', ' . $row['module2Credit'] . ', ' . $row['module3Credit'] . '],'; // Set the data values for the chart
            echo 'backgroundColor: ["' . generateRandomColor() . '", "' . generateRandomColor() . '", "' . generateRandomColor() . '"],'; // Set the background color for each data point
            echo 'borderWidth: 1'; // Set the border width for the chart
            echo '}]'; // End of datasets array
            echo '};'; // End of data object
            echo 'var pieChart = new Chart(ctx, {'; // Create a new Chart object with the canvas context and the chart configuration
            echo 'type: "pie",'; // Set the chart type to "pie"
            echo 'data: data'; // Set the chart data
            echo '});'; // End of chart configuration
            echo '</script>'; // End of JavaScript code
        }

        // Generate bar chart for multiple courses if more than one course is selected
        if (count($selectedCourses) > 1) {
            // Prepare data for bar chart
            $barChartLabels = array();  // Labels for x-axis
            $barChartData = array();    // Data values for bars

            // Fetch course names and module credits for selected courses IN ASCENDING ORDER
            $query = "SELECT courseName, module1Credit, module2Credit, module3Credit FROM coursedetails WHERE id IN (" . implode(',', $selectedCourses) . ") ORDER BY courseName ASC";
            $result = mysqli_query($connection, $query);

            // Loop through the rows and collect data for bar chart
            while ($row = mysqli_fetch_assoc($result)) {
                $courseName = $row['courseName'];
                $module1Credit = $row['module1Credit'];
                $module2Credit = $row['module2Credit'];
                $module3Credit = $row['module3Credit'];

                // Add course name to bar chart labels
                $barChartLabels[] = $courseName;

                // Add module credits to bar chart data
                $barChartData[] = array(
                    'label' => 'Module 1', // Define the label for Module 1
                    'credit' => $module1Credit // Assign the credit value for Module 1
                );
                
                $barChartData[] = array(
                    'label' => 'Module 2', // Define the label for Module 2
                    'credit' => $module2Credit // Assign the credit value for Module 2
                );
                
                $barChartData[] = array(
                    'label' => 'Module 3', // Define the label for Module 3
                    'credit' => $module3Credit // Assign the credit value for Module 3
                );
                            }

            // Display bar chart
            echo '<canvas id="barChart"></canvas>'; // Display a canvas element with the specified ID
            echo '<script>'; // Start of JavaScript code
            echo 'var ctx = document.getElementById("barChart").getContext("2d");'; // Get the canvas element by ID and obtain the 2D rendering context
            echo 'var data = {'; // Define the data object for the bar chart
            echo 'labels: ' . json_encode($barChartLabels) . ','; // Set the labels for the bar chart using JSON encoding
            echo 'datasets: ['; // Start of datasets array

            // Generate datasets for bar chart
            foreach ($barChartData as $data) {
                echo '{'; // Start of dataset object
                echo 'label: "' . $data['label'] . '",'; // Set the label for the dataset
                echo 'data: [' . $data['credit'] . '],'; // Set the data values for the dataset
                echo 'backgroundColor: "' . generateRandomColor() . '",'; // Set the background color for the dataset
                echo 'borderWidth: 2'; // Set the border width for the dataset
                echo '},'; // End of dataset object
            }

            echo ']'; // End of datasets array
            echo '};'; // End of data object
            echo 'var barChart = new Chart(ctx, {'; // Create a new Chart object with the canvas context and the chart configuration
            echo 'type: "bar",'; // Set the chart type to "bar"
            echo 'data: data,'; // Set the chart data
            echo 'options: {'; // Start of chart options
            echo 'scales: {'; // Start of scales configuration
            echo 'y: {'; // Start of y-axis configuration
            echo 'beginAtZero: true'; // Set the y-axis to begin at zero
            echo '}'; // End of y-axis configuration
            echo '}'; // End of scales configuration
            echo '}'; // End of chart options
            echo '});'; // End of chart configuration
            echo '</script>';
        }

    } else {
        echo 'No data found.';
    }

    // Close the database connection
    mysqli_close($connection);
} else {
    echo 'No courses selected.';
}

// Function to generate random hexadecimal color code
function generateRandomColor()
{ 
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}
?>
</body>
</html>
