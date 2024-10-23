<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Dropdown Search</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 50px;
    }

    .search-box {
      position: relative;
      width: 300px;
      margin: 0 auto;
      display: flex;
    }

    input[type="text"] {
      width: 100%;
      padding: 10px;
      box-sizing: border-box;
      font-size: 16px;
    }

    button {
      padding: 10px;
      font-size: 16px;
      cursor: pointer;
      margin-left: 5px;
    }

    .dropdown {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      max-height: 300px;
      overflow-y: auto;
      background-color: white;
      border: 1px solid #ccc;
      border-top: none;
      display: none;
      z-index: 1000;
    }

    .dropdown .profile-item {
      display: flex;
      align-items: center;
      padding: 10px;
      cursor: pointer;
    }

    .dropdown .profile-item img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .dropdown .profile-item:hover {
      background-color: #f1f1f1;
    }

    .hidden {
      display: none;
    }
  </style>
</head>
<body>

  <div class="search-box">
    <input type="text" id="search-input" placeholder="Search profiles...">
    <button id="search-btn">Search</button>
    <div class="dropdown" id="dropdown">
      <!-- Profiles will be dynamically loaded here -->
    </div>
  </div>

  <script>
    const profiles = [
      { name: 'John Doe', img: 'https://via.placeholder.com/40' },
      { name: 'Jane Smith', img: 'https://via.placeholder.com/40' },
      { name: 'Emily Davis', img: 'https://via.placeholder.com/40' },
      { name: 'Michael Brown', img: 'https://via.placeholder.com/40' }
    ];

    const dropdown = document.getElementById('dropdown');
    const searchButton = document.getElementById('search-btn');
    const searchInput = document.getElementById('search-input');

    // Show profiles in dropdown when the search button is clicked
    searchButton.addEventListener('click', function() {
      showProfiles(profiles);
    });

    // Show profiles based on search input
    searchInput.addEventListener('input', function() {
      const query = this.value.toLowerCase();
      const filteredProfiles = profiles.filter(profile => 
        profile.name.toLowerCase().includes(query)
      );
      showProfiles(filteredProfiles);
    });

    // Function to display profiles in the dropdown
    function showProfiles(profileList) {
      dropdown.innerHTML = '';  // Clear previous results

      if (profileList.length > 0) {
        profileList.forEach(profile => {
          const profileItem = document.createElement('div');
          profileItem.classList.add('profile-item');

          profileItem.innerHTML = `
            <img src="${profile.img}" alt="${profile.name}">
            <span>${profile.name}</span>
          `;

          dropdown.appendChild(profileItem);
        });
        dropdown.style.display = 'block';  // Show the dropdown
      } else {
        dropdown.style.display = 'none';  // Hide if no profiles
      }
    }

    // Hide dropdown when clicking outside
    document.addEventListener('click', function(e) {
      const searchBox = document.querySelector('.search-box');
      if (!searchBox.contains(e.target)) {
        dropdown.style.display = 'none';
      }
    });
  </script>

</body>
</html>
