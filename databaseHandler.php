<?php 
function initConnection(){
    $host = "localhost";
    $username = "root";
    $password ="";
    $database = "metaforums";

    return mysqli_connect($host,$username,$password,$database);

}
// function getMhs(){

//     // var_dump($conn);
//     $conn = setUpDBConnection();
//     $result = $conn->query("SELECT * FROM tbl_mahasiswa");
//     // var_dump($data);
//     $students = [];
//     while ($data = mysqli_fetch_assoc($result)){
//         $students[] = [
//             "Nama" => $data["Nama"],
//             "Jurusan" => $data["Jurusan"],
//             "Nim" => $data["Nim"],
//         ];
//     }
//         return $students;
// }

function verifyEmail($token){
    $conn = initConnection();
    $conn->query("UPDATE MsUser SET Active=1 WHERE Token = '$token'");
}

function checkEmail($mail){
    $conn = initConnection();
    $res = $conn->query("SELECT * FROM MsUser WHERE Email = '$mail'"); 
    return ($res && ($res->num_rows) > 0);
}

function resetToken($mail,$newtok){
    $conn = initConnection();
    $conn->query("UPDATE MsUser SET Token='$newtok' WHERE Email = '$mail'");
    $conn->query("UPDATE MsUser SET Active=0 WHERE Token = '$newtok'");
}

function checkPassword($namail,$password){
    $conn = initConnection();
    $res = $conn->query("SELECT * FROM MsUser WHERE (Username = '$namail' OR Email = '$namail')"); 
    while($data = mysqli_fetch_assoc($res)){
        if(password_verify($password,$data['Hashkey'])){
            return true;
        }
    }
    return false;
}

function getUser($username){
    $conn = initConnection();
    $res = $conn->query("SELECT *,TIMESTAMPDIFF(SECOND,LastLog, CURRENT_TIMESTAMP()) AS DiffLog FROM MsUser WHERE Username = '$username'");
    return mysqli_fetch_assoc($res);
}
function checkUser($name){
    $conn = initConnection();
    $res = $conn->query("SELECT Username FROM MsUser WHERE Username = '$name'");
    return ($res && ($res->num_rows) > 0);
}

function LogUser($name,$password){
    $conn = initConnection();
    $res = $conn->query("SELECT *, DATEDIFF(LastReport,CURRENT_TIMESTAMP()) AS canReport FROM MsUser WHERE (Username = '$name' OR Email = '$name')");
    while($data = mysqli_fetch_assoc($res)){
        if(password_verify($password,$data['Hashkey'])){
            $name = $data['Username'];
            $conn->query("UPDATE MsUser SET LastLog = CURRENT_TIMESTAMP() WHERE Username = '$name'");
            $conn->query("UPDATE MsUser SET `Online` = 1 WHERE Username = '$name'");
            return $data;
        }
    }
    return false;
}

function insertUser($name,$mail,$key,$token){
    $conn = initConnection();
    // var_dump($name,$key);
    $conn->query("INSERT INTO MsUser (Username, Email, Hashkey, Token) VALUES ('$name','$mail','$key','$token')");
    // return;
}

// function resetPassword($email){
//     $conn = initConnection();
//     $res = $conn->query("SELECT Username FROM MsUser WHERE Email = '$email'");
//     return mysqli_fetch_assoc($res);
    
// }

function updatePassword($token,$newpassword){
    $conn = initConnection();
    $conn->query("UPDATE MsUser SET Hashkey = '$newpassword' WHERE Token = '$token'");
    $conn->query("UPDATE MsUser SET Active = 1 WHERE Hashkey = '$newpassword'");
}
function getThreads($category){
    $conn = initConnection();
    $res = $conn->query("SELECT *,mt.ID AS ForumID,Replies/TIMESTAMPDIFF(MINUTE,Created, CURRENT_TIMESTAMP())/5 AS Badge,TIMESTAMPDIFF(SECOND,LastReply, CURRENT_TIMESTAMP()) AS TimeDiff FROM MsThread mt JOIN MsUser mu ON mt.UserID = mu.ID WHERE Category = '$category' AND ReplyTo='None' ORDER BY (View+(Replies*10))/TIMESTAMPDIFF(SECOND,Created, CURRENT_TIMESTAMP()) DESC");
    $datas=[];
    while($data = mysqli_fetch_assoc($res)){
        $datas[]=[
            "id"=>$data["ForumID"],
            "title"=>$data["Title"],
            "view"=>$data["View"],
            "author"=>$data["Username"],
            "authorID"=>$data["UserID"],
            "replies"=>$data["Replies"],
            "lastreplied"=>$data["TimeDiff"],
            "created"=>$data["Created"],
            "badge"=> $data["Badge"] > 10,
            "cat"=> $data["Category"],
            "content"=> $data["Content"]
        ];
    }
    return $datas;
}
function getForum($id){
    $conn = initConnection();
    $res = $conn->query("SELECT *,mt.ID AS PostID,TIMESTAMPDIFF(SECOND,LastReply, CURRENT_TIMESTAMP()) AS TimeDiff,TIMESTAMPDIFF(SECOND,LastLog, CURRENT_TIMESTAMP()) AS DiffLog,TIMESTAMPDIFF(MINUTE,Created, CURRENT_TIMESTAMP()) AS Editable FROM MsThread mt JOIN MsUser mu ON mt.UserID = mu.ID WHERE mt.ID = $id");
    $datas=[];
    while($data = mysqli_fetch_assoc($res)){
        $datas[]=[
            "ForumID"=>$data["ForumID"],
            "Title"=>$data["Title"],
            "View"=>$data["View"],
            "Username"=>$data["Username"],
            "Role"=>$data["Role"],
            "UserID"=>$data["UserID"],
            "Replies"=>$data["Replies"],
            "TimeDiff"=>$data["TimeDiff"],
            "Created"=>$data["Created"],
            "Category"=> $data["Category"],
            "Content"=> $data["Content"],
            "Online"=> $data["Online"],
            "Role"=> $data["Role"],
            "Post"=> $data["Post"],
            "DiffLog"=> $data["DiffLog"],
            "ModStat"=> $data["ModStat"],
            "ID"=> $data["PostID"],
            "Favourite"=> $data["Favourite"],
            "Locked"=> $data["Locked"],
            "Editable"=> $data["Editable"] < 5,
            "ReplyTo"=> $data["ReplyTo"],
            "Category"=> $data["Category"],
            "Email" =>$data["Email"]
        ];
    }
    return $datas;
}

function getReply($id){
    $conn = initConnection();
    $res = $conn->query("SELECT mt.ID as PostID,Category,Assignment,Locked,Favourite,UserID,ProfileImage,Username,`Online`,Post,`Role`,Active,LastLog,Content,Created , ReplyTo,ModStat,ForumID,TIMESTAMPDIFF(SECOND,LastLog, CURRENT_TIMESTAMP()) AS DiffLog,TIMESTAMPDIFF(SECOND,LastReply, CURRENT_TIMESTAMP()) AS TimeDiff,TIMESTAMPDIFF(MINUTE,Created, CURRENT_TIMESTAMP()) AS Editable FROM MsThread mt JOIN MsUser mu ON mt.UserID = mu.ID  WHERE mt.ForumID = $id AND mt.ID <> $id");
    $datas=[];
    while($data = mysqli_fetch_assoc($res)){
        $datas[]=[
            "ForumID"=>$data["ForumID"],
            // "Title"=>$data["Title"],
            "Username"=>$data["Username"],
            "UserID"=>$data["UserID"],
            "TimeDiff"=>$data["TimeDiff"],
            "Created"=>$data["Created"],
            "Content"=> $data["Content"],
            "Online"=> $data["Online"],
            "Role"=> $data["Role"],
            "Post"=> $data["Post"],
            "DiffLog"=> $data["DiffLog"],
            "ModStat"=> $data["ModStat"],
            "ID"=> $data["PostID"],
            "Favourite"=> $data["Favourite"],
            "ProfileImage"=> $data["ProfileImage"],
            "Locked"=> $data["Locked"],
            "Editable"=> $data["Editable"] < 5,
            "ReplyTo"=> $data["ReplyTo"],
            "Category"=> $data["Category"],
            "Assignment"=>$data["Assignment"]
        ];
    }
    return $datas;
}

function LogOut($name){
    $conn = initConnection();
    $conn->query("UPDATE MsUser SET `Online` = 0 WHERE Username = '$name'");
}

function incrementView($id){
    $conn = initConnection();
    $conn->query("UPDATE MsThread SET View = View + 1 WHERE ID = $id");
}

function authorof($user,$post){
    $conn = initConnection();
    $res = $conn->query("SELECT * FROM MsThread WHERE UserID = $user AND ID = $post");
    return $res ? mysqli_fetch_assoc($res):false;
}

function favourites($user,$post){
    $conn = initConnection();
    $res = $conn->query("SELECT * FROM MsComment WHERE UserID = $user AND ThreadID = $post");
    return $res ? mysqli_fetch_assoc($res):false;
}
function addFavourite($user,$post){
    $conn = initConnection();
    $conn->query("INSERT INTO MsComment(UserID,ThreadID,DateCreated) VALUES ($user,$post,CURRENT_TIMESTAMP())");
    $conn->query("UPDATE MsThread SET Favourite = Favourite+1 WHERE ID = $post");
}
function unFavourite($user,$post){
    $conn = initConnection();
    $conn->query("DELETE c FROM MsComment c WHERE UserID = $user AND ThreadID = $post");
    $conn->query("UPDATE MsThread SET Favourite = Favourite-1 WHERE ID = $post");
}
function deletePost($post){
    $conn = initConnection();
    $data = mysqli_fetch_assoc($conn->query("SELECT * FROM MsThread AS t WHERE ID = $post"));
    $conn->query("DELETE t FROM MsThread AS t WHERE ID = $post");
    if($data['ForumID'] == $data['ID']){
        $user = $data['UserID'];
        $conn->query("UPDATE MsUser SET Post = Post - 1 WHERE ID = $user");
        return true;
    }
    return false;
}
function editPost($id,$newcontent){
    $conn = initConnection();
    $conn->query("UPDATE MsThread SET Content='$newcontent' WHERE ID = $id");
}
function isSilenced($name){
    return getUser($name)["ModStat"]=="Silenced";
}

function getReplyTo($id){
    $conn = initConnection();
    $res = $conn->query("SELECT * FROM MsThread WHERE ID=$id");
    return $res ? mysqli_fetch_assoc($res):false;
}

function createReply($newpost,$user){
    $conn = initConnection();
    $content= $newpost['content'];
    $forumid = intval($newpost['forumid']);
    $replyto = $newpost['replyto'];
    $category = $newpost['cat'];

    $conn->query("INSERT INTO MsThread(UserID,ReplyTo,ForumID,Content,LastReply,Created,Category) VALUES($user,'$replyto',$forumid,'$content',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP(),'$category')");
    $conn->query("UPDATE MsThread SET Replies = Replies + 1 WHERE ID = $forumid");
    $conn->query("UPDATE MsThread SET LastReply = CURRENT_TIMESTAMP() WHERE ID = $forumid");
}

function createPost($newpost,$user){
    $conn = initConnection();
    $content= $newpost['content'];
    $category = $newpost['cat'];
    $title = $newpost['title'];
 
    // var_dump('tell');
    $conn->query("INSERT INTO MsThread(UserID,Title,Content,LastReply,Created,Category) VALUES($user,'$title','$content',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP(),'$category')");
    $conn->query("UPDATE MsThread SET ForumID = ID WHERE ForumID IS NULL AND UserID = $user");
    $conn->query("UPDATE MsUser SET Post = Post + 1 WHERE ID = $user");
}

function getAdmin(){
    $conn = initConnection();
    $res = $conn->query("SELECT * FROM MsUser WHERE `Role` = 'Admin'");
    $mails=[];
    while ($data =mysqli_fetch_assoc($res)){
        $mails[]=$data['Email'];
    }
    return $mails;
}

function getMod($category){
    $conn = initConnection();
    $res = $conn->query("SELECT * FROM MsUser WHERE `Role` = 'Mod' AND Assignment = '$category'");
    $mails=[];
    while ($data =mysqli_fetch_assoc($res)){
        $mails[]=$data['Email'];
    }
    return $mails;
}

function addList($forum,$level,$time){
    $conn = initConnection();
    $user = intval($forum['UserID']);
    $thread = intval($forum['ForumID']);
    $conn->query("INSERT INTO MsBan(BanUserID,ThreadID,ModerateLevel,Until,DateCreated) VALUES($user,$thread,'$level',DATE_ADD(CURRENT_TIMESTAMP(),INTERVAL $time),CURRENT_TIMESTAMP())");
    $conn->query("UPDATE MsUser SET ModStat = '$level' WHERE ID = $user");
}

function lockThread($id){
    $conn = initConnection();
    $conn->query("UPDATE MsThread SET Locked=1 WHERE ID = $id");
}

function unLockThread($id){
    $conn = initConnection();
    $conn->query("UPDATE MsThread SET Locked=0 WHERE ID = $id");
}

function isPardon($user,$post){
    $conn = initConnection();
    $res = $conn->query("SELECT *,CURRENT_TIMESTAMP() <= Until AS `Time` FROM MsBan mb JOIN MsThread mt on mb.ThreadID = mt.ID WHERE BanUserID = $user AND ForumID = $post ORDER BY Until DESC");
    $data = mysqli_fetch_assoc($res);
    return ($data) ? $data['Time'] : false;
}
function checkSilence($user,$category){
    $conn = initConnection();
    $res = $conn->query("SELECT *,CURRENT_TIMESTAMP() <= Until AS `Time` FROM MsBan mb JOIN MsThread mt on mb.ThreadID = mt.ID WHERE BanUserID = $user AND Category = '$category' AND ModerateLevel = 'Silence' ORDER BY Until DESC");
    $data = mysqli_fetch_assoc($res);
    if($data){
        if($data['Time']){
            return true;
        }
        // $conn->query("DELETE mb FROM MSBan AS mb WHERE BanUserID = $user AND Category = '$category' AND ModerateLevel = 'Silence'");
    }
    return false;
}

function isBan($user,$category){
    $conn = initConnection();
    $res = $conn->query("SELECT *,CURRENT_TIMESTAMP() <= Until AS `Time` FROM MsBan mb JOIN MsThread mt on mb.ThreadID = mt.ID WHERE BanUserID = $user AND Category = '$category' AND ModerateLevel = 'Ban' ORDER BY Until DESC");
    $data = mysqli_fetch_assoc($res);
    if($data){
        if($data['Time']){
            return true;
        }
        // $conn->query("DELETE mb FROM MSBan AS mb WHERE BanUserID = $user AND Category = '$category' AND ModerateLevel = 'Ban'");
    }
    return false;
    
}
function clearBanList(){
    $conn = initConnection();
    $conn->query("DELETE mb FROM MsBan AS mb WHERE Until < CURRENT_TIMESTAMP()");
}
function refreshUserStatus($user){
    $conn = initConnection();
    $res = $conn->query("SELECT ModerateLevel FROM MsBan AS mb WHERE BanUserID = $user ORDER BY Until");
    $data = mysqli_fetch_assoc($res);
    $modstat = 'Active';
    if($data){
        $modstat = $data["ModerateLevel"];
    }
    $conn->query("UPDATE MsUser SET ModStat = '$modstat' WHERE ID = $user");
}
function getAsg($user){
    $conn = initConnection();
    $res = $conn->query("SELECT Assignment FROM MsUser WHERE ID = $user");
    $data = mysqli_fetch_assoc($res);
    return ($data) ? $data['Assignment'] : false;
}
function getMostActive($id){
    $conn = initConnection();
    $res = $conn->query("SELECT Category,COUNT(*) FROM MsThread WHERE UserID = $id GROUP BY Category ORDER BY COUNT(*) DESC");
    $data = mysqli_fetch_assoc($res);
    return ($data) ? $data['Category'] : false;
}
function getHeart($id){
    $conn = initConnection();
    $res = $conn->query("SELECT COUNT(*) AS Counts FROM MsComment WHERE UserID = $id");
    $data = mysqli_fetch_assoc($res);
    return ($data) ? $data['Counts'] : false;
}
function getRecentPost($id){
    $conn = initConnection();
    $res = $conn->query("SELECT *,mt.ID AS ReplyID,TIMESTAMPDIFF(SECOND,Created, CURRENT_TIMESTAMP()) AS TimeDiff FROM MsThread mt JOIN MsUser mu ON mt.UserID = mu.ID WHERE UserID = $id ORDER BY Created DESC LIMIT 5");
    $datas = [];
    while($data = mysqli_fetch_assoc($res)){
        $datas[] = [
            'ID' =>$data['ReplyID'],
            'ForumID' => $data['ForumID'],
            'Title' => $data['Title'],
            'Username' => $data['Username'],
            'TimeDiff'=> $data['TimeDiff'],
            'Category' => $data['Category']
        ];
    }
    return $datas;

}
?>