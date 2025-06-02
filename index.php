<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEATHER SITE</title>
    <!-- Tailwind CSS for Responsive Design -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- GSAP for Animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
    <!-- Particles.js for Background Effects -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>

    <link href="stylee.css" rel="stylesheet">
</head>

<body class="text-white">
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
   

    <!-- Custom Cursor -->
    <div class="cursor"></div>
    <div class="container mx-auto p-4">
        <div class="max-w-2xl mx-auto bg-white/10 backdrop-blur-md rounded-xl shadow-2xl p-8 hover-effect">
            <h2 class="text-4xl font-bold mb-6 text-center">Weather SITE</h2>
            <div class="flex flex-col items-center">
                
            <input type="text" id="city" placeholder="Enter City" 
    class="w-full max-w-md px-4 py-2 rounded-lg 
           bg-white/20 text-black placeholder-gray-300
           focus:outline-none focus:ring-2 focus:ring-white">


           <button onclick="getWeather()" 
    class="mt-4 px-6 py-3 text-lg font-semibold text-white 
    bg-gradient-to-r from-orange-400 to-red-500 
    rounded-full shadow-lg transform transition-all 
    hover:scale-105 hover:shadow-xl 
    active:scale-95">
    🌦️ Get Weather
</button>

        <button onclick="window.location.href='compare.php'" 
    class="mt-4 px-6 py-3 text-lg font-semibold text-white 
    bg-gradient-to-r from-orange-400 to-red-500 
    rounded-full shadow-lg transform transition-all 
    hover:scale-105 hover:shadow-xl 
    active:scale-95">
    Compare Cities</button>

    <button onclick="window.location.href='chart.php'" 
    class="mt-4 px-6 py-3 text-lg font-semibold text-white 
    bg-gradient-to-r from-orange-400 to-red-500 
    rounded-full shadow-lg transform transition-all 
    hover:scale-105 hover:shadow-xl 
    active:scale-95">
    View Chart</button>

    

            </div>
            <div class="loading mx-auto mt-4 hidden" id="loader"></div>
            <div id="weatherResult" class="mt-6 text-center hidden"></div>
        </div>

        <!-- Past Weather Records -->
        <div class="max-w-4xl mx-auto mt-12 bg-white/10 backdrop-blur-md rounded-xl shadow-2xl p-8 hover-effect">
            <h3 class="text-3xl font-bold mb-6 text-center">Past Weather Records</h3>
            <table class="w-full">
                <thead>
                    <tr class="bg-orange-400">
                        <th class="py-3 px-4">City</th>
                        <th class="py-3 px-4">Temperature (°C)</th>
                        <th class="py-3 px-4">Humidity (%)</th>
                        <th class="py-3 px-4">Wind Speed (m/s)</th>
                        <th class="py-3 px-4">Recorded at</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM weather_records ORDER BY recorded_at DESC LIMIT 10");
                    $index = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='hover:bg-white/10 transition-all' style='transition-delay: " . ($index * 0.2) . "s;'>
                                <td class='py-3 px-4'>{$row['city']}</td>
                                <td class='py-3 px-4'>{$row['temperature']}</td>
                                <td class='py-3 px-4'>{$row['humidity']}</td>
                                <td class='py-3 px-4'>{$row['wind_speed']}</td>
                                <td class='py-3 px-4'>{$row['recorded_at']}</td>
                              </tr>";
                        $index++;
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Weather Popup -->
        <div id="weatherPopup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white text-black p-8 rounded-lg shadow-lg relative">
                <button onclick="closePopup()" class="absolute top-2 right-2 text-black text-2xl">✖</button>
                <div id="popupContent" class="text-center">
                    <!-- Weather details will be added here dynamically -->
                </div>
            </div>
        </div>
    </div>

    <script>

        //for sidebar saved locations

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
        }

        async function fetchWeather(city) {
            // Fetching weather data from save_weather.php
            const response = await fetch('save_weather.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'city=' + encodeURIComponent(city)
            });
            const data = await response.json();
            if (data.status === "success") {
            return {
            temperature: data.temperature,
            humidity: data.humidity,
            windSpeed: data.wind_speed,
            aqi: Math.floor(Math.random() * 101) + 100 // Random AQI value between 100 and 200
            };
            } else {
            throw new Error(data.message);
            }
        }
        

        async function addCity() {
            let cityInput = document.getElementById("cityInput");
            let cityName = cityInput.value.trim();
            if (cityName === "") return;

            let weatherData = await fetchWeather(cityName);

            let cityList = document.getElementById("cityList");
            let li = document.createElement("li");
            li.classList = "bg-gray-700 p-4 rounded shadow flex flex-col";
            li.innerHTML = `
                <div class="flex justify-between items-center">
                    <span class="font-semibold">${cityName}</span>
                    <button onclick="this.parentElement.parentElement.remove(); saveCities();" class="text-red-400">❌</button>
                </div>
                <p class="text-sm text-gray-300">🌡️ Temp: ${weatherData.temperature}°C</p>
                <p class="text-sm text-gray-300">💧 Humidity: ${weatherData.humidity}%</p>
                <p class="text-sm text-gray-300">💨 Wind: ${weatherData.windSpeed} m/s</p>
                <p class="text-sm text-gray-300">🌫️ AQI: ${weatherData.aqi}</p> `;
            cityList.appendChild(li);
            cityInput.value = "";
            saveCities();
        }

        function saveCities() {
            let cities = [];
            document.querySelectorAll("#cityList li").forEach(li => {
                cities.push(li.innerHTML);
            });
            localStorage.setItem("savedCities", JSON.stringify(cities));
        }

        function loadCities() {
            let saved = JSON.parse(localStorage.getItem("savedCities")) || [];
            let cityList = document.getElementById("cityList");
            saved.forEach(html => {
                let li = document.createElement("li");
                li.classList = "bg-gray-700 p-4 rounded shadow flex flex-col";
                li.innerHTML = html;
                cityList.appendChild(li);
            });
        }

        window.onload = loadCities;





        
        // Custom Cursor Movement
        const cursor = document.querySelector('.cursor');
        document.addEventListener('mousemove', (e) => {
            cursor.style.left = e.pageX + 'px';
            cursor.style.top = e.pageY + 'px';
        });

        // Particles.js Configuration
        particlesJS.load('particles-js', 'particles.json', function() {
            console.log('Particles.js loaded');
        });

        // GSAP Animations for Table Rows
        gsap.from('tbody tr', {
            opacity: 0,
            y: 50,
            stagger: 0.2,
            duration: 1,
            ease: 'power3.out',
            delay: 0.5
        });

        // Fetch Weather Data MAIN FUNCTION OF FETCHING WEATHER DATA
        async function getWeather() {
            let city = document.getElementById('city').value;
            if (city === '') {
                alert('Please enter a city name');
                return;
            }

            document.getElementById('loader').style.display = 'block';
            try {
                let weatherData = await fetchWeather(city);
                document.getElementById('loader').style.display = 'none';

                // Show popup with weather details
                let popupContent = document.getElementById('popupContent');
                popupContent.innerHTML = `
                    <h4 class="text-2xl font-semibold">Weather in ${city}</h4>
                    <p class="mt-2">Temperature: <b>${weatherData.temperature}°C</b></p>
                    <p>Humidity: <b>${weatherData.humidity}%</b></p>
                    <p>Wind Speed: <b>${weatherData.windSpeed} m/s</b></p>
                    <p>AQI: <b>${weatherData.aqi}</b></p>
                `;
                document.getElementById('weatherPopup').classList.remove('hidden');

                // Add city to past weather records
                let tableBody = document.querySelector('tbody');
                let newRow = document.createElement('tr');
                newRow.classList.add('hover:bg-white/10', 'transition-all');
                newRow.innerHTML = `
                    <td class='py-3 px-4'>${city}</td>
                    <td class='py-3 px-4'>${weatherData.temperature}</td>
                    <td class='py-3 px-4'>${weatherData.humidity}</td>
                    <td class='py-3 px-4'>${weatherData.windSpeed}</td>
                    <td class='py-3 px-4'>${new Date().toLocaleString()}</td>
                `;
                tableBody.prepend(newRow);
            } catch (error) {
                document.getElementById('loader').style.display = 'none';
                let weatherDiv = document.getElementById('weatherResult');
                weatherDiv.innerHTML = `<p class="text-red-300">${error.message}</p>`;
                weatherDiv.style.display = 'block';
            }
        }

        function closePopup() {
            document.getElementById('weatherPopup').classList.add('hidden');
        }


        //For night and light mode

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