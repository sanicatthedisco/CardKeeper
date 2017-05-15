<html>
    <head>
        <title>Register | CardKeeper</title>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/register.css">
    </head>
    
    <body>
        <header>
            <ul>
                <a href="index.php"><li id="title">CardKeeper</li></a>
                <a href="register.php"><li class="right">Register</li></a>
                <a href="login.php"><li class="right">Login</li></a>
            </ul>
            
            <article>
                <h3>Register with CardKeeper</h3>
                
                <form action="php/submit-registry.php" method="post">
                    <input type="text" placeholder="first name" name="first-name">
                    <input type="text" placeholder="last name" name="last-name">
                    <input type="text" placeholder="email" name="email">
                    <input type="password" placeholder="password" name="password">
                    <input type="password" placeholder="confirm password" name="confirm">
                    <input class="submit" type="submit">
                </form>
            </article>
        </header>
    </body>
</html>