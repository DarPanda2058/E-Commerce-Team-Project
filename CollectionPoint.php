<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection Point</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/CollectionPoint.css">
</head>
<body>
    <?php
    include('connect.php'); 
    include('nav.php'); 
    
    ?>

    <div class="title-row">
        <div class="title-shopping">
            <p>1. Shopping Cart </p>
        </div>
        <div class="title-collection" id="active">
            <p>2. Collection Point</p>
        </div>
        <div class="title-payment">
            <p>3. Payment Option</p>
        </div>
    </div>
    <form action="CollectionPointPHP.php" method="post">
        <table>
            <tr class="header">
                <th>Choose Collection Point</th>
                <td id="col-width">Date</td>
                <td id="col-width">Time</td>
            </tr>
            <tr class="collection-row">
                <th class="collection-point"><p>West Yorkshire</p></th>
                <td class="date-container" id="col-width">
                    <select name="date" id="date-select" required >
                        <?php
                        // Define the days of the week and the allowed days for collection
                        $allowed_days = ['Wednesday', 'Thursday', 'Friday'];

                        // Calculate the minimum date (24 hours from now)
                        $min_date = new DateTime('+24 hours');
                        // $min_date = new DateTime('2024-04-10 13:30:00');

                        // Loop to find the next 14 days that are allowed for collection
                        for ($i = 0; $i < 7; $i++) {
                            $current_date = clone $min_date;
                            $current_date->modify("+$i day");
                            $day_of_week = $current_date->format('l');

                            if (in_array($day_of_week, $allowed_days)) {
                                $day = $current_date->format('j');
                                $month = $current_date->format('F');
                                $year = $current_date->format('Y');
                                $formatted_date = $current_date->format('Y-m-d');
                                echo "<option value=\"$formatted_date\" data-hour=\"{$min_date->format('H')}\">{$day} {$month}, {$year}, {$day_of_week}</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
                <td class="time-container" id="col-width">
                    <select name="time" id="time-select" required>
                        <!-- Time options will be dynamically inserted here -->
                    </select>
                </td>
            </tr>
        </table>
        <div class="total-container">
            <div class="sub-total">
                <p>Sub-total</p>
                <p>&pound; <?php echo $_SESSION['totalPrice'] ?></p>
            </div>
            <div class="shipping">
                <p>Shipping</p>
                <p>Free</p>
            </div>
            <div class="total">
                <p>TOTAL</p>
                <p>&pound;<?php echo $_SESSION['totalPrice'] ?></p>
            </div>
            <button type="submit" name="collection_slot">Continue</button>
            <button><a href="main.php">Cancel</a></button>
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dateSelect = document.getElementById('date-select');
            const timeSelect = document.getElementById('time-select');
            const timeSlots = {
                '10-13': '10:00 - 13:00',
                '13-16': '13:00 - 16:00',
                '16-19': '16:00 - 19:00'
            };

            function updateTimeSlots() {
                const selectedDate = new Date(dateSelect.value);
                const now = new Date();
                const hoursPassed = Math.floor((selectedDate - now) / (1000 * 60 * 60));
                
                // Clear the current options
                timeSelect.innerHTML = '';

                // Add new options
                for (const [key, value] of Object.entries(timeSlots)) {
                    const slotStart = parseInt(key.split('-')[0]);
                    if (hoursPassed > 24 || slotStart > now.getHours()) {
                        const option = document.createElement('option');
                        option.value = key;
                        option.textContent = value;
                        timeSelect.appendChild(option);
                    }
                }
            }

            dateSelect.addEventListener('change', updateTimeSlots);
            updateTimeSlots(); // Initial call to set time slots for the default selected date
        });
    </script>
</body>
</html>