<?php 
require_once '../private/session_manager.php';

if (!isLogin()) {
    header('Location: index.php');
}
 

if (isset($_GET['logout'])) {
    $logout_message = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>". $_SESSION['name'] ."</b> has left the chat session.</span><br></div>";
    file_put_contents("log.html", $logout_message, FILE_APPEND | LOCK_EX);
    session_destroy();
    header("Location: index.php");
}

if (isset($_POST['enter'])) {
	
	
    if ($_POST['name'] != "") {
		
        $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
		
        $login_message = "<div class='msgln'><span class='enter-info'>User <b class='user-name-enter'>". $_SESSION['name'] ."</b> has enter the chat session.</span><br></div>";
        file_put_contents("log.html", $login_message, FILE_APPEND | LOCK_EX);
    
    } else {
        echo '<span class="error"> 💞🥰🤭 Please Type Your Name My Dear  🥰💞😁</span>';
    }
}

function loginForm() {
    echo ' <div class="hell">
                <br><br>
          <p>Please enter your name to continue! 👇</p> 
<form action="hello.php" method="post">
<label for="name">Name &mdash;</label>
<input type="text" name="name" id="name" />
<input type="submit" name="enter" id="enter" value="Enter" />
                </form>
                 <br><br>
                <div class="col-md-offset-8">
            <p> 🤭 <a href="/assets/radha.jpg">  N💞M </a> </p>
        </div>
        
    </div>
            
';
}
if (isset($_POST['delete_chat'])) {
    // Check if the user has the required authorization (e.g., username is "Genius")
    if ($_SESSION['name'] === 'Mr.Genius') {
        // Delete the chat log file
        if (file_exists("log.html")) {
            unlink("log.html");
            echo '<p class="success">Chat log has been deleted successfully.</p>';
        } else {
            echo '<p class="error">️☠️️Chat log file does not exist☠️.</p>';
        }
    } else {
        echo '<p class="error">️️Jaan! You don"t have permission to delete☠️</p>';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title> Friend's Chat  </title>
    <meta name="description" content="😂 Chat_Box 😂" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <script type="text/javascript" src="./js/toastify.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" /> 
    
    <link href="./css/theme.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.tiny.cloud/1/zs2i3v7nfmps8tjellrlfujiyezo3iwj51o0l8d1eqy3ppaf/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: "#mytextarea",
            menubar: false,
            toolbar_location: "bottom",
            plugins: "autoresize link lists emoticons image",
            autoresize_bottom_margin: 0,
            max_height: 200,
            placeholder: "Enter message . . .",
            toolbar: "bold italic emoticons image",
        });
    </script>
    <style>
        .tall-row {
            margin-top: 0px;
        }
        .modal {
            position: relative;
            top: auto;
            right: auto;
            left: auto;
            bottom: auto;
            z-index: 1;
            display: block;
        }
    </style>
 
 <style> 
 .message {;
  background-color: #25d366;;
  color: #fff;
  padding: 10px;
  margin: 5px;";
   border-radius: 10px;
  max-width: 70%;
  </style>
  <style>
 .received {;
  background-color: #00f;
   color: #000;
   padding: 10px;
  margin: 5px;
  border-radius: 10px;
  max-width: 70%;
   box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
 
 </style>
 
	 

</head> 
<body>
    <?php
    if (!isset($_SESSION['name'])) {
        loginForm();
    } else {
    ?>
    <div id="wrapper">
        <div id="menu">
            <p class="welcome">Welcome 😘 <b><?php echo $_SESSION['name']; ?></b></p>
              <form method="post" action="">
                <?php {
                    echo '<button type="submit" name="delete_chat">🗑️</button>';
                }
                ?>
            </form>
            <p class="logout"><a id="exit" href="?logout">Exit 🚪</a></p>
		
        </div>
        <div id="chatbox">
            <?php
            if (file_exists("log.html") && filesize("log.html") > 0) {
                $contents = file_get_contents("log.html");
                echo $contents;
            }
            ?>
        </div>
        <form name="message" id="messageForm" action="">
        <input name="usermsg" type="text" id="usermsg"  placeholder=" Type your message..." />
     
		<!-- Emoji button to open emoji picker -->
		<button type="button" id="emoji-button">😀</button>
        <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
        
        
    </form>
    
    <div id="emoji-picker" style="display: none;">
        <!-- Emojis you want to provide --> 
<button class="emoji" onclick="insertEmoji('😀')">😀</button>
<button class="emoji" onclick="insertEmoji('😂')">😂</button>
<button class="emoji" onclick="insertEmoji('😃')">😃</button>
<button class="emoji" onclick="insertEmoji('😄')">😄</button>
<button class="emoji" onclick="insertEmoji('😅')">😅</button>
<button class="emoji" onclick="insertEmoji('😆')">😆</button>
<button class="emoji" onclick="insertEmoji('😉')">😉</button>
<button class="emoji" onclick="insertEmoji('😊')">😊</button>
<button class="emoji" onclick="insertEmoji('😋')">😋</button>
<button class="emoji" onclick="insertEmoji('😍')">😍</button>
<button class="emoji" onclick="insertEmoji('🙂')">🙂</button>
<button class="emoji" onclick="insertEmoji('🙃')">🙃</button>
<button class="emoji" onclick="insertEmoji('Paglet 😇')">Pagl 😇</button> 
<button class="emoji" onclick="insertEmoji('😉')">😉</button>
<button class="emoji" onclick="insertEmoji('😊')">😊</button>
<button class="emoji" onclick="insertEmoji('😋')">😋</button>
<button class="emoji" onclick="insertEmoji('Sakuuun 😌')">😌</button>
<button class="emoji" onclick="insertEmoji('😍')">😍</button>
<button class="emoji" onclick="insertEmoji('😎')">😎</button>
<button class="emoji" onclick="insertEmoji('😏')">😏</button>
<button class="emoji" onclick="insertEmoji('❤️')">❤️</button>
<button class="emoji" onclick="insertEmoji('💖')">💖</button> 
<button class="emoji" onclick="insertEmoji('💑')">💑</button>
<button class="emoji" onclick="insertEmoji('💏')">💏</button>
<button class="emoji" onclick="insertEmoji('💌')">💌</button>
<button class="emoji" onclick="insertEmoji('💋')">💋</button>
<button class="emoji" onclick="insertEmoji('😘')">😘</button>
<button class="emoji" onclick="insertEmoji('Miss Ji 😍')"> 😍</button>
<button class="emoji" onclick="insertEmoji('😻')">😻</button>
<button class="emoji" onclick="insertEmoji('😳')">😳</button>
<button class="emoji" onclick="insertEmoji('😣')">😣</button>
<button class="emoji" onclick="insertEmoji('😓')">😓</button>
<button class="emoji" onclick="insertEmoji('😅')">😅</button>
<button class="emoji" onclick="insertEmoji('Hyww 🙈')">Hyww 🙈</button>
<button class="emoji" onclick="insertEmoji('Oops!🙊')">Oops! 🙊</button>
<button class="emoji" onclick="insertEmoji('Hiiiii😁')">😁</button>
<button class="emoji" onclick="insertEmoji('🤭')">🤭</button>
<button class="emoji" onclick="insertEmoji('🤤')">🤤</button>
<button class="emoji" onclick="insertEmoji('🥰')">🥰</button>


<button class="emoji" onclick="insertEmoji('Mr Ji😚')">Mr Ji 😚</button>
<button class="emoji" onclick="insertEmoji('Love U😚')">😚</button>
 <button class="emoji" onclick="insertEmoji('✋')">✋</button>
<button class="emoji" onclick="insertEmoji('🤚')">🤚</button>
<button class="emoji" onclick="insertEmoji('🖐')">🖐</button>
<button class="emoji" onclick="insertEmoji('Pittegi👋')">👋</button>
<button class="emoji" onclick="insertEmoji('Whaa kya baat h 👏')">👏</button>
<button class="emoji" onclick="insertEmoji('👐')">👐</button> 
<button class="emoji" onclick="insertEmoji(Httt'👊')">👊</button>
<button class="emoji" onclick="insertEmoji('✌️')">✌️</button>
<button class="emoji" onclick="insertEmoji('Hello Ji🤝')">🤝</button>
<button class="emoji" onclick="insertEmoji('🤜')">🤜</button>
<button class="emoji" onclick="insertEmoji('🤛')">🤛</button>
<button class="emoji" onclick="insertEmoji('Ram-Ram🙏')">Ram🙏</button> 

<button class="emoji" onclick="insertEmoji('😁')">😁</button>
<button class="emoji" onclick="insertEmoji('🦵')">🦵</button>
<button class="emoji" onclick="insertEmoji('🦶')">🦶</button>
<button class="emoji" onclick="insertEmoji('Dimak 🧠')">🧠</button>
<button class="emoji" onclick="insertEmoji('Huu😏')">Huu😏</button>
<button class="emoji" onclick="insertEmoji('🕶️')">🕶️</button>
<button class="emoji" onclick="insertEmoji('💪')">💪</button>
<button class="emoji" onclick="insertEmoji('Can i call u 🤙')">🤙</button>
<button class="emoji" onclick="insertEmoji('🤘')">🤘</button>
<button class="emoji" onclick="insertEmoji('👑')">👑</button>
<button class="emoji" onclick="insertEmoji('💅')">💅</button>
<button class="emoji" onclick="insertEmoji('🔥')">🔥</button>
<button class="emoji" onclick="insertEmoji('💯')">💯</button>
<button class="emoji" onclick="insertEmoji('🚀')">🚀</button> 
<button class="emoji" onclick="insertEmoji('🤩')">🤩</button>
<button class="emoji" onclick="insertEmoji('🎉')">🎉</button>
<button class="emoji" onclick="insertEmoji('Party to bnti h 🥳')">p 🥳</button>
<button class="emoji" onclick="insertEmoji('🎈')">🎈</button>
<button class="emoji" onclick="insertEmoji('🎊')">🎊</button>
<button class="emoji" onclick="insertEmoji('Cake🎂')">🎂</button>
<button class="emoji" onclick="insertEmoji('Cake 🍰')">🍰</button>
<button class="emoji" onclick="insertEmoji('Gift 🎁')">🎁</button>
<button class="emoji" onclick="insertEmoji('Song  sunu hu 🎶')">🎶</button>
<button class="emoji" onclick="insertEmoji('🍾')">🍾</button>
<button class="emoji" onclick="insertEmoji('🥂')">🥂</button>
<button class="emoji" onclick="insertEmoji('🍻')">🍻</button>
<button class="emoji" onclick="insertEmoji('🍷')">🍷</button>
<button class="emoji" onclick="insertEmoji('🍸')">🍸</button>
<button class="emoji" onclick="insertEmoji('🍹')">🍹</button>
<button class="emoji" onclick="insertEmoji('🥃')">🥃</button>
<button class="emoji" onclick="insertEmoji('🍺')">🍺</button> 
<button class="emoji" onclick="insertEmoji('💔')">💔</button> 

<button class="emoji" onclick="insertEmoji('Chl n tu apna kaam kar 😏')">chl 😏</button>
<button class="emoji" onclick="insertEmoji('👍')">👍</button>
<button class="emoji" onclick="insertEmoji('👎')">👎</button> 
<button class="emoji" onclick="insertEmoji('✌️')">✌️</button>
<button class="emoji" onclick="insertEmoji('👋')">👋</button>
<button class="emoji" onclick="insertEmoji('👆')">👆</button>
<button class="emoji" onclick="insertEmoji('👇')">👇</button>
<button class="emoji" onclick="insertEmoji('👈')">👈</button>
<button class="emoji" onclick="insertEmoji('👉')">👉</button>
<button class="emoji" onclick="insertEmoji('🙌')">🙌</button>
<button class="emoji" onclick="insertEmoji('🙏')">🙏</button>
<button class="emoji" onclick="insertEmoji('Kit h👀')">👀</button>
<button class="emoji" onclick="insertEmoji('🧐')">🧐</button> 
<button class="emoji" onclick="insertEmoji('😢')">😢</button>
<button class="emoji" onclick="insertEmoji('😭')">😭</button>
<button class="emoji" onclick="insertEmoji('😥')">😥</button>
<button class="emoji" onclick="insertEmoji('😓')">😓</button>
<button class="emoji" onclick="insertEmoji('😩')">😩</button>
<button class="emoji" onclick="insertEmoji('😫')">😫</button>
<button class="emoji" onclick="insertEmoji('😞')">😞</button>
<button class="emoji" onclick="insertEmoji('😟')">😟</button>
<button class="emoji" onclick="insertEmoji('😔')">😔</button>
<button class="emoji" onclick="insertEmoji('😣')">😣</button>
<button class="emoji" onclick="insertEmoji('😖')">😖</button>
<button class="emoji" onclick="insertEmoji('😰')">😰</button>
<button class="emoji" onclick="insertEmoji('😨')">😨</button>
<button class="emoji" onclick="insertEmoji('😣')">😣</button>
<button class="emoji" onclick="insertEmoji('😖')">😖</button>
<button class="emoji" onclick="insertEmoji('😓')">😓</button>
<button class="emoji" onclick="insertEmoji('Sorry 😞')">😞</button>
<button class="emoji" onclick="insertEmoji('😟')">😟</button>
<button class="emoji" onclick="insertEmoji('😔')">😔</button> 
<button class="emoji" onclick="insertEmoji('🏎️')">🏎️</button 
<button class="emoji" onclick="insertEmoji('🚌')">🚌</button>
<button class="emoji" onclick="insertEmoji('🚍')">🚍</button>
<button class="emoji" onclick="insertEmoji('👩')">👩</button >
<button class="emoji" onclick="insertEmoji('👧')">👧</button>  
<button class="emoji" onclick="insertEmoji('😡')">😡</button>
<button class="emoji" onclick="insertEmoji('🤬')">🤬</button>
<button class="emoji" onclick="insertEmoji('😠')">😠</button>
<button class="emoji" onclick="insertEmoji('👿')">👿</button>
<button class="emoji" onclick="insertEmoji('😤')">😤</button>
<button class="emoji" onclick="insertEmoji('😾')">😾</button>
<button class="emoji" onclick="insertEmoji('🙅')">🙅</button>
<button class="emoji" onclick="insertEmoji('Ohh Triii🙆')">🙆</button>
<button class="emoji" onclick="insertEmoji('Bass kar yaar 🙇')">🙇</button> 
<button class="emoji" onclick="insertEmoji('👻')">👻</button>

 

         <!-- Add more emojis here -->

        <!-- Close button to hide emoji picker -->
        <button type="button" id="close-emoji-picker">Close</button>
    </div>
    </div>
    
    <script>
        // Function to insert selected emoji into the input field
        function insertEmoji(emoji) {
            var inputField = document.getElementById('usermsg');
            inputField.value += emoji;
        }

        // Show/hide emoji picker when emoji button is clicked
        var emojiPicker = document.getElementById('emoji-picker');
        var emojiButton = document.getElementById('emoji-button');
        var closeEmojiPicker = document.getElementById('close-emoji-picker');

        emojiButton.addEventListener('click', function() {
            emojiPicker.style.display = 'block';
        });

        closeEmojiPicker.addEventListener('click', function() {
            emojiPicker.style.display = 'none';
        });
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" >
        // jQuery Document
        $(document).ready(function () {
            $("#submitmsg").click(function () {
                var clientmsg = $("#usermsg").val();
                $.post("post.php", { text: clientmsg });
                $("#usermsg").val("");
                return false;
            });
            function loadLog() {
                var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request
                $.ajax({
                    url: "log.html",
                    cache: false,
                    success: function (html) {
                        $("#chatbox").html(html); //Insert chat log into the #chatbox div
                        var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request
                        if(newscrollHeight > oldscrollHeight){
                            $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                        }	
                    }
                });
            }
            setInterval (loadLog, 100);
            $("#exit").click(function () {
                var exit = confirm("Are you sure you want to end the session?");
                if (exit == true) {
                    window.location = "index.php";
                }
            });
        });
    </script>
    <script src="chat.js"></script>
    <br> <br> 
    <div class="row tall-row">
        <div class="col-md-offset-8">
            <p>😁🤭 => <a href="/assets/radha.jpg"> &copy; Mr. Genius </a>.   </p>
        </div>
    </div>
</body>
</html>
<?php
}
?>
