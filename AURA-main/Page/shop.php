<!DOCTYPE html>
<html lang="en">
<head>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop | AURA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/Logo-S.png">
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo-container">
                <img src="../assets/img/Logo-W.png" alt="AURA Logo" class="logo-img" id="siteLogo">
                
            </div>
            <nav>
                <ul class="center-nav">
                    <li><a href="cart.php">CART</a></li>
                    <li><a href="../index.php">HOME</a></li>
                    <li><a href="about.php">ABOUT US</a></li>
                </ul>

                <ul class="right-actions">
                    <?php if (!isset($_SESSION['username'])): ?>
                        <li><a href="login.php">LOG IN</a></li>
                        <li><a href="signup.php" class="signup-btn">SIGN UP</a></li>
                    <?php endif; ?>
                </ul>

            </nav>
        </div>
    </header>
</body>
</html>