<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather chart</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- GSAP for Animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
    <!-- Particles.js for Background Effects -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <style>
        
    </style>

<link href="stylee.css" rel="stylesheet">


</head>
<body class="bg-gray-900 text-white p-6">


<nav class="shadow-md p-4 flex justify-between items-center backdrop-blur-md rounded-x10 adow-2xl">
        <!-- Logo -->
        <h1 class="text-2xl font-bold text-white backdrop-blur-md rounded-x10 adow-2xl" >🌦️ AuraCast</h1>

        <!-- Navbar Links -->
        <div class="space-x-1">
            <a href="index.php" class="mt-4 px-6 py-3 text-lg font-semibold text-white 
    bg-gradient-to-r from-blue-400 to-red-400  
    rounded-full shadow-lg transform transition-all 
    hover:scale-105 hover:shadow-xl 
    active:scale-95">🏠 Home</a>
            <a href="compare.php" class="mt-4 px-6 py-3 text-lg font-semibold text-white 
    bg-gradient-to-r from-blue-400 to-red-400 
    rounded-full shadow-lg transform transition-all 
    hover:scale-105 hover:shadow-xl 
    active:scale-95">🌍 View Cities</a>
            <a href="chart.php" class="mt-4 px-6 py-3 text-lg font-semibold text-white 
    bg-gradient-to-r from-blue-400 to-red-400 
    rounded-full shadow-lg transform transition-all 
    hover:scale-105 hover:shadow-xl 
    active:scale-95">📊 View Chart</a>
            <a href="about.php" class="mt-4 px-6 py-3 text-lg font-semibold text-white 
    bg-gradient-to-r from-blue-400 to-red-400 
    rounded-full shadow-lg transform transition-all 
    hover:scale-105 hover:shadow-xl 
    active:scale-95">ℹ️ About Us</a>
        </div>

        <!-- Sidebar Toggle Button -->
        <button onclick="toggleSidebar()" 
            class="px-4 py-2 bg-gradient-to-r from-blue-400 to-red-400 
    rounded-full shadow-lg transform transition-all 
    hover:scale-105 hover:shadow-xl 
    active:scale-95">
            📌 Saved Locations
        </button>

        <button id="themeToggle" 
    class="fixed top-20 right-4 px-6 py-3 text-lg font-semibold text-white 
    bg-gradient-to-r from-gray-800 to-black 
    rounded-full shadow-lg transform transition-all 
    hover:scale-105 hover:shadow-xl 
    active:scale-95">
    🌙 Dark Mode
</button>
    </nav>
    <!-- Side Panel -->
    <div id="sidebar" 
        class="fixed top-0 left-0 w-72 h-full bg-gray-800 shadow-lg transform -translate-x-full transition-transform duration-300">
        
        <!-- Header -->
        <div class="flex justify-between items-center px-6 py-4 bg-gray-700">
            <h2 class="text-xl font-bold">📍 Saved Cities</h2>
            <button onclick="toggleSidebar()" class="text-white text-2xl">✖</button>
        </div>

        <!-- City List -->
        <ul id="cityList" class="p-4 space-y-3">
            <!-- Cities will be added here dynamically -->
        </ul>

        <!-- Add City Input -->
        <div class="p-4 border-t border-gray-600">
            <input type="text" id="cityInput" placeholder="Enter City Name"
                class="w-full px-3 py-2 rounded bg-gray-700 text-white outline-none">
            <button onclick="addCity()" 
                class="mt-2 w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">
                ➕ Add City
            </button>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            let sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        function addCity() {
            let cityInput = document.getElementById("cityInput");
            let cityName = cityInput.value.trim();
            if (cityName === "") return;

            let cityList = document.getElementById("cityList");
            let li = document.createElement("li");
            li.classList = "flex justify-between items-center bg-gray-700 p-3 rounded shadow";
            li.innerHTML = `
                <span>${cityName}</span>
                <button onclick="this.parentElement.remove()" class="text-red-400">❌</button>`;
            cityList.appendChild(li);
            cityInput.value = "";
        }
    </script>

<div id="particles-js">
<img src="graphics\cloud.png" class="cloud">
<img src="graphics\storm.png" class="storm">
<img src="graphics\thunder.png" class="thunder">
<img src="graphics\air.png" class="air">
<img src="graphics\storms.png" class="storms">
<img src="graphics\hot.png" class="hot">
<img src="graphics\sun.png" class="sun">
<img src="graphics\crescent-moon.png" class="cmoon">
<img src="graphics\umbrella.png" class="umbrella">
</div>
    <div class="flex justify-center items-center mt-12">
        <h2 class="text-5xl font-bold text-center mb-4">Weather Data Comparison</h2>
    </div>

    <div class="max-w-5xl mx-auto mt-12 bg-white/10 backdrop-blur-md rounded-xl shadow-2xl p-8 hover-effect">
        <canvas id="weatherChart"></canvas>

    </div>

  
   
    </div>

    <?php
        $result = $conn->query("SELECT city, temperature, humidity, wind_speed FROM weather_records ORDER BY recorded_at DESC LIMIT 5");
        $cities = [];
        $temperatures = [];
        $humidity = [];
        $windSpeeds = [];

        while ($row = $result->fetch_assoc()) {
            $cities[] = $row['city'];
            $temperatures[] = $row['temperature'];
            $humidity[] = $row['humidity'];
            $windSpeeds[] = $row['wind_speed'];
        }
    ?>
    

    <script>
        let ctx = document.getElementById('weatherChart').getContext('2d');
        let weatherChart = new Chart(ctx, {
            type: 'bar',
            data: {
            labels: <?php echo json_encode($cities); ?>,
            datasets: [
                {
                label: 'Temperature (°C)',
                data: <?php echo json_encode($temperatures); ?>,
                backgroundColor: 'rgba(255, 3, 57, 0.73)',
                borderColor: 'rgba(177, 0, 0, 0.67)',
                borderWidth: 3,
                borderSkipped: false,
                barThickness: 30,
                hoverBackgroundColor: 'rgba(255, 3, 57, 0.9)',
                hoverBorderColor: 'rgba(177, 0, 0, 1)',
                hoverBorderWidth: 4
                },
                {
                label: 'Humidity (%)',
                data: <?php echo json_encode($humidity); ?>,
                backgroundColor: 'rgba(255, 251, 37, 0.6)',
                borderColor: 'rgba(117, 113, 0, 0.15)',
                borderWidth: 3,
                borderSkipped: false,
                barThickness: 30,
                hoverBackgroundColor: 'rgba(255, 251, 37, 0.8)',
                hoverBorderColor: 'rgba(117, 113, 0, 0.3)',
                hoverBorderWidth: 4
                },
                {
                label: 'Wind Speed (m/s)',
                data: <?php echo json_encode($windSpeeds); ?>,
                backgroundColor: 'rgba(1, 208, 255, 0.88)',
                borderColor: 'rgb(0, 157, 209)',
                borderWidth: 3,
                borderSkipped: false,
                barThickness: 30,
                hoverBackgroundColor: 'rgba(1, 208, 255, 1)',
                hoverBorderColor: 'rgb(0, 157, 209, 1)',
                hoverBorderWidth: 4
                }
            ]
            },
            options: {
            responsive: true,
            scales: {
                y: {
                beginAtZero: true
                }
            },
            plugins: {
                legend: {
                labels: {
                    font: {
                    size: 14,
                    weight: 'bold'
                    },
                    color: 'white'
                }
                }
            }
            }
        });


        const toggleButton = document.getElementById("themeToggle");
    const body = document.body;

    function setTheme(mode) {
        if (mode === "dark") {
            body.classList.add("dark-mode");
            body.classList.remove("light-mode");
            toggleButton.innerHTML = "☀️ Light Mode";
            toggleButton.classList.add("bg-gradient-to-r", "from-yellow-400", "to-orange-500");
            toggleButton.classList.remove("bg-gradient-to-r", "from-gray-800", "to-black");
            localStorage.setItem("theme", "dark");
        } else {
            body.classList.add("light-mode");
            body.classList.remove("dark-mode");
            toggleButton.innerHTML = "🌙 Dark Mode";
            toggleButton.classList.add("bg-gradient-to-r", "from-gray-800", "to-black");
            toggleButton.classList.remove("bg-gradient-to-r", "from-yellow-400", "to-orange-500");
            localStorage.setItem("theme", "light");
        }
    }

    toggleButton.addEventListener("click", () => {
        const currentTheme = localStorage.getItem("theme") || "light";
        setTheme(currentTheme === "light" ? "dark" : "light");
    });

    // Load Theme from Local Storage on Page Load
    setTheme(localStorage.getItem("theme") || "light");

    </script>
</body>
</html>
