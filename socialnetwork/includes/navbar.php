<div class="usernav">
    <?php
        $sql2 = "SELECT COUNT(*) AS count FROM friendship
                 WHERE friendship.user2_id = {$_SESSION['user_id']} AND friendship.friendship_status = 0";
        $query2 = mysqli_query($conn, $sql2);
        $row = mysqli_fetch_assoc($query2);
    ?>
    <ul> <!-- Ensure there are no enter escape characters.-->
        <li><a href="requests.php">Richieste di Lavoratori (<?php echo $row['count'] ?>)</a></li><li><a href="profile.php">Profilo</a></li><li><a href="friends.php">Amici</a></li><li><a href="home.php">Home</a></li><li><a href="logout.php">Log Out</a></li>
    </ul>
    <div class="globalsearch">
        <form method="get" action="search.php" onsubmit="return validateField()"> <!-- Ensure there are no enter escape characters.-->
            <select name="location">
                <option value="email">Email</option>
                <option value="names">Nomi</option>
                <option value="hometowns">Luogo Nascita</option>
                <option value="posts">Posts</option>
                <option value="tipocap">tipocapelli</option>
                <option value="peso">Peso</option>

            </select><input type="text" placeholder="ricerca" name="query" id="query"><input type="submit" value="ricerca" id="querybutton">
        </form>
    </div>
</div>

<script>
function validateField(){
    var query = document.getElementById("query");
    var button = document.getElementById("querybutton");
    if(query.value == "") {
        query.placeholder = 'Type something!';
        return false;
    }
    return true;
}
</script>
