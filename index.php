<?php
session_start();

// USER LOGIN CHECK
if (!isset($_SESSION['username'])) {
  header("Location: login.php"); // IF NOT, REDIRECT TO LOGIN
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FitQuest</title>
  <link
    href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
    rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <!-- HEADER -->
  <header>
    <a href="#home" class="logo"> Fit <span>Quest</span> </a>

    <ul class="navbar">
      <li>
        <a href="#home">Home</a>
      </li>
      <li>
        <a href="#about">About Us</a>
      </li>
      <li>
        <a href="#training-form">Start training</a>
      </li>
      <li>
        <a href="#training-filter">Statistics</a>
      </li>
    </ul>

    <!-- AVATAR -->

    <div class="user-avatar">
      <div class="dropdown-menu">
        <button class="dropdown-toggle">
          <img src="imgs/avatar.jpg" alt="Avatar korisnika" class="avatar-img" />

          <span class="user-name"><?php echo $_SESSION['username']; ?></span>
        </button>
        <ul class="menu">
          <!-- <li><a href="#">Profile</a></li>
            <li><a href="#">Settings</a></li> -->
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </header>

  <!-- HOME SECTION -->

  <section class="home" id="home">
    <div class="home-content">
      <h3>One Step Closer</h3>
      <h1>To Your Dream</h1>
      <h3><span class="multiple-text">Physique</span></h3>

      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
      <div class="home-img">
        <img src="imgs/hero2.png" alt="Home Image" />
      </div>
    </div>
  </section>

  <div class="why-us-wrapper" id="about">
    <section class="why-us-section">
      <h2 class="why-us-title">About <span class="highlight">Us</span></h2>
      <ul class="why-us-list">
        <li>
          <h3 class="why-list-title">Personalized Training Programs</h3>
          <p>
            We believe in a tailored approach to fitness. Our expert trainers
            create customized workout plans that match your goals, fitness
            level, and lifestyle, ensuring you get the most out of every
            session.
          </p>
        </li>
        <li>
          <h3 class="why-list-title">Certified Experts</h3>
          <p>
            Our team consists of certified trainers and nutrition specialists
            with years of experience. They’re not just knowledgeable—they’re
            passionate about helping you succeed.
          </p>
        </li>
        <li>
          <h3 class="why-list-title">State-of-the-Art Facilities</h3>
          <p>
            Train in our modern, fully equipped gym with the latest fitness
            technology and equipment. Our clean, spacious environment is
            designed to inspire and motivate you.
          </p>
        </li>
        <li>
          <h3 class="why-list-title">Supportive Community</h3>
          <p>
            Join a welcoming community that encourages and supports you every
            step of the way. We foster a positive atmosphere where you can
            connect with others on similar journeys.
          </p>
        </li>
        <li>
          <h3 class="why-list-title">Holistic Approach</h3>
          <p>
            Fitness is more than just exercise; it’s about overall well-being.
            We offer guidance on nutrition, recovery, and mental wellness to
            help you achieve a balanced, healthy lifestyle.
          </p>
        </li>
        <li>
          <h3 class="why-list-title">Proven Results</h3>
          <p>
            Our clients’ success stories speak for themselves. We’ve helped
            countless individuals transform their bodies and lives through our
            effective, science-backed methods.
          </p>
        </li>
      </ul>
    </section>
  </div>

  <!-- START TRAINING SECTION -->
  <section class="formwrap">
    <div class="training-form-wrap">

      <form id="training-form" method="POST">
        <h2>Training <span>Tracker</span></h2>

        <!-- Training type -->
        <select id="training-type" name="training_type" required>
          <option value="" disabled selected>Select training type</option>
          <option value="cardio">Cardio</option>
          <option value="strength">Strength</option>
          <option value="flexibility">Flexibility</option>
        </select>

        <!-- Exercise list (dinamički ćeš dodavati vežbe putem JS) -->
        <ul id="exercise-list"></ul>

        <!-- New exercise button -->
        <button type="button" id="add-exercise">Add new exercise</button>

        <!-- Fatigue slider -->
        <p class="input-title">Fatigue (1-10):</p>
        <input type="range" id="fatigue" name="fatigue" min="1" max="10" value="5" />
        <div class="slider-labels">
          <span>1</span><span>2</span><span>3</span><span>4</span>
          <span>5</span><span>6</span><span>7</span><span>8</span>
          <span>9</span><span>10</span>
        </div>

        <!-- Other inputs -->
        <input
          type="number"
          id="duration"
          name="duration"
          min="1"
          required
          placeholder="Training duration (minutes)" />
        <input
          type="number"
          id="weight"
          name="start_weight"
          min="0"
          step="0.1"
          required
          placeholder="Starting weight (kg)" />
        <input type="datetime-local" id="date-time" name="training_date" required />

        <!-- Submit -->
        <button type="submit" id="finish">Finish training</button>
      </form>
    </div>
    <div id="message" class="message"></div>

  </section>

  <!-- STATISTICS -->
  <section id="training-filter">
    <h2 id="training-header">Training <span>Data</span></h2>
    <form id="filter-form">
      <label for="month">Month:</label>
      <select id="month" name="month" required>
        <option value="" disabled selected>Select month</option>
        <option value="01">January</option>
        <option value="02">February</option>
        <option value="03">March</option>
        <option value="04">April</option>
        <option value="05">May</option>
        <option value="06">June</option>
        <option value="07">July</option>
        <option value="08">August</option>
        <option value="09">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
      </select>

      <label for="year">Year:</label>
      <select id="year" name="year" required>
        <option value="" disabled selected>Select year</option>
        <option value="2023">2023</option>
        <option value="2024">2024</option>
      </select>

      <button type="submit">Submit</button>
    </form>
  </section>

  <!-- Section for Displaying Data -->
  <section class="training-data">

    <?php if (!empty($training_data)): ?>
      <h2>Training Data for <?php echo htmlspecialchars($month) . '/' . htmlspecialchars($year); ?></h2>
      <?php foreach ($training_data as $week => $exercises): ?>
        <h3>Week <?php echo htmlspecialchars($week); ?></h3>
        <ul>
          <?php foreach ($exercises as $type => $total_reps): ?>
            <li><?php echo htmlspecialchars($type); ?>: <?php echo htmlspecialchars($total_reps); ?> reps</li>
          <?php endforeach; ?>
        </ul>
      <?php endforeach; ?>
    <?php endif; ?>

  </section>


  <script src="js/script.js"></script>
  <script src="js/statistics.js"></script>

</body>

</html>