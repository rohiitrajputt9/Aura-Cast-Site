<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Weather Site</title>
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
    <nav class="shadow-md p-4 flex justify-between items-center backdrop-blur-md rounded-xl shadow-2xl">
        <!-- Logo -->
        <h1 class="text-2xl font-bold text-white">🌦️ AuraCast</h1>

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
            <h2 class="text-4xl font-bold mb-6 text-center">About Us</h2>
            <div class="flex flex-col items-center">
                <section class="text-center">
                    <h3 class="text-3xl font-bold mb-4">Our Mission</h3>
                    <p class="text-lg">Welcome to our Weather Site! Our mission is to provide accurate and real-time weather forecasting to help you plan your day better. We use advanced technology and reliable data sources to ensure you get the most up-to-date weather information.</p>
                </section>
                <section class="text-center mt-8">
                    <h3 class="text-3xl font-bold mb-4">Our Team</h3>
                    <ul class="text-lg">
                        <li><strong>Developer:</strong> Rohit Rajput</li>
                        <li><strong>Back-End:</strong> Prince Mourya</li>
                        <li><strong>CSS:</strong> Mahesh Salunke</li>
                    </ul>
                </section>
                <section class="text-center mt-8">
                    <h3 class="text-3xl font-bold mb-4">Features</h3>
                    <p class="text-lg">Our website offers a variety of features to help you stay informed about the weather:</p>
                    <ul class="text-lg mt-4">
                        <li><strong>Past Records:</strong> View past weather records for different cities.</li>
                        <li><strong>Side-by-Side Comparisons:</strong> Compare weather conditions of multiple cities side by side on the <a href="compare.php" class="text-blue-400 underline">Compare Cities</a> page.</li>
                        <li><strong>Chart Comparisons:</strong> Visualize weather data using charts on the <a href="chart.php" class="text-blue-400 underline">View Chart</a> page.</li>
                    </ul>
                </section>
            </div>
        </div>
    </div>

    <script>
        //for sidebar saved locations

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
        }

        async function fetchWeather(city) {
            // Simulating fetching weather data (Replace with real API if needed)
            return new Promise(resolve => {
                setTimeout(() => {
                    resolve({
                        temperature: (Math.random() * 15 + 20).toFixed(1),
                        humidity: (Math.random() * 30 + 50).toFixed(0),
                        windSpeed: (Math.random() * 3 + 2).toFixed(1),
                        aqi: Math.floor(Math.random() * 150 + 50)
                    });
                }, 1000);
            });
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
            aqi: Math.floor(Math.random() * 201) // Random AQI value between 0 and 200
            };
            } else {
            throw new Error(data.message);
            }
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