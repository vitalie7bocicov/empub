<!DOCTYPE html>
<html lang="en">

<head>
  <title>EMPub</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../../application/styles/statistics.css">
  <link rel="stylesheet" href="../../application/styles/style.css">
  <script src="../../application/scripts/navbar.js" defer></script>
  <script src="https://kit.fontawesome.com/d31da07a9e.js" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
  <script>
    
		function generatePDF() 
		{
			
			var element = document.getElementById('panelID');

		
			html2pdf().from(element).save();
			 
		};

	</script>
</head>

<body>
  <header>

    <nav>
      <div class="logo">
        <a href="../../application/views/main.php">
          <img src="../../application/images/white_logo.png" alt="Logo">
        </a>
      </div>
      <a href="#" class="hamburger">
        <div class="bar"></div>
        <!--<span class="bar "></span>
            <span class="bar "></span>-->
      </a>
      <ul class="nav-links">
        <li>
          <a href="../../application/views/main.php">Home</a>
        </li>
        <li>
          <a href="doc.html">About</a>
        </li>
        <li id="account">
          <a href="accountSettings.html">Account</a>
        </li>
        <li id="logout">
          <a href="../index.html">
            Logout
          </a>
        </li>
      </ul>
    </nav>
  </header>
  <div class="panel" id="panelID">
    <div class="panel-header">
      <h3 class="title">Statistics</h3>

      <div class="calendar-views">
        <button type="submit" id="dayID"><span>Day</span></button>
        <button type="submit" id="week"><span>Week</span></button>
        <button type="submit" id="month"><span>Month</span></button>
       
      </div>
    </div>

    <section class="sidebar" id="sidebar">
      <button onclick="location.href='main.html'" class="sidebar-buttons"><i class="fa-solid fa-inbox"></i>
        Inbox</button>
      <button class="sidebar-buttons" style="background-color: grey;"><i class=" fa-solid fa-chart-line"></i>
        Statistics</button>
      <button onclick="location.href='settingsPage.html'" class="sidebar-buttons"><i class=" fa-solid fa-gear"></i>
        Settings</button>
    </section>

    <div class="panel-body">
      <div class="categories">
        <div class="category">
          <span>VIEWS</span>
          <span id="totalViews"></span>
        </div>
      </div>

      <div class="chart">
        <div class="countries">
          <table>
            <tr id="country">
            </tr>
            <tr id="views">
            </tr>
          </table>

        </div>


        <svg width="650" height="204" class="data-chart" xmlns="http://www.w3.org/2000/svg">

          <svg width="650" height="204" class="data-chart" xmlns="http://www.w3.org/2000/svg">
            <g fill="none" fill-rule="evenodd">
              <path class="dataset-1"
                d="M30.046 97.208c2.895-.84 5.45-2.573 7.305-4.952L71.425 48.52c4.967-6.376 14.218-7.38 20.434-2.217l29.447 34.46c3.846 3.195 9.08 4.15 13.805 2.52l31.014-20.697c4.038-1.392 8.485-.907 12.13 1.32l3.906 2.39c5.03 3.077 11.43 2.753 16.124-.814l8.5-6.458c6.022-4.577 14.563-3.676 19.5 2.056l54.63 55.573c5.622 6.526 15.686 6.647 21.462.258l37.745-31.637c5.217-5.77 14.08-6.32 19.967-1.24l8.955 7.726c5.42 4.675 13.456 4.63 18.82-.11 4.573-4.036 11.198-4.733 16.508-1.735l61.12 34.505c4.88 2.754 10.916 2.408 15.45-.885L563 90.915V204H0v-87.312-12.627c5.62-.717 30.046-6.852 30.046-6.852z"
                fill="#474D56" opacity=".9" />
              <path class="lines" fill="black" opacity=".2"
                d="M0 203h563v1H0zM0 153h563v1H0zM0 102h563v1H0zM0 51h563v1H0zM0 0h563v1H0z" />
            </g>
          </svg>

        </svg>

      </div>


    </div>
    <div class="buttons">
      <button onclick="generatePDF()">GENERATE FORMAT PDF</button>
      <button>GENERATE FORMAT XML</button>
    </div>
  </div>

  <script src="http://localhost/TehnologiiWeb/empub/application/scripts/statisticsPage.js"></script>

</body>

</html>