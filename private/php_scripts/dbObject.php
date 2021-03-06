<?php

class dbObject {
	var $host = 'mysql.resumake.thegbclub.com';
    var $username = 'thegbclub';
    var $password = 'thegingerbreadclub';
    var $schema = 'resumake';
		
	//////////////////// Control ///////////////////////////////
    /*
     connect connects to a database; the instance variables of the
     database class must be initialized
    */
    public function connect() {
        mysql_connect($this->host,$this->username,$this->password)
            or die("Could not connect. " . mysql_error());
        mysql_select_db($this->schema)
            or die("Could not select database. " . mysql_error());
    }
	
    public function addEmail($email)
    {
        $email = addslashes($email);
        
        $to = $email;
        $subject = "Thanks!";
        $body = "Thanks for showing interest in Resumake! \n\n We'll send you new information when we can! \n\n Regards,\n-The Resumake Team";

        mail($to, $subject, $body);
        
        $sql = "INSERT INTO previewregister (email) VALUES ('$email')";
		return mysql_query($sql);
    }

	
	///////////////////////// USERS ///////////////////////////////////////////
    
	public function addUser($name, $email, $password, $username, $confirmation)
	{	
		if ($this->getUserByEmail($email))
			return FALSE;
		
		$name = addslashes($name);
		$email = addslashes($email);
		$password = addslashes($password);
		$username = addslashes($username);
		
		$sql = "INSERT INTO users (name, password, email, username, confirmation_code) VALUES ('$name', '$password', '$email', '$username', '$confirmation')";
		return mysql_query($sql);
	}

	public function addImagePathByUsername($path, $username){
		$imgpath = addslashes($path);
		$mysql = "UPDATE users SET imagepath='$imgpath' WHERE username='$username'";
		return mysql_query($mysql);
	}
	
	public function confirmUser($uid){
		$user = $this->getUserById($uid);
		copy("../private/default/index.php", "../users/" . $user->username . ".php");
	
		$mysql = "UPDATE users SET is_confirmed=1 WHERE uid='$uid'";
		return mysql_query($mysql); 
	}
	
	public function updateUserInfo($uid, $info){
		$mysql = "UPDATE users SET info='$info' WHERE uid='$uid'";
		if($info == -1){
			return -1;
		}
		return mysql_query($mysql);
	}
	
	public function getUserByConfirmationCode($confirmation){
		$sql = "SELECT * FROM users WHERE confirmation_code='$confirmation'";
		$result = mysql_query($sql);
		if ($result == FALSE || mysql_num_rows($result) < 1)
			return FALSE;
			
		$row = mysql_fetch_array($result);
		
		$user = new user;
		$user->uid = stripslashes($row['uid']);
		$user->password = stripslashes($row['password']);
		$user->email = stripslashes($row['email']);
		$user->date_joined = $this->parseTimestamp(stripslashes($row['date_reg']));
		$user->name = stripslashes($row['name']);
		$user->username = stripslashes($row['username']);
		$user->info = stripslashes($row['info']);
		$user->is_confirmed = stripslashes($row['is_confirmed']);
		$user->confirmation_code = stripslashes($row['confirmation_code']);
		$user->imagepath = stripslashes($row['imagepath']);
	
		return $user;
	}
	
	public function getUserByUsername($username){
		$sql = "SELECT * FROM users WHERE username='$username'";
		
		$result = mysql_query($sql);
		
		if ($result == FALSE || mysql_num_rows($result) < 1)
			return FALSE;
			
		$row = mysql_fetch_array($result);
		
		$user = new user;
		$user->uid = stripslashes($row['uid']);
		$user->password = stripslashes($row['password']);
		$user->email = stripslashes($row['email']);
		$user->date_joined = $this->parseTimestamp(stripslashes($row['date_reg']));
		$user->name = stripslashes($row['name']);
		$user->username = stripslashes($row['username']);
		$user->info = stripslashes($row['info']);
		$user->is_confirmed = stripslashes($row['is_confirmed']);
		$user->confirmation_code = stripslashes($row['confirmation_code']);
		$user->imagepath = stripslashes($row['imagepath']);
	
		return $user;
	}
	
	public function getUserById($uid)
	{
		$sql = "SELECT * FROM users WHERE uid=$uid";
		
		$result = mysql_query($sql);
		
		if ($result == FALSE || mysql_num_rows($result) < 1)
			return FALSE;
			
		$row = mysql_fetch_array($result);
		
		$user = new user;
		$user->uid = stripslashes($row['uid']);
		$user->password = stripslashes($row['password']);
		$user->email = stripslashes($row['email']);
		$user->date_joined = $this->parseTimestamp(stripslashes($row['date_reg']));
		$user->name = stripslashes($row['name']);
		$user->username = stripslashes($row['username']);
		$user->info = stripslashes($row['info']);
		$user->is_confirmed = stripslashes($row['is_confirmed']);
		$user->confirmation_code = stripslashes($row['confirmation_code']);
		$user->imagepath = stripslashes($row['imagepath']);
		
		return $user;
	}
	
	public function getUserByEmail($email)
	{
		$sql = "SELECT * FROM users WHERE email='$email'";
		
		
		$result = mysql_query($sql);
		
		if ($result == FALSE || mysql_num_rows($result) < 1)
			return FALSE;
			
		$row = mysql_fetch_array($result);
		
		$user = new user;
		$user->uid = stripslashes($row['uid']);
		$user->password = stripslashes($row['password']);
		$user->email = stripslashes($row['email']);
		$user->date_joined = $this->parseTimestamp(stripslashes($row['date_reg']));
		$user->name = stripslashes($row['name']);
		$user->username = stripslashes($row['username']);
		$user->info = stripslashes($row['info']);
		$user->is_confirmed = stripslashes($row['is_confirmed']);
		$user->confirmation_code = stripslashes($row['confirmation_code']);
		$user->imagepath = stripslashes($row['imagepath']);
	
		return $user;
	}
	
	
	///////////////////////// RESUME ///////////////////////////////////////////
	public function belongsToUser($rid, $uid){
        $resumes = $this->getResumesByUid($uid);
        foreach($resumes as $resume){
            if($resume->rid == $rid)
                return true;
        }
        return false;
    }
    
	public function getResumesByUid($uid){
		$sql = "SELECT * FROM resume WHERE uid=$uid ORDER BY rid";
		$result = mysql_query($sql);
        $resumes = array();
		while($row = mysql_fetch_array($result)){
            $resume = new Resume;
            $resume->rid = stripslashes($row['rid']);
            $resume->uid = stripslashes($row['uid']);
            $resume->name = stripslashes($row['name']);
            $resume->date_created = $this->parseTimestamp(stripslashes($row['date_created']));
            $resume->content = stripslashes($row['content']);
            array_push($resumes, $resume);
        }
		return $resumes;
	}
    
    public function getResumeByRid($rid){
        $sql = "SELECT * FROM resume WHERE rid=$rid";
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        $resume = new Resume;
        $resume->rid = stripslashes($row['rid']);
        $resume->uid = stripslashes($row['uid']);
        $resume->name = stripslashes($row['name']);
        $resume->date_created = $this->parseTimestamp(stripslashes($row['date_created']));
        $resume->content = stripslashes($row['content']);
        return $resume;
    }   
	
	public function addResumeByUid($uid, $content, $name){
		$content = addslashes($content);
		$name = addslashes($name);
	
		$sql = "INSERT INTO resume (uid, content, name) VALUES ('$uid', '$content', '$name')";
		mysql_query($sql);
        return mysql_insert_id();
	}
	
    public function updateResume($rid, $name, $content){
        $content = addslashes($content);
        $name = addslashes($name);
        
        $sql = "UPDATE resume SET content='$content', name='$name' WHERE rid=$rid";
        return mysql_query($sql);
    }
    
    public function deleteResumesByRid($rids, $uid){
        $sql = "DELETE FROM resume WHERE rid IN (";
        for($i = 0; $i < count($rids); $i++){
            $sql .= $rids[$i];
            if($i != count($rids) - 1)
                $sql .= ',';
        }
        $sql .= ')';
        return mysql_query($sql);
    }
    
    ///////////////////////// DRAFT ///////////////////////////////////////////
    public function pushDraft($content, $name, $uid){
        $content = addslashes($content);
        $name = addslashes($name);
        
        $sql = "REPLACE INTO draft(content, name, uid) VALUES('$content', '$name', '$uid')";
        return mysql_query($sql);
    }
    
    public function hasDraft($uid){
        if($this->getLatestDraft($uid))
            return '1';
        return '0';
    }
    
    public function getLatestDraft($uid){
        $sql = "SELECT * FROM draft WHERE uid=$uid";
        $result = mysql_query($sql);
        if ($result == FALSE || mysql_num_rows($result) < 1)
			return FALSE;
        
        $row = mysql_fetch_array($result);
        $draft = new Draft();
        $draft->uid = $row['uid'];
        $draft->name = stripslashes($row['name']);
        $draft->content = stripslashes($row['content']);
        $draft->date_created = $this->parseTimestamp($row['uid']);
        return $draft;
    }
        
    public function clearDraft($uid){
        $sql = "DELETE FROM draft WHERE uid=$uid";
        return mysql_query($sql);
    }
    
    ///////////////////////// Settings ///////////////////////////////////////////
    public function requestPasswordChange($uid){
        $user = $this->getUserById($uid);
        if(!$user)
            return FALSE;
        $email = $user->email;    
        $time = (string)time();
        $code = substr($time, strlen($time) - 6) .  substr(md5($uid), 0, 5);
        $sql = "REPLACE INTO changepassword(uid, code, shoulddelete) VALUES('$uid', '$code', 0)";
        mysql_query($sql);
        
        $emailContent = 'Hi ' . $user->name . "\n" . "\n" . 'Your password change code is ' . $code . "\n" . "\n" . 'Thanks,' ."\n" .'The Resumake Team';
        mail($email, 'Your Password Change Code', $emailContent);
    }
    
    public function setNewPassword($uid, $newPassword, $passwordCode){
        $query = "SELECT code FROM changepassword WHERE uid='$uid'";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        if($passwordCode != $row['code'])
            return FALSE;
    
        $deleteQuery = "DELETE FROM changepassword WHERE uid='$uid'";
        mysql_query($deleteQuery);
    
        $sql = "UPDATE users SET password='$newPassword' WHERE uid='$uid'";
        return mysql_query($sql);
    }
    
    public function setNewUsername($uid, $newUsername){
        $sql = "UPDATE users SET username='$newUsername' WHERE uid='$uid'";
        return mysql_query($sql);
    }
    
    public function removeAccount($uid, $password){
        $user = $this->getUserById($uid);
        if($user->password != $password)
            return FALSE;
    
        $sql = "DELETE FROM draft WHERE uid='$uid'";
        mysql_query($sql);
        $sql = "DELETE FROM users WHERE uid='$uid'";
        mysql_query($sql);
        $sql = "DELETE FROM resume WHERE uid='$uid'";
        mysql_query($sql);
        $sql = "DELETE FROM changepassword WHERE uid='$uid'";
        mysql_query($sql);
        
        return 1;
    }
    
    
	private function parseTimestamp($timestamp) {
		return strtotime($timestamp);	
    } 
}

class user{
	var $uid;
	var $email;
	var $password;
	var $date_joined;
	var $username;
	var $name;
	var $info;
	var $is_confirmed;
	var $confirmation_code;
	var $imagepath;
}

class Resume{
	var $rid;
	var $uid;
	var $name;
	var $date_created;
	var $content;
}

class Draft{
    var $uid;
    var $name;
    var $content;
    var $date_created;
}
?>
