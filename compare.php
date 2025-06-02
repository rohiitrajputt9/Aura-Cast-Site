<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>compare site</title>
    <!-- Tailwind CSS for Responsive Design -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- GSAP for Animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
    <!-- Particles.js for Background Effects -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <style> 
    </style>

<link href="stylee.css" rel="stylesheet">



</head>
<body class="text-white bg-gray-900 p-6">


 <!-- Navbar -->
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
        <div class="flex justify-between items-center px-6 py-4 bg-gray-700 backdrop-blur-md rounded-xl shadow-2xl">
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
                class="mt-2 w-full bg-red-500 text-white py-2 rounded hover:bg-green-600">
                ➕ Add City
            </button>
        </div>
    </div>


    
  <!-- Particles.js Background -->
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
    <h2 class="text-4xl font-bold text-center mb-6">Weather Comparison of Cities</h2>

    <div class="overflow-x-auto">
        <div class="flex space-x-6">
            <?php
            $result = $conn->query("SELECT * FROM weather_records GROUP BY city ORDER BY recorded_at DESC");
            while ($row = $result->fetch_assoc()) {
                echo "
                <div class='mt-4 px-6 py-3 text-lg font-semibold text-white 
    bg-gradient-to-r from-orange-400 to-red-500 
    rounded-half shadow-lg transform transition-all 
    hover:scale-105 hover:shadow-xl 
    active:scale-95'>
                    <h3 class='text-xl font-bold text-center mb-2'>{$row['city']}</h3>
                    <p><strong>Temperature:</strong> {$row['temperature']}°C</p>
                    <p><strong>Humidity:</strong> {$row['humidity']}%</p>
                    <p><strong>Wind Speed:</strong> {$row['wind_speed']} m/s</p>
                    <p class='text-sm text-gray-600'>Last updated: {$row['recorded_at']}</p>
                </div>";
            }
            ?>
        </div>
    </div>

    <div class="text-center mt-6">
        <button onclick="window.location.href='index.php' " 
        class="mt-4 px-6 py-3 text-lg font-semibold text-white 
    bg-gradient-to-r from-orange-400 to-red-500 
    rounded-full shadow-lg transform transition-all 
    hover:scale-105 hover:shadow-xl 
    active:scale-95">Back to Home</button>

    <button onclick="window.location.href='chart.php'" 
    class="mt-4 px-6 py-3 text-lg font-semibold text-white 
    bg-gradient-to-r from-orange-400 to-red-500 
    rounded-full shadow-lg transform transition-all 
    hover:scale-105 hover:shadow-xl 
    active:scale-95">
    View Chart</button>
    </div>
</body>
</html>

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

        //for night toggle button

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

