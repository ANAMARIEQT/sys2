<?php 

  session_start();

  require 'connect.php';
  require 'functions.php';
  


  if(isset($_POST['register'])) {

    $uname = clean($_POST['username']); 
    $pword = clean($_POST['password']); 
    $studno = clean($_POST['Student_ID']); 
    $fname = clean($_POST['firstname']);
    $mname = clean($_POST['middlename']); 
    $lname = clean($_POST['lastname']); 
    $course = clean($_POST['course']); 
    $yrlevel = clean($_POST['yrlevel']); 
    $school = clean($_POST['school']); 
    $email = clean($_POST['email']); 
    $birthday = clean($_POST['birthday']);
    $Add = clean($_POST['address']);
    $SAdd = clean($_POST['Saddress']);
    $barangay = clean($_POST['barangay']);
    $zip = clean($_POST['zip']);
    $city = clean($_POST['city']);
    $marital =clean($_POST['RaMarital']);
    $gender =clean($_POST['gender']);
    $cnum = clean($_POST['cpnum']);
    $MoName = clean($_POST['MoName']);
    $FaName = clean($_POST['FaName']);
    $MoEduc = clean($_POST['MoEduc']);
    $FaEduc = clean($_POST['FaEduc']);

    





    $query = "SELECT username FROM students WHERE username = '$uname'";
    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result) == 0) {

        $query = "SELECT email FROM students WHERE email = '$email'";
        $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result) == 0) {

      $query = "SELECT Student_ID FROM students WHERE Student_ID = '$studno'";
      $result = mysqli_query($con,$query);


    if(mysqli_num_rows($result) == 0) {

        $query = "INSERT INTO students (username, password, Student_ID, firstname, lastname, email, birthday,address, barangay, zip, city, middlename, marital, gender, cellphonenum, MotherName, FatherName, MotherEduc, FatherEduc)
        VALUES ('$uname', '$pword', '$studno', '$fname', '$lname', '$email', '$birthday', '$Add', '$barangay', '$zip', '$city', '$mname', '$marital', '$gender','$cnum','$MoName','$FaName','$MoEduc','$FaEduc')";

        $que = "INSERT INTO documents (Student_ID, username, password, email) VALUES ('$studno','$uname','$pword','$email')";
          
          $quer = "INSERT INTO school (Student_ID, School, F_Name, L_Name, course, yrlevel, SAdd, username, password, email) VALUES ('$studno','$school','$fname','$lname','$course','$yrlevel','$SAdd','$uname','$pword', '$email')";
          if(mysqli_query($con,$quer))
          if(mysqli_query($con, $que))
        

          if(mysqli_query($con, $query)) {

          $_SESSION['prompt'] = "Account registered. You can now log in.";
          header("location:index.php");
          exit;

        } else {

          die("Error with the query");

        }

      } else {

        $_SESSION['errprompt'] = "That student number already exists.";

      }

    }   else {

        $_SESSION['errprompt'] = "That email already exists.";

      } 
    }
      else {

      $_SESSION['errprompt'] = "Username already exists.";

    }

  } 
?>

<!DOCTYPE html>
<html>
<head>
<style>
body {
  background-image: url("assets/img/bg4.png");
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>
  

	<title>Register</title>

	<link href="bootstrap.min.css" rel="stylesheet">
  <link href="main.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>


    
</head>
<body>

  

  <section class="center-text">
    
    <strong></strong>

    <div class="registration-form box-center clearfix">

    <?php 
        if(isset($_SESSION['errprompt'])) {
          showError();
        }
    ?>

      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

   <fieldset> 
      <legend>Personal Information</legend>  
        
        <div class="form-row">
                <div class="form-group col-md-6">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="floatingInput"  placeholder="Username (must be unique)" required>
                </div>

                <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="text" class="form-control" name="password" placeholder="Password" required>
                </div>
        </div>

                
        <div class="form-row">
                <div class="form-group col-md-4">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
                </div>

                <div class="form-group col-md-4">
                <label for="middlename">Middle Name</label>
                <input type="text" class="form-control" name="middlename" placeholder="Middle Name" required>
                </div>

                <div class="form-group col-md-4">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
                </div>
        </div>

        <div class="form-row">
                <div class="form-group col-md-6">
                <label for="birthday">Birthday</label>
                <input type="date" class="form-control" name="birthday" placeholder="Birthday" required>
                </div>

                <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>

        </div>        

         <div class="form-row">
                <div class="form-group col-md-6">
                <label class="gender">Gender</label><br>
                <input name="gender" type="radio" value="male" checked>Male
                <input name="gender" type="radio" value="female">Female
                </div>

                <div class="form-group col-md-6">
                <label for="cpnum">Cellphone Number</label>
                <input type="number" class="form-control" name="cpnum" placeholder="Cellphone Number" required>
                </div>

                
        </div>

          <div class="form-row">
                <div class="form-group col-md-12">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" placeholder="1234 Main Street"  required>
                </div>
          </div>


        <div class="form-row">
                 <div class="form-group col-md-6">
                  <label for="city">City</label>
                  <select id="city" class="form-control" name="city">
                    <option selected>Choose...</option>
                    <option selected>Muntinlupa</option>
                    <option selected>Caloocan</option>
                    <option selected>Malabon</option>
                    <option selected>Navotas</option>
                    <option selected>Valenzuela</option>
                    <option selected>Quezon</option>
                    <option selected>Marikina</option>
                    <option selected>Pasig</option>
                    <option selected>Taguig</option>
                    <option selected>Makati</option>
                    <option selected>Manila</option>
                    <option selected>Mandaluyong</option>
                    <option selected>San Juan</option>
                    <option selected>Pasay</option>
                    <option selected>Parañaque</option>
                    <option selected>Las Piñas</option>
                    <option selected>Pateros</option>
                  </select required>

        </div>


        <div class="form-group col-md-4">
            <label for="barangay">Barangay</label>
            <select id="barangay" class="form-control" name="barangay">
              <option class="Muntinlupa">Alabang</option>
              <option class="Muntinlupa">Bayanan</option>
              <option class="Muntinlupa">Tunasan</option>
              <option class="Muntinlupa">Poblacion</option>
              <option class="Muntinlupa">Putatan</option>
              <option class="Muntinlupa">Ayala Alabang</option>
              <option class="Muntinlupa">Cupang</option>
              <option class="Muntinlupa">Buli</option>
              <option class="Muntinlupa">Sucat</option>
              <option class="Caloocan">Barangay 1</option>
              <option class="Caloocan">Barangay 2</option>
              <option class="Caloocan">Barangay 3</option>
              <option class="Caloocan">Barangay 4</option>
              <option class="Caloocan">Barangay 5</option>
              <option class="Caloocan">Barangay 6</option>
              <option class="Caloocan">Barangay 7</option>
              <option class="Caloocan">Barangay 8</option>
              <option class="Caloocan">Barangay 9</option>
              <option class="Caloocan">Barangay 10</option>
              <option class="Caloocan">Barangay 100</option>
              <option class="Caloocan">Barangay 101</option>
              <option class="Caloocan">Barangay 102</option>
              <option class="Caloocan">Barangay 103</option>
              <option class="Caloocan">Barangay 104</option>
              <option class="Caloocan">Barangay 105</option>
              <option class="Caloocan">Barangay 106</option>
              <option class="Caloocan">Barangay 107</option>
              <option class="Caloocan">Barangay 108</option>
              <option class="Caloocan">Barangay 109</option>
              <option class="Caloocan">Barangay 11</option>
              <option class="Caloocan">Barangay 110</option>
              <option class="Caloocan">Barangay 111</option>
              <option class="Caloocan">Barangay 112</option>
              <option class="Caloocan">Barangay 113</option>
              <option class="Caloocan">Barangay 114</option>
              <option class="Caloocan">Barangay 115</option>
              <option class="Caloocan">Barangay 116</option>
              <option class="Caloocan">Barangay 117</option>
              <option class="Caloocan">Barangay 118</option>
              <option class="Caloocan">Barangay 119</option>
              <option class="Caloocan">Barangay 12</option>
              <option class="Caloocan">Barangay 120</option>
              <option class="Caloocan">Barangay 121</option>
              <option class="Caloocan">Barangay 122</option>
              <option class="Caloocan">Barangay 123</option>
              <option class="Caloocan">Barangay 124</option>
              <option class="Caloocan">Barangay 125</option>
              <option class="Caloocan">Barangay 126</option>
              <option class="Caloocan">Barangay 127</option>
              <option class="Caloocan">Barangay 128</option>
              <option class="Caloocan">Barangay 129</option>
              <option class="Caloocan">Barangay 13</option>
              <option class="Caloocan">Barangay 130</option>
              <option class="Caloocan">Barangay 131</option>
              <option class="Caloocan">Barangay 132</option>
              <option class="Caloocan">Barangay 133</option>
              <option class="Caloocan">Barangay 134</option>
              <option class="Caloocan">Barangay 135</option>
              <option class="Caloocan">Barangay 136</option>
              <option class="Caloocan">Barangay 137</option>
              <option class="Caloocan">Barangay 138</option>
              <option class="Caloocan">Barangay 139</option>
              <option class="Caloocan">Barangay 14</option>
              <option class="Caloocan">Barangay 140</option>
              <option class="Caloocan">Barangay 141</option>
              <option class="Caloocan">Barangay 142</option>
              <option class="Caloocan">Barangay 143</option>
              <option class="Caloocan">Barangay 144</option>
              <option class="Caloocan">Barangay 145</option>
              <option class="Caloocan">Barangay 146</option>
              <option class="Caloocan">Barangay 147</option>
              <option class="Caloocan">Barangay 148</option>
              <option class="Caloocan">Barangay 149</option>
              <option class="Caloocan">Barangay 15</option>
              <option class="Caloocan">Barangay 150</option>
              <option class="Caloocan">Barangay 151</option>
              <option class="Caloocan">Barangay 152</option>
              <option class="Caloocan">Barangay 153</option>
              <option class="Caloocan">Barangay 154</option>
              <option class="Caloocan">Barangay 155</option>
              <option class="Caloocan">Barangay 156</option>
              <option class="Caloocan">Barangay 157</option>
              <option class="Caloocan">Barangay 158</option>
              <option class="Caloocan">Barangay 159</option>
              <option class="Caloocan">Barangay 16</option>
              <option class="Caloocan">Barangay 160</option>
              <option class="Caloocan">Barangay 161</option>
              <option class="Caloocan">Barangay 162</option>
              <option class="Caloocan">Barangay 163</option>
              <option class="Caloocan">Barangay 164</option>
              <option class="Caloocan">Barangay 165</option>
              <option class="Caloocan">Barangay 166</option>
              <option class="Caloocan">Barangay 167</option>
              <option class="Caloocan">Barangay 168</option>
              <option class="Caloocan">Barangay 169</option>
              <option class="Caloocan">Barangay 17</option>
              <option class="Caloocan">Barangay 170</option>
              <option class="Caloocan">Barangay 171</option>
              <option class="Caloocan">Barangay 172</option>
              <option class="Caloocan">Barangay 173</option>
              <option class="Caloocan">Barangay 174</option>
              <option class="Caloocan">Barangay 175</option>
              <option class="Caloocan">Barangay 176</option>
              <option class="Caloocan">Barangay 177</option>
              <option class="Caloocan">Barangay 178</option>
              <option class="Caloocan">Barangay 179</option>
              <option class="Caloocan">Barangay 18</option>
              <option class="Caloocan">Barangay 180</option>
              <option class="Caloocan">Barangay 181</option>
              <option class="Caloocan">Barangay 182</option>
              <option class="Caloocan">Barangay 183</option>
              <option class="Caloocan">Barangay 184</option>
              <option class="Caloocan">Barangay 185</option>
              <option class="Caloocan">Barangay 186</option>
              <option class="Caloocan">Barangay 187</option>
              <option class="Caloocan">Barangay 188</option>
              <option class="Caloocan">Barangay 19</option>
              <option class="Caloocan">Barangay 20</option>
              <option class="Caloocan">Barangay 21</option>
              <option class="Caloocan">Barangay 22</option>
              <option class="Caloocan">Barangay 23</option>
              <option class="Caloocan">Barangay 24</option>
              <option class="Caloocan">Barangay 25</option>
              <option class="Caloocan">Barangay 26</option>
              <option class="Caloocan">Barangay 27</option>
              <option class="Caloocan">Barangay 28</option>
              <option class="Caloocan">Barangay 29</option>
              <option class="Caloocan">Barangay 30</option>
              <option class="Caloocan">Barangay 31</option>
              <option class="Caloocan">Barangay 32</option>
              <option class="Caloocan">Barangay 33</option>
              <option class="Caloocan">Barangay 34</option>
              <option class="Caloocan">Barangay 35</option>
              <option class="Caloocan">Barangay 36</option>
              <option class="Caloocan">Barangay 37</option>
              <option class="Caloocan">Barangay 38</option>
              <option class="Caloocan">Barangay 39</option>
              <option class="Caloocan">Barangay 40</option>
              <option class="Caloocan">Barangay 41</option>
              <option class="Caloocan">Barangay 42</option>
              <option class="Caloocan">Barangay 43</option>
              <option class="Caloocan">Barangay 44</option>
              <option class="Caloocan">Barangay 45</option>
              <option class="Caloocan">Barangay 46</option>
              <option class="Caloocan">Barangay 47</option>
              <option class="Caloocan">Barangay 48</option>
              <option class="Caloocan">Barangay 49</option>
              <option class="Caloocan">Barangay 50</option>
              <option class="Caloocan">Barangay 51</option>
              <option class="Caloocan">Barangay 52</option>
              <option class="Caloocan">Barangay 53</option>
              <option class="Caloocan">Barangay 54</option>
              <option class="Caloocan">Barangay 55</option>
              <option class="Caloocan">Barangay 56</option>
              <option class="Caloocan">Barangay 57</option>
              <option class="Caloocan">Barangay 58</option>
              <option class="Caloocan">Barangay 59</option>
              <option class="Caloocan">Barangay 60</option>
              <option class="Caloocan">Barangay 61</option>
              <option class="Caloocan">Barangay 62</option>
              <option class="Caloocan">Barangay 63</option>
              <option class="Caloocan">Barangay 64</option>
              <option class="Caloocan">Barangay 65</option>
              <option class="Caloocan">Barangay 66</option>
              <option class="Caloocan">Barangay 67</option>
              <option class="Caloocan">Barangay 68</option>
              <option class="Caloocan">Barangay 69</option>
              <option class="Caloocan">Barangay 70</option>
              <option class="Caloocan">Barangay 71</option>
              <option class="Caloocan">Barangay 72</option>
              <option class="Caloocan">Barangay 73</option>
              <option class="Caloocan">Barangay 74</option>
              <option class="Caloocan">Barangay 75</option>
              <option class="Caloocan">Barangay 76</option>
              <option class="Caloocan">Barangay 77</option>
              <option class="Caloocan">Barangay 78</option>
              <option class="Caloocan">Barangay 79</option>
              <option class="Caloocan">Barangay 80</option>
              <option class="Caloocan">Barangay 81</option>
              <option class="Caloocan">Barangay 82</option>
              <option class="Caloocan">Barangay 83</option>
              <option class="Caloocan">Barangay 84</option>
              <option class="Caloocan">Barangay 85</option>
              <option class="Caloocan">Barangay 86</option>
              <option class="Caloocan">Barangay 87</option>
              <option class="Caloocan">Barangay 88</option>
              <option class="Caloocan">Barangay 89</option>
              <option class="Caloocan">Barangay 90</option>
              <option class="Caloocan">Barangay 91</option>
              <option class="Caloocan">Barangay 92</option>
              <option class="Caloocan">Barangay 93</option>
              <option class="Caloocan">Barangay 94</option>
              <option class="Caloocan">Barangay 95</option>
              <option class="Caloocan">Barangay 96</option>
              <option class="Caloocan">Barangay 97</option>
              <option class="Caloocan">Barangay 98</option>
              <option class="Caloocan">Barangay 99</option>
              <option class="Malabon">Acacia</option>
              <option class="Malabon">Baritan</option>
              <option class="Malabon">Bayan-Bayanan</option>
              <option class="Malabon">Catmon</option>
              <option class="Malabon">Concepcion</option>
              <option class="Malabon">Dampalit</option>
              <option class="Malabon">Flores</option>
              <option class="Malabon">Hulong Duhat</option>
              <option class="Malabon">Ibaba</option>
              <option class="Malabon">Longos</option>
              <option class="Malabon">Maysilo</option>
              <option class="Malabon">Muzon</option>
              <option class="Malabon">Niugan</option>
              <option class="Malabon">Panghulo</option>
              <option class="Malabon">Potrero</option>
              <option class="Malabon">San Agustin</option>
              <option class="Malabon">Santolan</option>
              <option class="Malabon">Tañong</option>
              <option class="Malabon">Tinajeros</option>
              <option class="Malabon">Tonsuya</option>
              <option class="Malabon">Tugatog</option>
              <option class="Navotas">Bagumbayan North</option>
              <option class="Navotas">Bagumbayan South</option>
              <option class="Navotas">Bangculasi</option>
              <option class="Navotas">Daanghari</option>
              <option class="Navotas">Navotas East</option>
              <option class="Navotas">Navotas West</option>
              <option class="Navotas">North Bay Boulevard North</option>
              <option class="Navotas">North Bay Boulevard South</option>
              <option class="Navotas">San Jose</option>
              <option class="Navotas">San Rafael Village</option>
              <option class="Navotas">San Roque</option>
              <option class="Navotas">Sipac-Almacen</option>
              <option class="Navotas">Tangos (incl. Tangos North, Tangos South)</option>
              <option class="Navotas">Tanza (incl. Tanza 1, Tanza 2)</option>
              <option class="Valenzuela">Arkong Bato</option>
              <option class="Valenzuela">Bagbaguin</option>
              <option class="Valenzuela">Balangkas</option>
              <option class="Valenzuela">Bignay</option>
              <option class="Valenzuela">Bisig</option>
              <option class="Valenzuela">Canumay East</option>
              <option class="Valenzuela">Canumay West</option>
              <option class="Valenzuela">Coloong</option>
              <option class="Valenzuela">Dalandanan</option>
              <option class="Valenzuela">Hen. T. De Leon</option>
              <option class="Valenzuela">Isla</option>
              <option class="Valenzuela">Karuhatan</option>
              <option class="Valenzuela">Lawawng Bato</option>
              <option class="Valenzuela">Lingunan</option>
              <option class="Valenzuela">Mabolo</option>
              <option class="Valenzuela">Malanday</option>
              <option class="Valenzuela">Malinta</option>
              <option class="Valenzuela">Mapulang Lupa</option>
              <option class="Valenzuela">Marulas</option>
              <option class="Valenzuela">Maysan</option>
              <option class="Valenzuela">Palasan</option>
              <option class="Valenzuela">Parada</option>
              <option class="Valenzuela">Pariancillo Villa</option>
              <option class="Valenzuela">Paso De Blas</option>
              <option class="Valenzuela">Pasolo</option>
              <option class="Valenzuela">Poblacion</option>
              <option class="Valenzuela">Pulo</option>
              <option class="Valenzuela">Punturin</option>
              <option class="Valenzuela">Rincon</option>
              <option class="Valenzuela">Tagalag</option>
              <option class="Valenzuela">Ugong</option>
              <option class="Valenzuela">Viente Reales</option>
              <option class="Valenzuela">Wawang Pulo</option>
              <option class="Quezon">Alicia</option>
              <option class="Quezon">Amihan</option>
	      <option class="Quezon">Apolonio Samson</option>
	      <option class="Quezon">Aurora</option>
	      <option class="Quezon">Baesa</option>
	      <option class="Quezon">Bagbag</option>
	      <option class="Quezon">Bagong Lipunan ng Crame</option>
	      <option class="Quezon">Bagong Pag-asa</option>
	      <option class="Quezon">Bagong Silangan</option>
	      <option class="Quezon">Bagumbayan</option>
	      <option class="Quezon">Bagumbuhay</option>
	      <option class="Quezon">Bahay Toro</option>
	      <option class="Quezon">Balingasa</option>
	      <option class="Quezon">Balong bato</option>
	      <option class="Quezon">Batasan Hills</option>
	      <option class="Quezon">Bayanihan</option>
	      <option class="Quezon">Blue Ridge A</option>
	      <option class="Quezon">Blue Ridge B</option>
	      <option class="Quezon">Botocan</option>
	      <option class="Quezon">Bungad</option>
	      <option class="Quezon">Camp Aguinaldo</option>
	      <option class="Quezon">Capri</option>
	      <option class="Quezon">Central</option>
	      <option class="Quezon">Claro</option>
	      <option class="Quezon">Commonwealth</option>
	      <option class="Quezon">Culiat</option>
	      <option class="Quezon">Damar</option>
	      <option class="Quezon">Damayan</option>
	      <option class="Quezon">Damayang Lagi</option>
	      <option class="Quezon">Del Monte</option>
	      <option class="Quezon">Dioquino Zobel</option>
	      <option class="Quezon">Doña Imelda</option>
	      <option class="Quezon">Doña Josefa</option>
	      <option class="Quezon">Don Manuel</option>
	      <option class="Quezon">Duyan-Duyan</option>
	      <option class="Quezon">East Kamias</option>
	      <option class="Quezon">E. Rodriguez</option>
	      <option class="Quezon">Escopa I</option>
	      <option class="Quezon">Escopa II</option>
	      <option class="Quezon">Escopa III</option>
	      <option class="Quezon">Escopa IV</option>
	      <option class="Quezon">Fairview</option>
	      <option class="Quezon">Greater Largo</option>
	      <option class="Quezon">Gulod</option>
	      <option class="Quezon">Holy Spirit</option>
	      <option class="Quezon">Horseshoe</option>
	      <option class="Quezon">Immaculate Concepcion</option>
	      <option class="Quezon">Kaligayan</option>
	      <option class="Quezon">Kalusugan</option>
	      <option class="Quezon">Kamuning</option>
	      <option class="Quezon">Katipunan</option>
	      <option class="Quezon">Kaunlaran</option>
	      <option class="Quezon">Kristong Hari</option>
	      <option class="Quezon">Laging Handa</option>
	      <option class="Quezon">Libis</option>
	      <option class="Quezon">Lourdes</option>
	      <option class="Quezon">Loyola Heights</option>
	      <option class="Quezon">Maharlika</option>
	      <option class="Quezon">Malaya</option>
	      <option class="Quezon">Mangga</option>
	      <option class="Quezon">Manresa</option>
	      <option class="Quezon">Mariana</option>
	      <option class="Quezon">Mariblo</option>
	      <option class="Quezon">Marilag</option>
	      <option class="Quezon">Masagana</option>
	      <option class="Quezon">Masambong</option>
              <option class="Quezon">Matandang Balara</option>
	      <option class="Quezon">Milagrosa</option>
	      <option class="Quezon"></option>
		      <option class="Quezon"></option>
		    




              <option>...</option>
              </select required>
              </div>


              <div class="form-group col-md-2">
              <label for="zip">Zip</label>
              <input type="number" class="form-control" id="zip" name="zip" required>
              </div>

  </fieldset>


  <fieldset>
          
    <legend>School Information</legend>

          <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="school">School</label>
                  <select class="form-control" name="school">
                  <option value="Plmun">Pamantasan ng Lungsod ng Muntinlupa</option>
                  <option value="MunSci">Muntinlupa Science Highscool</option>
                  <option value="IES">Itaas Elementary School</option> 
                  </select required>
                </div>

                <div class="form-group col-md-6">
                <label for="course">Course - select "None" if not yet college</label>
                  <select class="form-control" name="course">
                  <option class="Plmun">ACT</option>
                  <option class="Plmun">BSIT</option>
                  <option class="Plmun">BSCS</option> 
                  <option class="IES">BSArch</option> 
                  <option class="MunSci">BSMech</option> 
                  <option class="Plmun">None</option> 
                  <option class="MunSci">None</option> 
                  <option class="IES">None</option>
                  </select required>
                </div>
                
          </div>

          <div class="form-row">
              <div class="form-group col-md-6">
                  <label for="yrlevel">Year Level</label>
                  <select class="form-control" name="yrlevel">
                  <option>Grade 1</option>
                  <option>Grade 2</option>
                  <option>Grade 3</option>
                  <option>Grade 4</option>
                  <option>Grade 5</option>
                  <option>Grade 6</option>
                  <option>Grade 7</option>
                  <option>Grade 8</option>
                  <option>Grade 9</option>
                  <option>Grade 10</option>
                  <option>Grade 11</option>
                  <option>Grade 12</option>
                  <option>1st year - College</option>
                  <option>2nd year - College</option>
                  <option>3rd year - College</option>
                  <option>4th year - College</option>
                  <option>5th year - College</option>
                  </select required>
              </div>

              <div class="form-group col-md-6">
                <label for="Student_ID">Student Number</label>
                <input type="text" class="form-control" name="Student_ID" placeholder="Student Number" required>
              </div>

          </div>

              <div class="form-group col-md-12">
                <label for="Saddress">School Address</label>
                <input type="text" class="form-control" name="Saddress" placeholder="1234 Main Street" required>
              </div>

  </fieldset>

  <fieldset>
    <legend>Parents Information</legend>


          <div class="form-row">
             <div class="form-group col-md-6">
                <label for="MoName">Mother Maiden Name</label>
                <input type="text" class="form-control" name="MoName" placeholder="Mother Maiden Name" required>
              </div>

               <div class="form-group col-md-6">
                <label for="FaName">Father Name</label>
                <input type="text" class="form-control" name="FaName" placeholder="Father Name" required>
              </div>
          </div>

          <div class="form-row">
             <div class="form-group col-md-6">
                <label for="MoEduc">Mother Educational Attainment</label>
                  <select class="form-control" name="MoEduc">
                  <option>Primary</option>
                  <option>Secondary</option>
                  <option >Vocational</option>
                  <option >Tertiary - UnderGraduate</option>
                  <option >Tertiary - Graduate</option>
                  <option >Tertiary - Doctoral</option>
                  </select required>
              </div>

               <div class="form-group col-md-6">
                <label for="FaEduc">Father Educational Attainment</label>
                  <select class="form-control" name="FaEduc">
                  <option>Primary</option>
                  <option>Secondary</option>
                  <option >Vocational</option>
                  <option >Tertiary - UnderGraduate</option>
                  <option >Tertiary - Graduate</option>
                  <option >Tertiary - Doctoral</option>
                  </select required>
              </div>
          </div>


          <div class="form-row">
            <div class="form-group col-md-6">
            <label class="RaMarital">Marital Status</label><br>
                <input name="RaMarital" type="radio" value="Divorced" checked>Divorced
                <input name="RaMarital" type="radio" value="Seperated">Seperated
            </div>

          </div>






  </fieldset>

<a href="index.php">Go back</a>
        <input class="btn btn-primary" type="submit" name="register" value="Register">
      </form>
    </div>

  </section>

  


	<script src="jquery-3.1.1.min.js"></script>
	<script src="bootstrap.min.js"></script>

  <script>
    var course = $("[name=course] option").detach()
$("[name=school]").change(function() {
  var val = $(this).val()
  $("[name=course] option").detach()
  course.filter("." + val).clone().appendTo("[name=course]")
}).change()
</script>

<script>
    var barangay = $("[name=barangay] option").detach()
$("[name=city]").change(function() {
  var val = $(this).val()
  $("[name=barangay] option").detach()
  barangay.filter("." + val).clone().appendTo("[name=barangay]")
}).change()
</script>

</body>
</html>

<?php 

  unset($_SESSION['errprompt']);
  mysqli_close($con);

?>
