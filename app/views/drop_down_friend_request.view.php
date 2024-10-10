<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clickable Friend Requests Dropdown</title>
  <style>
    /* Basic reset */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    /* Dropdown container styling */
    .dropdown {
      position: relative;
      display: inline-block;
    }

    /* Dropdown button */
    .dropdown-btn {
      background-color: #4267B2; /* Facebook-like color */
      color: white;
      padding: 10px;
      font-size: 16px;
      border: none;
      cursor: pointer;
    }

    /* Dropdown content */
    .dropdown-content {
      display: none; /* Hidden by default */
      position: absolute;
      background-color: #f9f9f9;
      width: 300px;
      max-height: 300px; /* Set maximum height for scrollability */
      overflow-y: auto;  /* Enable vertical scrolling */
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }

    /* Each friend request item */
    .dropdown-content li {
      list-style-type: none;
      padding: 10px;
      display: flex;
      align-items: center;
      border-bottom: 1px solid #ddd;
    }

    .dropdown-content li:last-child {
      border-bottom: none;
    }

    /* Profile image */
    .profile-img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-right: 10px;
    }

    /* Profile name styling */
    .profile-name {
      font-size: 14px;
      font-weight: bold;
      margin-right: auto;
      color: black;
    }

    /* Accept and Decline buttons */
    .btn {
      padding: 5px 10px;
      margin: 0 2px;
      border: none;
      cursor: pointer;
      font-size: 12px;
      border-radius: 5px;
    }

    .accept-btn {
      background-color: #42b72a;
      color: white;
    }

    .decline-btn {
      background-color: #d32f2f;
      color: white;
    }
  </style>
</head>
<body>

<div class="dropdown">
  <button class="dropdown-btn" onclick="toggleDropdown()">Friend Requests</button>
  <ul class="dropdown-content" id="dropdownMenu">
    <!-- Repeat these list items as needed to test scrolling -->
    <?php if(!empty($friend_requests)): ?>
      <?php foreach($friend_requests as $request): ?>
        <?php $this->view("friend_request", ['request' => $request]); ?>
      <?php endforeach; ?>
    <?php endif; ?>
    <!-- Add more list items if needed -->
  </ul>
</div>

<script>
  // Function to toggle the visibility of the dropdown
  function toggleDropdown() {
    const dropdownMenu = document.getElementById("dropdownMenu");
    dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
  }

  // Close the dropdown if clicked outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropdown-btn')) {
      const dropdowns = document.getElementsByClassName("dropdown-content");
      for (let i = 0; i < dropdowns.length; i++) {
        dropdowns[i].style.display = "none";
      }
    }
  }
</script>

</body>
</html>
